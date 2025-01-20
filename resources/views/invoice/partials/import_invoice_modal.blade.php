@slot('slotModalForm')
    <x-form.input class="d-flex flex-column mb-8"
                  label="Import Invoice" :required="true"
                  placeholder="Import Invoice..."
                  type="file"
                  name="file"/>
    <x-form.input class="d-flex flex-column mb-8"
                  tooltip="Fill in if the customer account invoice data is not yet available in the database"
                  label="Customer Account"
                  placeholder="Customer Account..."
                  type="customer_account_name"
                  name="customer_account_name"/>
@endslot
