@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Create Schedule Visit" route-list-name="receivable.crm.schedule-visit.index"
                       name="Schedule Visit">
            </x-toolbar>
        @endslot
        <form action="{{route('receivable.crm.schedule-visit.store')}}" method="POST">
            @csrf
            <x-card title="Scheduling Visit" id="scheduling_visit">
                <div class="row g-9 mb-8">
                    <x-data-driven.select2.employee class="col-12 col-md-4 mb-5" type="row" :only-sales="true"
                                                    label="Sales Name" :employee-i-d="old('employee_id')"/>
                    <x-form.select-box name="visit_category" label="Visit Category" class="col-12 col-md-4 mb-5"
                                       type="row"
                                       placeholder="Select Visit Category" :items="VisitCategory::valuesObject()"/>
                    <x-form.input-daterange label="Visit Range Date"
                                            placeholder="Input Visit Range Date..."
                                            class="col-12 col-md-4 mb-5"
                                            :maximum_range_date="$generalSettings->maximum_range_visit?->scalar"/>
                </div>
                <input id="customer_ids" name="customer_ids" hidden=""
                       value="{{ old('customer_ids') }}">
                <div class="d-flex gap-3 mb-5">
                    <a href="{{route('receivable.crm.schedule-visit.index')}}" class="btn btn-danger">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
            </x-card>


        </form>
        <x-card title="Customer Data" id="customer_data">
            <div class="table-responsive">
                <x-table.advance-filter>
                    <x-form.input type="row" class="col-12 col-md-3 mb-5" id="search_customer" name="search"
                                  size-form="sm" label="Search Customer"
                                  placeholder="Search Customer"/>
                    <x-form.select-box type="row" class="col-12 col-md-3 mb-5" id="customer_category_id"
                                       :items="\App\Models\Customer\CustomerCategory::all()"
                                       name="customer_category_id" size-form="sm" label="Customer Category"
                                       placeholder="Select Customer Category"/>
                    <x-data-driven.select2.region type="row" size-form="sm" class="col-12 col-md-3 mb-5"/>
                    <div class="col-12 col-md-3 mb-5 row">
                        <div class="d-flex flex-column">
                            <div class="form-check form-check-custom form-check-solid mb-3">
                                <input class="form-check-input" type="radio" value="1" checked
                                       name="available_customer" id="available_customer"/>
                                <label class="form-check-label" for="available_customer">
                                    Only Available Customers
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" value="0" name="available_customer"
                                       id="booked"/>
                                <label class="form-check-label" for="booked">
                                    Only Booked By Sales
                                </label>
                            </div>
                        </div>
                    </div>
                </x-table.advance-filter>
                <table id="customer_datatable" class="table table-striped table-row-bordered gy-5 gs-7">
                    <thead>
                    <tr class="fw-semibold fs-6 text-gray-800">
                        <th><input type="checkbox" id="select_all_customers"></th>
                        <th>Region Name</th>
                        <th>Area</th>
                        <th>Customer Category</th>
                        <th>Customer Name</th>
                        <th>Customer Status</th>
                        <th>Booked Bys</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </x-card>


    </x-general-section-content>

