@slot('slotModalForm')
    <x-card title="Customer Information" id="createCustomerInfo">
        <div class="row g-9 mb-8">
            <x-form.input class="col-md-6 fv-row"
                          label="Customer Name" :required="true"
                          placeholder="Customer Name..."
                          name="name"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Company Name" :must-upper-case="true" :required="true"
                          placeholder="Company Name..."
                          name="company_name"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Outlet Name" :required="true"
                          placeholder="Outlet Name..."
                          name="outlet_name"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Customer Alias"
                          placeholder="Customer Alias..."
                          name="alias"/>
            <x-form.select-box class="col-md-6 fv-row" type="row" :items="\App\Models\Customer\CustomerSegment::all()"
                               name="customer_segment_id" :required="true"
                               placeholder="Select Customer Segment..."
                               drop-down-parent-i-d="modal_createCustomer" label="Customer Segment"/>
            <x-form.select-box class="col-md-6 fv-row" type="row" :items="CustomerStatus::valuesObject()"
                               name="status" :required="true"
                               placeholder="Select Status Customer..."
                               drop-down-parent-i-d="modal_createCustomer" label="Customer Status"/>
            <x-form.select2-box-tags name="customer_group_id" type="row" class="col-md-6 fv-row"
                                     label="Select Or Add Customer Group" placeholder="Select Customer Group..."
                                     tooltip="can be create new Customer Group"
                                     :items="\App\Models\Customer\CustomerGroup::all()" :required="true"
                                     drop-down-parent-i-d="#modal_createCustomer"/>
            <x-form.select-box class="col-md-6 fv-row" type="row" :items="\App\Models\Customer\CustomerCategory::all()"
                               name="customer_category_id" id="customer_category_id_create_modal"
                               placeholder="Select Customer Category..."
                               drop-down-parent-i-d="modal_createCustomer" label="Customer Category"/>
        </div>
    </x-card>

    <x-card title="Region & Location Information" id="createCustomerRegionAndLocationInfo">
        <div class="row g-9 mb-8">
            <x-form.select-box-region class="col-md-6 fv-row" :region-i-d="old('region_id')" type="row"
                                      form-method="POST"
                                      drop-down-parent-i-d="modal_createCustomer"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Address"
                          :required="true"
                          placeholder="Address..."
                          name="address"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Address Number"
                          type="number"
                          placeholder="Address Number..."
                          name="address_number"/>
            <x-form.input-masking class="col-md-6 fv-row" type="rt_rw" :placeholder="true"
                                  name="rt_rw"
                                  label="RT RW"/>
            <x-form.select-box-geographic form-method="POST" class="col-md-6 fv-row" type="row"
                                          :province-i-d="old('province_id')"
                                          drop-down-parent-i-d="createCustomerRegionAndLocationInfo"/>
        </div>
    </x-card>

    <x-card title="Tax Information & Contact Information" id="createCustomerTaxInfoAndContactInfo">
        <div class="row g-9 mb-8">
            <x-form.input class="col-md-6 fv-row"
                          label="NPWP" type="number"
                          placeholder="NPWP..."
                          name="npwp"/>
            <x-form.input class="col-md-6 fv-row"
                          label="NPWP Name" :must-upper-case="true"
                          placeholder="NPWP Name..."
                          name="npwp_name"/>
            <x-form.input class="col-md-6 fv-row"
                          label="NPWP Address"
                          placeholder="NPWP Address..."
                          name="npwp_address"/>
            <x-form.input class="col-md-6 fv-row"
                          label="NPPKP"
                          placeholder="NPPKP..."
                          name="nppkp"/>
            <x-form.select2-box-tags name="department" type="row" class="col-md-6 fv-row"
                                     label="Select Or Add Department" placeholder="Select Or Add Department"
                                     tooltip="can be create new department"
                                     :items="DefaultCustomerDepartment::values()"
                                     drop-down-parent-i-d="#modal_createCustomer"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Contact Person Name"
                          placeholder="Contact Person Name..."
                          name="contact_person_name"/>
            <x-form.input class="col-md-6 fv-row"
                          label="Contact Person Title"
                          placeholder="Contact Person Title..."
                          name="contact_person_title"/>
            <x-form.input-masking class="col-md-6 fv-row" type="phone_number" :placeholder="true"
                                  name="contact_person_phone"
                                  label="Contact Person Phone"></x-form.input-masking>
        </div>
    </x-card>
@endslot
