<x-table.general-table :data-table="$scheduleVisits" :type="$isDashboard?'not-bordered':null">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        @if(!$isDashboard)
            <th style="vertical-align: middle; text-align: left;">Customer Address</th>
        @endif
        <th style="vertical-align: middle; text-align: left;">Visit Range Date</th>
        @if(!$isDashboard)
            <th style="vertical-align: middle; text-align: left;">Visit Status</th>
            <th style="vertical-align: middle; text-align: left;">Expired</th>
        @endif
        <th style="vertical-align: middle; text-align: left;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($scheduleVisits as $scheduleVisit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$scheduleVisit->customer->name}}</td>
                @if(!$isDashboard)
                    <td>{{$scheduleVisit->customer->address}}</td>
                @endif
                <td>{{$scheduleVisit->rangeDate()}}</td>
                @if(!$isDashboard)
                    <td>
                    <span
                        class="{{VisitStatus::getSpanClass($scheduleVisit->status) }}">{{ $scheduleVisit->status === VisitStatus::APPROVED ? "Pending": $scheduleVisit->status }}</span>
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($scheduleVisit->end_visit)->addDay()->format('d M Y') }}
                    </td>
                @endif
                <td>
                    @if($scheduleVisit->status === VisitStatus::APPROVED)
                        <a href="" data-bs-toggle="modal" id="triggerMap{{$scheduleVisit->id}}"
                           data-bs-target="#modal_visit{{$scheduleVisit->id}}"
                           class="btn btn-success btn-sm mx-1 edit-td-action-btn mb-2">
                            Visit
                        </a>
                    @endif
                    @include('crm.partials.crm_modal_view_detail', ['scheduleVisit' => $scheduleVisit])
                    <x-modal id="modal_visit{{$scheduleVisit->id}}"
                             title="Visit Confirmation" size="1000">
                        <form method="POST"
                              action="{{ route('receivable.crm.sales-confirm-visit.confirm', $scheduleVisit->id) }}">
                            @csrf
                            @method('PUT')
                            <x-card id="geo_info" title="Geolocation Info">
                                <div id="map{{$scheduleVisit->id}}"
                                     style="height: 400px;width: 100%"></div>
                                <x-form.input class="fv-row mb-10" view-only="true" name="dummy"
                                              id="address{{$scheduleVisit->id}}" label="Address"></x-form.input>
                                <input type="hidden" name="address" id="addressHidden{{$scheduleVisit->id}}">
                                <div class="row g-9 mb-8">
                                    <x-form.input class="col-md-6 fv-row"
                                                  :default-value="$scheduleVisit->customer->address"
                                                  label="Customer Address" view-only="true"
                                                  name="customer_address"/>
                                    <x-form.input class="col-md-6 fv-row"
                                                  :default-value="$scheduleVisit->employee->user->name"
                                                  label="Sales Name" view-only="true"
                                                  name="employee_name"/>
                                    <x-form.input class="col-md-6 fv-row"
                                                  :default-value="$scheduleVisit->customer->name"
                                                  label="Customer Name" view-only="true"
                                                  name="customer_name"/>
                                    <x-form.input class="col-md-6 fv-row"
                                                  :default-value="$scheduleVisit->rangeDate()"
                                                  label="Visit Date" view-only="true"
                                                  name="visit_range_date"/>
                                </div>

                                <div id="product_request{{$scheduleVisit->id}}"
                                     class="border rounded p-4 justify-content-center">
                                    <div class="form-group mb-4">
                                        <label class="form-label fw-bold">Product Request</label>
                                    </div>

                                    <div class="form-group p-sm-5">
                                        <div data-repeater-list="product_request{{$scheduleVisit->id}}">
                                            <div data-repeater-item>
                                                <div class="form-group row mb-3 pb-3 border-bottom">
                                                    <div class="col-md-6 col-12">
                                                        <label class="form-label">Select Product:</label>
                                                        <select class="form-select form-select-solid"
                                                                name="product_request_id"
                                                                data-dropdown-parent="#modal_visit{{$scheduleVisit->id}}"
                                                                data-kt-repeater="productRequest{{$scheduleVisit->id}}"
                                                                data-placeholder="Select an product">
                                                        </select>
                                                        <label class="form-label mt-3">Description:</label>
                                                        <textarea class="form-control form-control-solid"
                                                                  data-kt-autosize="true"
                                                                  name="product_request_description"
                                                                  rows="1"></textarea>
                                                    </div>
                                                    <div class="col-md-4 col-12">
                                                        <label class="form-label">Qty:</label>
                                                        <input type="number" name="product_request_qty"
                                                               class="form-control form-control-solid"
                                                               placeholder="Enter quantity"/>
                                                    </div>
                                                    <div class="col-md-2 col-12 mt-9">
                                                        <a href="javascript:;" data-repeater-delete
                                                           class="btn btn-flex btn-sm btn-light-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;" data-repeater-create
                                       class="mt-10 btn btn-flex btn-light-primary">
                                        + Add More Product
                                    </a>
                                </div>

                                <x-form.text-area class="fv-row mb-10 mt-3"
                                                  label="Sales Note"
                                                  name="sales_note"
                                                  placeholder="Sales Notes..."></x-form.text-area>
                            </x-card>

                            <x-card title="Customer Info" id="customer_info_visit">
                                <div class="row g-9 mb-8">
                                    <x-form.select2-box-tags name="department" type="row" class="col-md-6 fv-row"
                                                             label="Select Or Add Department"
                                                             placeholder="Select Or Add Department"
                                                             :items="DefaultCustomerDepartment::values()"
                                                             :required="true"
                                                             drop-down-parent-i-d="#customer_info_visit"
                                                             :default-value="$scheduleVisit->customer->department"/>
                                    <x-form.input class="col-md-6 fv-row" required="true"
                                                  label="Contact Person Name"
                                                  :default-value="$scheduleVisit->customer->contact_person_name"
                                                  name="contact_person_name"/>
                                    <x-form.input class="col-md-6 fv-row" required="true"
                                                  label="Contact Person Title"
                                                  :default-value="$scheduleVisit->customer->contact_person_title"
                                                  name="contact_person_title"/>
                                    <x-form.input-masking class="col-md-6 fv-row" required="true"
                                                          label="Contact Person Phone"
                                                          :default-value="$scheduleVisit->customer->contact_person_phone"
                                                          name="contact_person_phone" type="phone_number"/>
                                </div>
                            </x-card>
                            <button type="submit" class="btn btn-primary"
                                    id="btnVisitModal{{$scheduleVisit->id}}" disabled>
                                Submit
                            </button>
                        </form>
                    </x-modal>
                </td>
            </tr>

        @endforeach
    @endslot
