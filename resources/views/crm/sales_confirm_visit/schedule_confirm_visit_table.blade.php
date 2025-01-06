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
                </td>
            </tr>
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
                            <x-form.input class="col-md-6 fv-row" required="true"
                                          label="New Product Request"
                                          name="new_product_request"/>
                            <x-form.text-area class="col-md-6 fv-row" required="true"
                                              label="Customer Feedback"
                                              name="customer_feedback"/>
                        </div>
                    </x-card>

                    <x-card title="Customer Info" id="customer_info_visit">
                        <div class="row g-9 mb-8">
                            <x-form.select2-box-tags name="department" type="row" class="col-md-6 fv-row"
                                                     label="Select Or Add Department"
                                                     placeholder="Select Or Add Department"
                                                     :items="DefaultCustomerDepartment::values()" :required="true"
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
                        Visit
                    </button>
                </form>
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush
@push('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