@endsection
@push('css')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endpush
@push('script')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        const table = $("#customer_datatable").DataTable({
            "fixedHeader": {
                "header": true
            },
            ordering: false,
            "ajax": function (data, callback, settings) {
                const filters = {};

                document.querySelectorAll('select[id^="selectRegion"]').forEach(filterEl => {
                    filters[filterEl.name] = filterEl.value;
                });
                filters['customer_category_id'] = $('#customer_category_id').val()
                filters['available_customer'] = $('input[name="available_customer"]:checked').val() || "0";
                filters['search']=$('input[id^="search_customer"]').val()
                $.get("{{route('api.get.customers')}}", {
                        page_size: data.length,
                        page: (data.start / data.length) + 1,
                        with_booked_by: "1",
                        ...filters
                    },
                    function (json) {
                        callback({
                            recordsTotal: json.result.total,
                            recordsFiltered: json.result.total,
                            data: json.result.data
                        });
                    });
            },
            processing: true,
            serverSide: true,
            pageLength: 10,
            searching: true,
            aoColumns: [
                {
                    data: 'id',
                    render: function (data, type, row) {
                        const checked = $("#customer_ids").val().split(',').includes(String(data)) ? 'checked' : '';
                        return `<input type="checkbox" class="customer_checkbox" value="${data}" ${checked} />`;
                    }
                },
                {
                    data: 'area.region.name',
                },
                {
                    data: 'area.name',
                },
                {
                    data: 'customer_category.name',
                },
                {
                    data: 'name',
                },
                {
                    data: 'status',
                },
                {
                    data: 'booked_bys',
                    render: function (data, type, row) {
                        if (data && data.length > 0) {
                            let result = "";
                            data.forEach(by => {
                                const startDate = moment(by.start_visit).format("DD MMM YYYY");
                                const endDate = moment(by.end_visit).format("DD MMM YYYY");
                                result += `${by.employee.user.name} | ${startDate} - ${endDate}<br>`;
                            });
                            return result;
                        } else {
                            return "available";
                        }
                    }
                },
            ],
            drawCallback: function (settings) {
                updateSelectAllCheckbox();
            }
        });

        function updateSelectAllCheckbox() {
            const allCheckboxes = $(".customer_checkbox");
            const checkedCheckboxes = $(".customer_checkbox:checked");
            const selectAllCheckbox = $("#select_all_customers");

            if (allCheckboxes.length === checkedCheckboxes.length) {
                selectAllCheckbox.prop("checked", true);
            } else {
                selectAllCheckbox.prop("checked", false);
            }
        }

        $('#customer_category_id').on('change', function () {
            table.ajax.reload()
        })
        $('input[id^="search_customer"]').on('keyup', function () {
            table.ajax.reload()
        })
        $('input[name="available_customer"]').on('change', function () {
            table.ajax.reload();
        });
        $(document).ready(function () {
            const selectRegionElements = $('select[id^="selectRegion"]');

            if (selectRegionElements.length > 0) {
                selectRegionElements.each(function () {
                    const filterEl = $(this);

                    filterEl.on('change', function () {
                        table.ajax.reload();
                    });
                });
            } else {
                console.log("No elements with id starting with 'selectRegion' found.");
            }
        });

        let countCheckedBoxCustomer = $("#customer_ids").val().split(',').length;
        $(document).on('change', '.customer_checkbox', function () {
            let maxVisits = getMaxVisit()
            if (maxVisits == 0) {
                return;
            }

            let customerIDs = $("#customer_ids");
            let selectedIds = customerIDs.val().split(',');
            if (customerIDs.val() == '') {
                selectedIds = []
            }


            if ($(this).prop("checked")) {
                if (countCheckedBoxCustomer >= maxVisits) {
                    $(this).prop("checked", false);
                    toastr.warning('You have exceeded the maximum number of visits per day!')
                    return;
                }

                let customerId = $(this).val();
                if (!selectedIds.includes(customerId)) {
                    selectedIds.push(customerId);
                    countCheckedBoxCustomer++
                }
            } else {
                let customerId = $(this).val();
                selectedIds = selectedIds.filter(id => id !== customerId);
                countCheckedBoxCustomer--
            }

            customerIDs.val(selectedIds.join(','));
            updateSelectAllCheckbox()
        });

        $("#select_all_customers").on('change', function () {
            let maxVisits = getMaxVisit()
            if (maxVisits == 0) {
                return;
            }
            const isChecked = $(this).prop("checked");
            let selectedIds = $("#customer_ids").val().split(',');
            if ($("#customer_ids").val() == '') {
                selectedIds = [];
            }

            if (isChecked && (countCheckedBoxCustomer > maxVisits)) {
                toastr.warning('You have exceeded the maximum number of visits per day!')
                $(this).prop("checked", false);
                return;
            }

            let checkboxes = $(".customer_checkbox");

            checkboxes.each(function () {
                if (countCheckedBoxCustomer < maxVisits) {
                    $(this).prop("checked", isChecked);
                    if (isChecked) {
                        let customerId = $(this).val();
                        if (!selectedIds.includes(customerId)) {
                            selectedIds.push(customerId);
                            countCheckedBoxCustomer++
                        }
                    } else {
                        selectedIds = [];
                    }
                } else {
                    if (!isChecked) {
                        $(this).prop("checked", false);
                    }
                }
            });

            if (!isChecked) {
                countCheckedBoxCustomer = 0
                selectedIds = [];
            }
            $("#customer_ids").val(selectedIds.join(','));
        });


        function getMaxVisit() {
            let startDate = $('input[name="start_date"]').val();
            let endDate = $('input[name="end_date"]').val();
            if (startDate == '' || endDate == '') {
                toastr.warning('Please enter the visit range date first')
                return 0
            }
            const start = moment(startDate, "YYYY-MM-DD");
            const end = moment(endDate, "YYYY-MM-DD");
            const maximumVisitPerDay = parseInt("{{$generalSettings->maximum_visit_per_day->scalar}}", 10) || 0;
            const dateDif = end.diff(start, 'days') + 1;
            return maximumVisitPerDay * dateDif;
        }
    </script>
@endpush
