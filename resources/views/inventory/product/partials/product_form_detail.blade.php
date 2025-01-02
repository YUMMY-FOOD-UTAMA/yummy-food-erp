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
            label="Item Division"
            name="division_id"
            type="row"
            :default-value="$product->division->value"
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
            label="Item Type"
            name="item_type"
            type="row"
            :default-value="$product->type->value"
            class="col-md-6 fv-row"
            :view-only="true"
        />

        <x-form.input
            label="Item Packing Size"
            name="packing_size_id"
            type="row"
            :default-value="$product->packingSize?->value"
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
            label="Item Packing Size"
            placeholder="Select Item Packing Size"
            name="packing_size_id"
            id="update_product_packing_size_id"
            type="row"
            class="col-md-6 fv-row"
            :default-value="$product->packing_size_id"
            :items="$masterDataPackingSize"
            custom-name-key="'('.$t->code.') '.$t->value"
        />
    </div>
    @push('script')
        <script>
            function checkAllInputs() {
                const brandId = document.getElementById('update_product_brand_id').value;
                const divisionId = document.getElementById('update_product_division_id').value;
                const categoryId = document.getElementById('update_product_category_id').value;
                const typeId = document.getElementById('update_product_type_id').value;
                const packingSizeId = document.getElementById('update_product_packing_size_id').value;

                if (brandId && divisionId && categoryId && typeId && packingSizeId) {
                    fetch('/api/product/generate-name-code', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            brandId: brandId,
                            divisionId: divisionId,
                            categoryId: categoryId,
                            typeId: typeId,
                            packingSizeId: packingSizeId
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('update_product_code').value = data.result.productCode;
                            document.getElementById('update_product_name').value = data.result.productName;
                        })
                        .catch(error => console.error('Error:', error));
                }
            }

            $('#update_product_division_id, #update_product_brand_id, #update_product_category_id, #update_product_type_id, #update_product_packing_size_id').change(function () {
                checkAllInputs();
            });

        </script>
    @endpush
@endif
