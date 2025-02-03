<x-table.advance-filter using-apply-button="true" class="mt-5 ms-6 me-6">
    <x-form.input-daterange label="Date" class="col-12 col-md-3 mb-5" type="row" size-form="sm"
                            :default-value-start-date="request()->start_date"
                            :default-value-end-date="request()->end_date"/>
    <x-data-driven.select2.customer-invoice size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                            :customer-invoice-i-d="request('customer_invoice_id')"
                                            label="Customer Account Name" account-name="true"
                                            id="customer_account_name"/>
    <x-data-driven.select2.customer-invoice size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                            :customer-invoice-i-d="request('customer_invoice_id')"/>
    <x-data-driven.select2.product-invoice label="Delivery Note" size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                           :product-invoice-i-d="request('product_invoice_id')"/>
    <x-data-driven.select2.invoice size-form="sm" class="col-12 col-md-3 mb-5" type="row"
                                   :invoice-i-d="request('invoice_id')"/>
</x-table.advance-filter>
