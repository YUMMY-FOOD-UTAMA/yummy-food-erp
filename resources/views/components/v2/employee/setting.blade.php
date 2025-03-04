@props([
    'dataDropdownParent'=>''
])
<div class="row g-9 mb-8">
    <x-v2.table.general-table :with-out-card-body="true">
        @slot('slotTheadTh')
            <th style="width: 20px; vertical-align: middle; text-align: left;">
                Feature
            </th>
            <th style="vertical-align: middle; text-align: left;">Approval
                Type
            </th>
            <th style="vertical-align: middle; text-align: left;">Approved
                By
            </th>
        @endslot
        @slot('slotTbodyTr')
            <tr>
                <td>CRM</td>
                <td>Sales Mapping Approval</td>
                <td>
                    <div class="row g-9 mb-8">
                        <div id="approval_sales_mapping">
                            <div class="form-group">
                                <div
                                    data-repeater-list="approval_sales_mapping">
                                    <div data-repeater-item>
                                        <div
                                            class="d-flex mt-2 w-100 align-items-center">
                                            <select name="employee_id"
                                                    data-dropdown-parent="#{{$dataDropdownParent}}"
                                                    data-kt-repeater="employee_id"
                                                    class="form-control form-control-solid form-control-sm">
                                            </select>
                                            <a href="javascript:;"
                                               data-repeater-delete
                                               class="btn btn-light-danger btn-sm ms-2">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <a href="javascript:;"
                                   data-repeater-create
                                   class="btn btn-light-primary">
                                    + Add More
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>CRM</td>
                <td>Schedule Visit Approval</td>
                <td>
                    <div class="row g-9 mb-8">
                        <div id="approval_schedule_visit">
                            <div class="form-group">
                                <div
                                    data-repeater-list="approval_schedule_visit">
                                    <div data-repeater-item>
                                        <div
                                            class="d-flex mt-2 w-100 align-items-center">
                                            <select name="employee_id"
                                                    data-dropdown-parent="#{{$dataDropdownParent}}"
                                                    data-kt-repeater="employee_id"
                                                    class="form-control form-control-solid form-control-sm">
                                            </select>
                                            <a href="javascript:;"
                                               data-repeater-delete
                                               class="btn btn-light-danger btn-sm ms-2">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <a href="javascript:;"
                                   data-repeater-create
                                   class="btn btn-light-primary">
                                    + Add More
                                </a>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endslot
    </x-v2.table.general-table>
</div>

@push('script')
    {{-- APPROVAL_SALES_MAPPING   --}}
    <script>
        var approvalSalesMapping = $('#approval_sales_mapping').repeater({
            initEmpty: true,

            defaultValues: {
                'text-input': 'Default Outer',
            },

            show: function () {
                $(this).slideDown()
                $(this).find('[data-kt-repeater="employee_id"]').select2({
                    ajax: {
                        url: "{{config('app.urlapi')}}/api/v1/employee/get-all",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                                sort_field: "users.name",
                                sort_direction: "asc"
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.metadata.pagination.total // load more data
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                $(this).find('[data-kt-repeater="employee_id"]').select2({
                    ajax: {
                        url: "{{route('api.get.employees')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total // load more data
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            }
        });
    </script>

    {{--  APPROVAL_SCHEDULE_VISIT  --}}
    <script>
        var approvalScheduleVisit = $('#approval_schedule_visit').repeater({
            initEmpty: true,

            defaultValues: {
                'text-input': 'Default Outer',
            },

            show: function () {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="employee_id"]').select2({
                    ajax: {
                        url: "{{route('api.get.employees')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total // load more data
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                $(this).find('[data-kt-repeater="employee_id"]').select2({
                    ajax: {
                        url: "{{route('api.get.employees')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total // load more data
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            }
        });
    </script>
@endpush
