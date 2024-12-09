<x-tabs :tabs="[
                        [
                            'id'=>'customer_info'.$customer->id,
                            'title'=>'Customer Information'
                        ],
                        [
                            'id'=>'region_and_location_information'.$customer->id,
                            'title'=>'Region & Location Information'
                        ],
                        [
                            'id'=>'tax_info_and_contact_info'.$customer->id,
                            'title'=>'Tax Information & Contact Information'
                        ],
                ]">
    @slot('slot0')
        <div class="row g-9 mb-8">
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->code"
                          label="Customer Code"
                          name="customer_code"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->name"
                          label="Customer Name"
                          name="customer_name"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->company_name"
                          label="Company Name"
                          name="company_name"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->outlet_name"
                          label="Outlet Name"
                          name="outlet_name"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->alias"
                          label="Alias"
                          name="alias"/>
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
    @endslot
    @slot('slot1')
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
                          :default-value="$customer->province?->name"
                          label="Province"
                          name="province"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->district?->name"
                          label="District"
                          name="district"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->subDistrict?->name"
                          label="Sub District"
                          name="sub_district"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->subDistrictVillage?->name"
                          label="Village"
                          name="village"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->subDistrictVillage?->zip"
                          label="Postal Code"
                          name="postal_code"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->address"
                          label="Address"
                          name="address"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->address_number"
                          label="Address Number"
                          name="address_number"/>
            <x-form.input class="col-md-6 fv-row" view-only="true"
                          :default-value="$customer->rt_rw"
                          label="RT RW"
                          name="rt_rw"/>
        </div>
    @endslot
    @slot('slot2')
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
                          :default-value="$customer->department"
                          label="Department"
                          name="department"/>
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
    @endslot
</x-tabs>
