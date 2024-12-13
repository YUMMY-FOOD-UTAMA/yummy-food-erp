@slot('slotModalForm')
    <div class="row g-9 mb-8">
        <x-form.select-box
            label="Brand Name"
            placeholder="Select Brand Name"
            name="brand_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_brand_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataBrands"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Type"
            placeholder="Select Item Type"
            name="type_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_type_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataTypes"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Manufacture"
            placeholder="Select Item Manufacture"
            name="manufacture_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_manufacture_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataManufacture"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Category"
            placeholder="Select Item Category"
            name="category_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_category_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataCategories"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Group"
            placeholder="Select Item Group"
            name="group_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_group_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataGroups"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Division"
            placeholder="Select Item Division"
            name="division_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_division_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataDivisions"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Small Unit"
            placeholder="Select Item Small Unit"
            name="small_unit_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_small_unit_id"
            type="row"
            class="col-md-6 fv-row"
            :items="$masterDataSmallUnits"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Big Unit"
            placeholder="Select Item Big Unit"
            name="big_unit_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_big_unit_id"
            type="row"
            class="col-md-6 fv-row"
            :items="$masterDataBigUnits"
            custom-name-key="'('.$t->code.') '.$t->value"
        />
    </div>
@endslot
