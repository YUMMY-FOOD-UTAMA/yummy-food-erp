@slot('slotModalForm')
    <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Avatar</h2>
                    </div>
                </div>
                <div class="card-body text-center pt-0">
                    <x-form.image-input name="avatar"/>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column me-n7 pe-7">
                        <div class="row g-9 mb-8">
                            <x-form.input class="col-md-6 fv-row" type="text" label="Full Name" name="full_name"
                                          placeholder="Full Name..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="Name" name="name"
                                          placeholder="Name..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="NIK" name="nik"
                                          placeholder="NIK..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="Email" name="email"
                                          placeholder="Email..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="Bio" name="bio"
                                          placeholder="Biography..."/>
                            <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Birth" name="date_of_birth"
                                          placeholder="Date Of Birth..."/>
                            <x-form.select-box-timezones type="row" drop-down-parent-i-d="modal_createEmployee"
                                                         class="col-md-6 fv-row"/>
                            <x-form.select-box name="role_name" class="col-md-6 fv-row" type="row"
                                               placeholder="Select Role..." value-key="name"
                                               label="Role" drop-down-parent-i-d="modal_createEmployee"
                                               :items="\Spatie\Permission\Models\Role::all()"/>
                            <x-form.select-box name="sub_department_id" class="col-md-6 fv-row" type="row"
                                               placeholder="Select Sub Department..."
                                               label="Sub Department" drop-down-parent-i-d="modal_createEmployee"
                                               :items="$subDepartments"/>

                            <x-form.select-box name="level_grade_id" class="col-md-6 fv-row" type="row"
                                               placeholder="Select Level Name..."
                                               label="Level Name" drop-down-parent-i-d="modal_createEmployee"
                                               custom-name-key="$t->levelName->name.' ('.$t->name.')'"
                                               :items="$levelGrades"/>

                            <x-form.input class="col-md-6 fv-row" type="text" label="Position" name="position"
                                          placeholder="Position..."/>

                            <x-form.input class="col-md-6 fv-row" type="date" label="Join Date" name="join_date"
                                          placeholder="Join Date..."/>

                            <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Exchange Status"
                                          name="date_of_exchange_status"
                                          placeholder="Date Of Exchange Status..."/>

                            <x-form.select-box name="status" class="col-md-6 fv-row" type="row"
                                               placeholder="Status..."
                                               label="Status" drop-down-parent-i-d="modal_createEmployee"
                                               :items="StatusEmployee::valuesObject()"/>
                        </div>
                        <x-form.radio-button-gender class="flex-column mb-8"/>
                        <div class="row g-9 mb-8">
                            <x-form.select-box-geographic type="row" class="col-md-6 fv-row"
                                                          drop-down-parent-i-d="modal_createEmployee"
                                                          form-method="POST"/>
                        </div>
                        <x-form.text-area class="d-flex flex-column mb-8" auto-resize="true" row="2" label="Address"
                                          name="address"
                                          placeholder="Address..."/>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endslot
