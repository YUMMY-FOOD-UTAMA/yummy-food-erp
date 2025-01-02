<x-table.advance-filter using-apply-button="true" class="mt-5 ms-6 me-6">
    <x-data-driven.select2.region class="col-12 col-md-3 mb-5" type="row" size-form="sm" :region-i-d="request()->region_id"
                              form-method="GET"/>
    <x-form.select-box name="customer_category_id" label="Customer Category" form-method="GET"
                       class="col-12 col-md-3 mb-5" type="row" placeholder="Select Customer Category..."
                       size-form="sm" :items="\App\Models\Customer\CustomerCategory::all()" :default-value="request()->customer_category_id"/>
</x-table.advance-filter>
