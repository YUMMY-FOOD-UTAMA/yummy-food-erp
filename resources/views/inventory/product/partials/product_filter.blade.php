<x-table.advance-filter using-apply-button="true" class="mt-5 ms-6 me-6">
    <x-form.select-box
        label="Brand Name"
        placeholder="Select Brand Name"
        name="brand_id"
        id="filter_brand_id"
        type="row"
        class="col-12 col-md-3 mb-5"
        size-form="sm"
        :items="$masterDataBrands"
        custom-name-key="'('.$t->code.') '.$t->value"
        :default-value="request()->brand_id"
    />

    <x-form.select-box
        label="Item Type"
        placeholder="Select Item Type"
        name="type_id"
        id="filter_type_id"
        type="row"
        class="col-12 col-md-3 mb-5"
        size-form="sm"
        :items="$masterDataTypes"
        custom-name-key="'('.$t->code.') '.$t->value"
        :default-value="request()->type_id"
    />

    <x-form.select-box
        label="Item Category"
        placeholder="Select Item Category"
        name="category_id"
        id="filter_category_id"
        type="row"
        class="col-12 col-md-3 mb-5"
        size-form="sm"
        :items="$masterDataCategories"
        custom-name-key="'('.$t->code.') '.$t->value"
        :default-value="request()->category_id"
    />
    
    <x-form.select-box
        label="Item Division"
        placeholder="Select Item Division"
        name="division_id"
        id="filter_division_id"
        type="row"
        class="col-12 col-md-3 mb-5"
        size-form="sm"
        :items="$masterDataDivisions"
        custom-name-key="'('.$t->code.') '.$t->value"
        :default-value="request()->division_id"
    />
</x-table.advance-filter>
