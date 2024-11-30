@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Customer"
                       heading-name="Edit Data {{$customer->name == null ? $customer->name :'Customer'}}"
                       route-create-name="receivable.customer.store" using-create-modal="true"
                       route-trash-name="receivable.customer.trash" route-list-name="receivable.customer.index">
                @include('customer.partials.create_customer_modal')
            </x-toolbar>
        @endslot
        <form action="{{route('receivable.customer.update',$customer->id)}}" method="POST">
            @csrf
            @method('PUT')

            <x-card title="Customer Information" id="createCustomerInfo">
                <div class="row g-9 mb-8">
                    <x-form.input class="col-md-6 fv-row"
                                  label="Customer Code" :view-only="true"
                                  name="code" :default-value="$customer->code"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Customer Name" :required="true"
                                  placeholder="Customer Name..." :default-value="$customer->name"
                                  name="name"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Company Name" :required="true"
                                  placeholder="Company Name..."
                                  name="company_name" :default-value="$customer->company_name"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Outlet Name" :required="true"
                                  placeholder="Outlet Name..." :default-value="$customer->outlet_name"
                                  name="outlet_name"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Alias" :default-value="$customer->alias"
                                  placeholder="Alias..."
                                  name="alias"/>
                    <x-form.select-box class="col-md-6 fv-row" type="row"
                                       :items="\App\Models\Customer\CustomerSegment::all()"
                                       name="customer_segment_id" :required="true"
                                       :default-value="$customer->customer_segment_id"
                                       placeholder="Select Customer Segment..."
                                       label="Customer Segment"/>
                    <x-form.select-box class="col-md-6 fv-row" type="row" :items="CustomerStatus::valuesObject()"
                                       name="status" :required="true" :default-value="$customer->status"
                                       placeholder="Select Status Customer..."
                                       label="Customer Status"/>
                    <x-form.select-box class="col-md-6 fv-row" type="row"
                                       :items="\App\Models\Customer\CustomerCategory::all()"
                                       name="customer_category_id" :required="true"
                                       :default-value="$customer->customer_category_id"
                                       placeholder="Select Customer Category..."
                                       label="Customer Category"/>
                    <x-form.select-box class="col-md-6 fv-row" type="row"
                                       :items="\App\Models\Customer\CustomerGroup::all()"
                                       name="customer_group_id" :default-value="$customer->customer_group_id"
                                       placeholder="Select Customer Group..."
                                       label="Customer Group"/>
                </div>
            </x-card>

            <x-card title="Region & Location Information" id="createCustomerRegionAndLocationInfo">
                <div class="row g-9 mb-8">
                    <x-form.select-box-region class="col-md-6 fv-row"
                                              :region-i-d="old('region_id',$customer->area->subRegion->region->id)"
                                              :sub-region-i-d="$customer->area->subRegion->id"
                                              :area-i-d="$customer->area_id"
                                              type="row"
                                              form-method="POST"
                    />
                    <x-form.input class="col-md-6 fv-row"
                                  label="Province" :default-value="$customer->province"
                                  placeholder="Province..."
                                  name="province"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="District" :default-value="$customer->district"
                                  placeholder="District..."
                                  name="district"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Sub District" :default-value="$customer->sub_district"
                                  placeholder="Sub District..."
                                  name="sub_district"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Village" :default-value="$customer->village"
                                  placeholder="Village..."
                                  name="village"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Postal Code"
                                  type="number" :default-value="$customer->postal_code"
                                  placeholder="Postal Code..."
                                  name="postal_code"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Address" :default-value="$customer->address"
                                  placeholder="Address..."
                                  name="address"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Address Number" :default-value="$customer->address_number"
                                  type="number"
                                  placeholder="Address Number..."
                                  name="address_number"/>
                    <x-form.input-masking class="col-md-6 fv-row" type="rt_rw" :placeholder="true"
                                          name="rt_rw" :default-value="$customer->rt_rw"
                                          label="RT RW"></x-form.input-masking>
                </div>
            </x-card>

            <x-card title="Tax Information & Contact Information" id="createCustomerTaxInfoAndContactInfo">
                <div class="row g-9 mb-8">
                    <x-form.input class="col-md-6 fv-row"
                                  label="NPWP"
                                  placeholder="NPWP..." :default-value="$customer->npwp"
                                  name="npwp"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="NPWP Name" :default-value="$customer->npwp_name"
                                  placeholder="NPWP Name..."
                                  name="npwp_name"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="NPWP Address" :default-value="$customer->npwp_address"
                                  placeholder="NPWP Address..."
                                  name="npwp_address"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="NPPKP" :default-value="$customer->nppkp"
                                  placeholder="NPPKP..."
                                  name="nppkp"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Contact Person Name" :default-value="$customer->contact_person_name"
                                  placeholder="Contact Person Name..."
                                  name="contact_person_name"/>
                    <x-form.input class="col-md-6 fv-row"
                                  label="Contact Person Title" :default-value="$customer->contact_person_title"
                                  placeholder="Contact Person Title..."
                                  name="contact_person_title"/>
                    <x-form.input-masking class="col-md-6 fv-row" type="phone_number" :placeholder="true"
                                          name="contact_person_phone" :default-value="$customer->contact_person_phone"
                                          label="Contact Person Phone"></x-form.input-masking>
                </div>
            </x-card>
            <div class="d-flex gap-3">
                <a href="{{route('receivable.customer.index')}}" class="btn btn-danger">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Update</span>
                </button>
            </div>
        </form>
    </x-general-section-content>

@endsection
