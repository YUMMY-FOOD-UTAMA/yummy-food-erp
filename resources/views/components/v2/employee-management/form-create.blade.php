@props([
    'dataDropdownParent'=>'modal_create_employee'
])
<form class="form" action="" enctype="multipart/form-data"
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
                    <x-form.image-input name="avatar"/>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column me-n7 pe-7">
                        <div class="row g-9 mb-8">
                            <x-v2.form.input type="text" class="col-md-6 fv-row" label="Full Name"
                                             name="full_name" id="full_name_create_employee"
                                             error-message-id="full_name_error"
                                             :required="true"
                                             placeholder="Full Name..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="Name"
                                             name="name" id="name_create_employee" error-message-id="name_error"
                                             placeholder="Name..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="NIK" name="nik"
                                             :required="true" id="nik_create_employee" error-message-id="nik_error"
                                             placeholder="NIK..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="text" label="Email"
                                             name="email"
                                             id="email_create_employee" error-message-id="email_error"
                                             :required="true"
                                             placeholder="Email..."/>
                            <x-v2.form.input class="col-md-6 fv-row" type="date" label="Date Of Birth"
                                             name="date_of_birth" id="date_of_birth_create_employee"
                                             error-message-id="date_of_birth_error"
                                             placeholder="Date Of Birth..."/>
                            <x-data-driven.select2.timezone type="row"
                                                            drop-down-parent-i-d="modal_createEmployee"
                                                            class="col-md-6 fv-row"
                                                            timezone="Asia/Jakarta"/>
                            <x-v2.rbac.select2-roles class="col-md-6 fv-row" :required="true" type="row"
                                                     id="role_id_select2_create"
                                                     data-dropdown-parent="{{$dataDropdownParent}}"
                                                     name="role_id"/>
                            <x-v2.master-data.sub-department.select2 class="col-md-6 fv-row" :required="true" type="row"
                                                                     id="sub_department_select2_create"
                                                                     data-dropdown-parent="{{$dataDropdownParent}}"
                                                                     name="sub_department_id"/>
                            <x-v2.master-data.level-grade.select2 class="col-md-6 fv-row" :required="true" type="row"
                                                                  id="level_grade_select2_create"
                                                                  data-dropdown-parent="{{$dataDropdownParent}}"
                                                                  name="level_grade_id"/>

                            <x-form.input class="col-md-6 fv-row" type="text" label="Position"
                                          name="position"
                                          placeholder="Position..." :required="true"/>

                            <x-form.input class="col-md-6 fv-row" type="date" label="Join Date"
                                          name="join_date"
                                          placeholder="Join Date..." :required="true"/>

                            <x-form.input class="col-md-6 fv-row" type="date"
                                          label="Date Of Exchange Status"
                                          name="date_of_exchange_status"
                                          placeholder="Date Of Exchange Status..."/>

                            <x-form.select-box name="status" class="col-md-6 fv-row" type="row"
                                               placeholder="Status..." :required="true"
                                               label="Status"
                                               drop-down-parent-i-d="modal_createEmployee"
                                               :items="StatusEmployee::valuesObject()"/>
                        </div>
                        <x-form.radio-button-gender class="flex-column mb-8"/>
                        <div class="row g-9 mb-8">
                            <x-data-driven.select2.geographic type="row" class="col-md-6 fv-row"
                                                              drop-down-parent-i-d="modal_createEmployee"
                                                              form-method="POST"/>
                        </div>
                        <x-form.text-area class="d-flex flex-column mb-8" auto-resize="true" row="2"
                                          label="Address"
                                          name="address"
                                          placeholder="Address..."/>

                        <x-form.input type="text" class="d-flex flex-column mb-8" label="Password"
                                      name="password"
                                      :required="true" with-clipboard="true" id="password_create"
                                      placeholder="Password..."/>

                        <!--begin::Repeater-->
                        <div class="row g-9 mb-8">
                            <div id="phone_numbers">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="phone_numbers">
                                        <div data-repeater-item>
                                            <label
                                                class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                                <span class="">Phone Number</span>
                                            </label>
                                            <div class="d-flex w-100 align-items-center">
                                                <input type="text"
                                                       data-kt-repeater="phone_number_masking"
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
                                    <a href="javascript:;" data-repeater-create
                                       class="btn btn-light-primary">
                                        Add
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                        </div>
                        <!--end::Repeater-->

                        <div class="row g-9 mb-8">
                            <x-table.general-table :with-out-card-body="true">
                                @slot('slotTheadTh')
                                    <th style="width: 20px; vertical-align: middle; text-align: left;">
                                        Feature
                                    </th>
                                    <th style="vertical-align: middle; text-align: left;">Approval
                                        Type
                                    </th>
                                    <th style="vertical-align: middle; text-align: left;">Approved
                                        By
                                    </th>
                                @endslot
                                @slot('slotTbodyTr')
                                    @foreach(\App\Utils\Primitives\Enum\EmployeeConfigs::tableValues() as $employeeConfig)
                                        <tr>
                                            <td>{{$employeeConfig->feature}}</td>
                                            <td>{{$employeeConfig->name}}</td>
                                            <td>
                                                @if($employeeConfig->id == \App\Utils\Primitives\Enum\EmployeeConfigs::CRM_APPROVAL_SALES_MAPPING ||
                                                $employeeConfig->id == \App\Utils\Primitives\Enum\EmployeeConfigs::CRM_APPROVAL_SCHEDULE_VISIT) @endif
                                                <div class="row g-9 mb-8">
                                                    <div id="{{$employeeConfig->id}}">
                                                        <!--begin::Form group-->
                                                        <div class="form-group">
                                                            <div
                                                                data-repeater-list="{{$employeeConfig->id}}">
                                                                <div data-repeater-item>
                                                                    <div
                                                                        class="d-flex mt-2 w-100 align-items-center">
                                                                        <select name="employee_id"
                                                                                data-dropdown-parent="#modal_createEmployee"
                                                                                data-kt-repeater="approved_by{{$employeeConfig->id}}"
                                                                                class="form-control form-control-solid form-control-sm">
                                                                        </select>
                                                                        <a href="javascript:;"
                                                                           data-repeater-delete
                                                                           class="btn btn-light-danger btn-sm ms-2">
                                                                            Delete
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Form group-->

                                                        <!--begin::Form group-->
                                                        <div class="form-group mt-5">
                                                            <a href="javascript:;"
                                                               data-repeater-create
                                                               class="btn btn-light-primary">
                                                                + Add More
                                                            </a>

                                                        </div>
                                                        <!--end::Form group-->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endslot
                            </x-table.general-table>
                        </div>
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
