<x-table.advance-filter using-apply-button="true" class="mt-5 ms-6 me-6">
    <x-form.input-daterange label="Invoice Date" class="col-12 col-md-3 mb-5" type="row" size-form="sm"
                            :default-value-start-date="request()->start_date"
                            :default-value-end-date="request()->end_date"/>
    <x-form.input-daterange label="Date Created" name-start-date="start_created_at" name-end-date="end_created_at"
                            class="col-12 col-md-3 mb-5" type="row" size-form="sm"
                            :default-value-start-date="request()->start_created_at"
                            :default-value-end-date="request()->end_created_at"/>
    <x-data-driven.select2.customer-invoice size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                            :customer-invoice-i-d="request('customer_invoice_id')"
                                            label="Customer Account Name" account-name="true"
                                            id="customer_account_name"/>
    <x-data-driven.select2.customer-invoice size-form="sm" class="col-12 col-md-3 mb-5" type="row" name-form="customer_name"
                                            :customer-invoice-i-d="request('customer_name')"/>
    <x-data-driven.select2.product-invoice label="Delivery Note" size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                           :product-invoice-i-d="request('product_invoice_id')"/>
    <x-data-driven.select2.invoice size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                   :invoice-i-d="request('invoice_id')"/>
    <x-form.select-box name="bst_number" label="BST Number" form-method="GET"
                       class="col-12 col-md-3 mb-5" type="row" placeholder="Select BST Number..." value-key="bst_number" name-key="bst_number"
                       size-form="sm" :items="$bstNumbers" :default-value="request()->bst_number"/>
</x-table.advance-filter>
