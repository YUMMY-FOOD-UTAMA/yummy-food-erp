@props([
    'dataDropdownParent'=>'modal_edit_employee'
])
<form class="form" id="editEmployeeForm" action="{{config('app.urlapi')}}/api/v1/employee/create"
      enctype="multipart/form-data"
      method="POST">
    @csrf
    <div class="mb-13 text-center">
        <h1 class="mb-3">Create Employee Data</h1>
    </div>
    <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Avatar</h2>
                    </div>
                </div>
                <div class="card-body text-center pt-0">
                    <x-v2.form.image-input name="avatar" error-message-id="avatar_error"/>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column me-n7 pe-7">
                        <div class="row g-9 mb-8">
                            <x-v2.form.input type="text" class="col-md-6 fv-row" label="Full Name"
                                             name="full_name" id="full_name_edit_employee"
                                             error-message-id="full_name_error"
                                             :required="true"
                                             placeholder="Full Name..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="Name"
                                             name="name" id="name_edit_employee" error-message-id="name_error"
                                             placeholder="Name..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="NIK" name="nik"
                                             :required="true" id="nik_edit_employee" error-message-id="nik_error"
                                             placeholder="NIK..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="Email"
                                             name="email"
                                             id="email_edit_employee" error-message-id="email_error"
                                             :required="true"
                                             placeholder="Email..."/>
                            <x-v2.form.input-date class="col-md-6 fv-row" label="Date Of Birth"
                                                  name="date_of_birth" id="date_of_birth_edit_employee"
                                                  error-message-id="date_of_birth_error"
                                                  placeholder="Date Of Birth..."/>
                            <x-v2.form.select2-timezone type="row"
                                                        drop-down-parent-id="#{{$dataDropdownParent}}"
                                                        class="col-md-6 fv-row"
                                                        timezone="Asia/Jakarta"/>
                            <x-v2.rbac.select2-roles class="col-md-6 fv-row" :required="true" type="row"
                                                     id="role_id_select2_edit"
                                                     data-dropdown-parent="{{$dataDropdownParent}}"
                                                     name="role_id" error-message-id="role_id_error"/>
                            <x-v2.master-data.sub-department.select2 class="col-md-6 fv-row" :required="true" type="row"
                                                                     id="sub_department_select2_edit"
                                                                     data-dropdown-parent="{{$dataDropdownParent}}"
                                                                     name="sub_department_id"
                                                                     error-message-id="sub_department_id_error"/>
                            <x-v2.master-data.level-grade.select2 class="col-md-6 fv-row" :required="true" type="row"
                                                                  id="level_grade_select2_edit"
                                                                  data-dropdown-parent="{{$dataDropdownParent}}"
                                                                  name="level_grade_id"
                                                                  error-message-id="level_grade_id_error"/>

                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="Position"
                                             name="position" id="position_edit_employee"
                                             error-message-id="position_error"
                                             placeholder="Position..." :required="true"/>

                            <x-v2.form.input-date class="col-md-6 fv-row" type="date" label="Join Date"
                                                  name="join_date" id="join_date_edit_employee"
                                                  error-message-id="join_date_error"
                                                  placeholder="Join Date..." :required="true"/>

                            <x-v2.form.input-date class="col-md-6 fv-row" type="date"
                                                  label="Date Of Exchange Status"
                                                  id="date_of_exchange_status_edit_employee"
                                                  error-message-id="date_of_exchange_status_error"
                                                  name="date_of_exchange_status"
                                                  placeholder="Date Of Exchange Status..."/>

                            <x-v2.form.select2 name="status" class="col-md-6 fv-row" type="row"
                                               placeholder="Status..." :required="true"
                                               label="Status" id="status_edit_employee"
                                               error-message-id="status_error"
                                               drop-down-parent-id="#{{$dataDropdownParent}}"
                                               :items="StatusEmployee::valuesObject()"/>
                        </div>
                        <x-v2.form.radio-button-gender class="flex-column mb-8"/>
                        <div class="row g-9 mb-8">
                            <x-data-driven.select2.geographic type="row" class="col-md-6 fv-row"
                                                              drop-down-parent-i-d="{{$dataDropdownParent}}"
                                                              form-method="POST"/>
                        </div>
                        <x-v2.form.text-area class="d-flex flex-column mb-8" auto-resize="true" row="2"
                                             label="Address" id="address_edit_employee"
                                             error-message-id="address_error"
                                             name="address"
                                             placeholder="Address..."/>

                        <x-v2.form.input type="text" class="d-flex flex-column mb-8" label="Password"
                                         name="password"
                                         :required="true" with-clipboard="true" id="password_edit_employee"
                                         error-message-id="password_error"
                                         placeholder="Password..."/>

                        <x-v2.form.repeater.phone-number/>

                        <x-v2.employee.setting data-dropdown-parent="{{$dataDropdownParent}}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary hover-scale">
            <span class="indicator-label">Submit</span>
        </button>
    </div>
</form>

@push('script')
    {{-- Password Auto-fill --}}
    <script>
        $('#email_edit_employee').keyup(function () {
            var email = this.value;
            var password = email.split('@')[0] ? email.split('@')[0] : '';
            $('#password_edit_employee').val(password);
        });
    </script>

    {{-- AJAX Submit Form --}}
    <script>
        $(document).ready(function () {
            $('#editEmployeeForm').submit(function (event) {
                event.preventDefault();

                let form = $(this);
                let formData = new FormData(this);
                $('.error-message').empty().hide();
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('button[type="submit"]').prop('disabled', true).text('Processing...');
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Employee has been created successfully.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        $('.error-message').empty().hide();
                        form[0].reset();
                        $('#employee_datatable').DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        handleErrorResponse(xhr, "_error")
                        $('button[type="submit"]').prop('disabled', false).text('Submit');
                    }
                });
            });
        });
    </script>
@endpush
