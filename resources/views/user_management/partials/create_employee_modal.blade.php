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
                            <x-form.input type="text" class="col-md-6 fv-row" label="Full Name" name="full_name"
                                          :required="true"
                                          placeholder="Full Name..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="Name" name="name"
                                          placeholder="Name..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="NIK" name="nik" :required="true"
                                          placeholder="NIK..."/>
                            <x-form.input class="col-md-6 fv-row" type="text" label="Email" name="email"
                                          id="email_create"
                                          :required="true"
                                          placeholder="Email..."/>
                            <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Birth" name="date_of_birth"
                                          placeholder="Date Of Birth..."/>
                            <x-data-driven.select2.timezone type="row" drop-down-parent-i-d="modal_createEmployee"
                                                            class="col-md-6 fv-row" timezone="Asia/Jakarta"/>
                            <x-form.select-box name="role_name" class="col-md-6 fv-row" type="row"
                                               placeholder="Select Role..." value-key="name" :required="true"
                                               label="Role" drop-down-parent-i-d="modal_createEmployee"
                                               :items="\Spatie\Permission\Models\Role::all()"/>
                            <x-form.select-box name="sub_department_id" class="col-md-6 fv-row" type="row"
                                               placeholder="Select Sub Department..." :required="true"
                                               label="Sub Department" drop-down-parent-i-d="modal_createEmployee"
                                               :items="$subDepartments"/>

                            <x-form.select-box name="level_grade_id" class="col-md-6 fv-row" type="row"
                                               placeholder="Select Level Name..." :required="true"
                                               label="Level Name" drop-down-parent-i-d="modal_createEmployee"
                                               custom-name-key="$t->levelName->name.' ('.$t->name.')'"
                                               :items="$levelGrades"/>

                            <x-form.input class="col-md-6 fv-row" type="text" label="Position" name="position"
                                          placeholder="Position..." :required="true"/>

                            <x-form.input class="col-md-6 fv-row" type="date" label="Join Date" name="join_date"
                                          placeholder="Join Date..." :required="true"/>

                            <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Exchange Status"
                                          name="date_of_exchange_status"
                                          placeholder="Date Of Exchange Status..."/>

                            <x-form.select-box name="status" class="col-md-6 fv-row" type="row"
                                               placeholder="Status..." :required="true"
                                               label="Status" drop-down-parent-i-d="modal_createEmployee"
                                               :items="StatusEmployee::valuesObject()"/>
                        </div>
                        <x-form.radio-button-gender class="flex-column mb-8"/>
                        <div class="row g-9 mb-8">
                            <x-data-driven.select2.geographic type="row" class="col-md-6 fv-row"
                                                              drop-down-parent-i-d="modal_createEmployee"
                                                              form-method="POST"/>
                        </div>
                        <x-form.text-area class="d-flex flex-column mb-8" auto-resize="true" row="2" label="Address"
                                          name="address"
                                          placeholder="Address..."/>

                        <x-form.input type="text" class="d-flex flex-column mb-8" label="Password" name="password"
                                      :required="true" with-clipboard="true" id="password_create"
                                      placeholder="Password..."/>

                        <!--begin::Repeater-->
                        <div class="row g-9 mb-8">
                            <div id="phone_numbers">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="phone_numbers">
                                        <div data-repeater-item>
                                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                <span class="">Phone Number</span>
                                            </label>
                                            <div class="d-flex w-100 align-items-center">
                                                <input type="text" data-kt-repeater="phone_number_masking"
                                                       name="phone_number"
                                                       class="form-control form-control-solid form-control-lg"/>
                                                <a href="javascript:;" data-repeater-delete
                                                   class="btn btn-light-danger ms-2">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="form-group mt-5">
                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                        <i class="ki-duotone ki-plus fs-3"></i>
                                        Add
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                        </div>
                        <!--end::Repeater-->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endslot

@push('script')
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script>
        var $repeater = $('#phone_numbers').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'Default Outer',
            },

            show: function () {
                $(this).slideDown();

                new Inputmask({
                    mask: "(+62) 8[9]{0,20}",
                    placeholder: "(+62) 8xxxxxxx",
                    definitions: {
                        '9': {
                            validator: "[0-9]",
                        }
                    },
                    greedy: false
                }).mask(this.querySelector('[data-kt-repeater="phone_number_masking"]'));
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                new Inputmask({
                    mask: "(+62) 8[9]{0,20}",
                    placeholder: "(+62) 8xxxxxxx",
                    definitions: {
                        '9': {
                            validator: "[0-9]",
                        }
                    },
                    greedy: false
                }).mask(document.querySelector('[data-kt-repeater="phone_number_masking"]'));
            }
        });

        @if(old('phone_numbers'))
        let phoneNumbers = @json(old('phone_numbers'));
        let list = [];

        phoneNumbers.forEach(phone => {
            list.push({
                'phone_number': phone.phone_number
            });
        });

        $repeater.setList(list);
        @endif


        $('[id^="email_create"]').change(function () {
            var email = this.value;
            var password = email.split('@')[0] ? email.split('@')[0] : '';
            $('[id^="password_create"]').val(password);
        });


    </script>
@endpush
