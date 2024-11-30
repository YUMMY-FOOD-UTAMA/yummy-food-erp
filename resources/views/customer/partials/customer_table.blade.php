<x-table.general-table :data-table="$customers">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Region Name</th>
        <th style="vertical-align: middle; text-align: left;">Region Covered</th>
        <th style="vertical-align: middle; text-align: left;">Sub Region Name</th>
        <th style="vertical-align: middle; text-align: left;">Area Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Segment</th>
        <th style="vertical-align: middle; text-align: left;">Customer Category</th>
        <th style="vertical-align: middle; text-align: left;">Customer Code</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Contact Person</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->area?->subRegion?->region?->name }}</td>
                <td>{{ $customer->area?->subRegion?->region?->covered }}</td>
                <td>{{ $customer->area->subRegion->name }}</td>
                <td>{{ $customer->area->name }}</td>
                <td>{{ $customer->customerSegment->name }}</td>
                <td>{{ $customer->customerCategory->name }}</td>
                <td>{{ $customer->code }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->contact_person_phone }}</td>
                @if($isTrash)
                    <x-table.action-button restore-route="{{route('receivable.customer.restore',$customer->id)}}"
                                           modal-view-i-d="modal_view{{$customer->id}}"/>
                @else
                    <x-table.action-button
                        modal-view-i-d="modal_view{{$customer->id}}"
                        soft-delete-route="{{route('receivable.customer.destroy',$customer->id)}}"
                        delete-preview="{{$customer->name ?$customer->name:'Customer'}}"/>
                @endif
            </tr>
            <x-modal id="modal_view{{$customer->id}}"
                     :route-view-data="route('receivable.customer.detail',$customer->id)"
                     title="Data {{$customer->name ? $customer->name : 'Customer'}}" size="1000">

                <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#customer_info{{$customer->id}}">Customer Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#region_and_location_information{{$customer->id}}">Region & Location Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tax_info_and_contact_info{{$customer->id}}">Tax Information & Contact Information</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer_info{{$customer->id}}" role="tabpanel">
                        <div class="row g-9 mb-8">
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->code"
                                          label="Customer Code"
                                          name="customer_code"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->name"
                                          label="Name"
                                          name="name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->company_name"
                                          label="Company Name"
                                          name="company_name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->status"
                                          label="Status"
                                          name="status"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->customerSegment->name"
                                          label="Customer Segment"
                                          name="customer_segment"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->customerCategory->name"
                                          label="Customer Category"
                                          name="customer_category"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->customerGroup?->name"
                                          label="Customer Group"
                                          name="customer_group"/>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="region_and_location_information{{$customer->id}}" role="tabpanel">
                        <div class="row g-9 mb-8">
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->area->subRegion->region->name"
                                          label="Region Name"
                                          name="region_name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->area->subRegion->region->covered"
                                          label="Region Covered"
                                          name="region_covered"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->area->subRegion->name"
                                          label="Sub Region Name"
                                          name="name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->area->name"
                                          label="Area Name"
                                          name="area_name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->province"
                                          label="Province"
                                          name="province"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->district"
                                          label="District"
                                          name="district"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->sub_district"
                                          label="Sub District"
                                          name="sub_district"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->village"
                                          label="Village"
                                          name="village"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->postal_code"
                                          label="Postal Code"
                                          name="postal_code"/>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tax_info_and_contact_info{{$customer->id}}" role="tabpanel">
                        <div class="row g-9 mb-8">
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->npwp"
                                          label="NPWP"
                                          name="npwp"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->npwp_name"
                                          label="NPWP Name"
                                          name="npwp_name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->npwp_address"
                                          label="NPWP Address"
                                          name="npwp_address"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->nppkp"
                                          label="NPPKP"
                                          name="nppkp"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->contact_person_name"
                                          label="Contact Person Name"
                                          name="contact_person_name"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->contact_person_title"
                                          label="Contact Person Title"
                                          name="contact_person_title"/>
                            <x-form.input class="col-md-6 fv-row" view-only="true"
                                          :default-value="$customer->contact_person_phone"
                                          label="Contact Person Phone"
                                          name="contact_person_phone"/>
                        </div>
                    </div>
                </div>
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
