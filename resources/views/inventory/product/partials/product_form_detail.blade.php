@if($viewOnly)
    <div class="row g-9 mb-8">
        <x-form.input
            label="Name"
            name="name"
            type="row"
            :default-value="$product->name"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Code"
            name="code"
            type="row"
            :default-value="$product->code"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Brand Name"
            name="brand_name"
            type="row"
            :default-value="$product->brand->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Type"
            name="item_type"
            type="row"
            :default-value="$product->type->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Manufacture"
            name="item_manufacture"
            type="row"
            :default-value="$product->manufacture->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Manufacture"
            name="item_manufacture"
            type="row"
            :default-value="$product->manufacture->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Category"
            name="category_id"
            type="row"
            :default-value="$product->category->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Group"
            name="group_id"
            type="row"
            :default-value="$product->group->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Division"
            name="division_id"
            type="row"
            :default-value="$product->division->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Small Unit"
            name="small_unit_id"
            type="row"
            :default-value="$product->smallUnit?->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Big Unit"
            name="big_unit_id"
            type="row"
            :default-value="$product->bigUnit?->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

    </div>
@else
    <div class="row g-9 mb-8">
        <x-form.input
            label="Name"
            name="name"
            id="update_product_name"
            type="row"
            :default-value="$product->name"
            class="col-md-6 fv-row"
            required="true"
            :view-only="true"
        />

        <x-form.input
            label="Code"
            name="code"
            id="update_product_code"
            type="row"
            :default-value="$product->code"
            class="col-md-6 fv-row"
            required="true"
            :view-only="true"
        />

        <x-form.select-box
            label="Brand Name"
            placeholder="Select Brand Name"
            name="brand_id"
            id="update_product_brand_id"
            type="row"
            :default-value="$product->brand_id"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataBrands"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Type"
            placeholder="Select Item Type"
            name="type_id"
            id="update_product_type_id"
            type="row"
            :default-value="$product->type_id"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataTypes"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Manufacture"
            placeholder="Select Item Manufacture"
            name="manufacture_id"
            id="update_product_manufacture_id"
            type="row"
            :default-value="$product->manufacture_id"
            class="col-md-6 fv-row"
            required="true"
            :items="$masterDataManufacture"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Category"
            placeholder="Select Item Category"
            name="category_id"
            id="update_product_category_id"
            type="row"
            class="col-md-6 fv-row"
            :default-value="$product->category_id"
            required="true"
            :items="$masterDataCategories"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Group"
            placeholder="Select Item Group"
            name="group_id"
            id="update_product_group_id"
            type="row"
            class="col-md-6 fv-row"
            :default-value="$product->group_id"
            required="true"
            :items="$masterDataGroups"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Division"
            placeholder="Select Item Division"
            name="division_id"
            id="update_product_division_id"
            type="row"
            class="col-md-6 fv-row"
            required="true"
            :default-value="$product->division_id"
            :items="$masterDataDivisions"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Small Unit"
            placeholder="Select Item Small Unit"
            name="small_unit_id"
            id="update_product_small_unit_id"
            type="row"
            class="col-md-6 fv-row"
            :default-value="$product->small_unit_id"
            :items="$masterDataSmallUnits"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

        <x-form.select-box
            label="Item Big Unit"
            placeholder="Select Item Big Unit"
            name="big_unit_id"
            id="update_product_big_unit_id"
            type="row"
            class="col-md-6 fv-row"
            :default-value="$product->big_unit_id"
            :items="$masterDataBigUnits"
            custom-name-key="'('.$t->code.') '.$t->value"
        />
    </div>

@endif