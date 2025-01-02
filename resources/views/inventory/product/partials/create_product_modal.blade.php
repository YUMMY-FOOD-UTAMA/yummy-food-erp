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
            label="Item Packing Size"
            placeholder="Select Item Packing Size"
            name="packing_size_id"
            drop-down-parent-i-d="modal_createProduct"
            id="create_product_packing_size_id"
            type="row"
            class="col-md-6 fv-row"
            :required="true"
            :items="$masterDataPackingSize"
            custom-name-key="'('.$t->code.') '.$t->value"
        />

    </div>
    <div class="row g-9 mb-8">
        <x-form.input type="text" class="col-md-6 fv-row" id="product_code" label="Product Code" name="product_code"
                      view-only="true"/>
        <x-form.input type="text" class="col-md-6 fv-row" id="product_name" label="Product Name" name="product_name"
                      view-only="true"/>
    </div>
@endslot
@push('script')
    <script>
        function checkAllInputs() {
            const brandId = document.getElementById('create_product_brand_id').value;
            const divisionId = document.getElementById('create_product_division_id').value;
            const categoryId = document.getElementById('create_product_category_id').value;
            const typeId = document.getElementById('create_product_type_id').value;
            const packingSizeId = document.getElementById('create_product_packing_size_id').value;

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
                        document.getElementById('product_code').value = data.result.productCode;
                        document.getElementById('product_name').value = data.result.productName;
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        $('#create_product_division_id, #create_product_brand_id, #create_product_category_id, #create_product_type_id, #create_product_packing_size_id').change(function () {
            checkAllInputs();
        });

    </script>
@endpush
