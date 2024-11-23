@slot('slotModalForm')
    <div class="row g-9 mb-8">
        <x-form.input class="col-md-6 fv-row" type="text" label="Full Name" name="full_name"
                      placeholder="Full Name..."></x-form.input>
        <x-form.input class="col-md-6 fv-row" type="text" label="Name" name="name"
                      placeholder="Name..."></x-form.input>
        <x-form.input class="col-md-6 fv-row" type="text" label="Email" name="email"
                      placeholder="Email..."></x-form.input>
        <x-form.input class="col-md-6 fv-row" type="text" label="Bio" name="bio"
                      placeholder="Biography..."></x-form.input>
        <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Birth" name="date_of_birth"
                      placeholder="Date Of Birth..."></x-form.input>
        <x-form.select-box-timezones type="row" drop-down-parent-i-d="modal_createUser"
                                     class="col-md-6 fv-row"></x-form.select-box-timezones>
    </div>
    <x-form.radio-button-gender class="flex-column mb-8"></x-form.radio-button-gender>
    <x-form.select-box-geographic type="row" drop-down-parent-i-d="modal_createUser"
                                  form-method="POST"></x-form.select-box-geographic>
    <x-form.text-area class="d-flex flex-column mb-8" auto-resize="true" row="2" label="Address"
                      name="address"
                      placeholder="Address..."></x-form.text-area>
@endslot
