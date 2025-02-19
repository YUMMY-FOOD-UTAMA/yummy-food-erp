@slot('slotModalForm')
    <x-form.input class="d-flex flex-column mb-8"
                  label="Import Invoice" :required="true"
                  placeholder="Import Invoice..."
                  type="file"
                  name="file"/>

    <label class="d-flex align-items-center fs-6 fw-semibold mt-2 mb-2">
        <span class="required">Type Import Invoice</span>
    </label>
    <select name="type" aria-label="Type Import Invoice" data-allow-clear="true"
            data-control="select2" required data-dropdown-parent="#modal_createInvoice"
            data-placeholder="Type Import Invoice"
            class="form-select form-select-solid form-select-lg">
        <option value="multiple_invoice">Multiple/Group Invoice</option>
        <option value="single_invoice">Single Invoice</option>
    </select>
@endslot