</x-table.general-table>
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush
@push('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('[id^="product_request"]').repeater({
                initEmpty: false,

                show: function () {
                    $(this).slideDown();
                    $('[data-kt-repeater^="productRequest"]').select2({
                        ajax: {
                            url: "{{route('api.get.products')}}",
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
                                            text: item.name
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
                        placeholder: 'Select an Product',
                    });
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function () {
                    $('[data-kt-repeater^="productRequest"]').select2({
                        ajax: {
                            url: "{{route('api.get.products')}}",
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
                                            text: item.name
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
                        placeholder: 'Select an Product',
                    });
                }
            });
        });

    </script>
    <script>
        window.addEventListener('DOMContentLoaded', function () {

            @foreach($scheduleVisits as $scheduleVisit)
            $('#triggerMap{{$scheduleVisit->id}}').click(function () {
                setTimeout(function () {
                    const map{{$scheduleVisit->id}} = L.map('map{{$scheduleVisit->id}}').setView([0, 0], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map{{$scheduleVisit->id}});

                    let marker{{$scheduleVisit->id}};

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;

                            map{{$scheduleVisit->id}}.setView([latitude, longitude], 15);

                            if (marker{{$scheduleVisit->id}}) {
                                map{{$scheduleVisit->id}}.removeLayer(marker{{$scheduleVisit->id}});
                            }

                            marker{{$scheduleVisit->id}} = L.marker([latitude, longitude]).addTo(map{{$scheduleVisit->id}});

                            getAddressFromOSM(latitude, longitude, {{$scheduleVisit->id}}, marker{{$scheduleVisit->id}});
                        }, function (error) {
                            alert('Error detecting location: ' + error.message);
                        })
                    } else {
                        alert('Geolocation is not supported by your browser.');
                    }


                }, 2000);
            })
            @endforeach

            function getAddressFromOSM(lat, lon, id, marker) {
                const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.display_name) {
                            $(`#address${id}`).val(data.display_name);
                            $(`#addressHidden${id}`).val(data.display_name);
                            marker.bindPopup(data.display_name).openPopup();
                            document.getElementById(`btnVisitModal${id}`).disabled = false;
                        } else {
                            alert('Alamat tidak ditemukan!');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        })
    </script>
@endpush
