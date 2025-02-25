@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Employee"
                       heading-name="Edit Data {{$employee->user->email != null ? $employee->user->email :'Employee'}}"
                       route-trash-name="user-management.employee.trash"
                       route-list-name="user-management.employee.index">
            </x-toolbar>
        @endslot
        <form action="{{route('user-management.employee.update',$employee->id)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{$employee->user->id}}">
            <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Avatar</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <x-form.image-input name="avatar"
                                                :image="$employee->user->avatar?'users/avatar/'.$employee->user->avatar:''"/>
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
                                                  :default-value="$employee->user->full_name"
                                                  placeholder="Full Name..."/>
                                    <x-form.input class="col-md-6 fv-row" type="text" label="Name" name="name"
                                                  :default-value="$employee->user->name"
                                                  placeholder="Name..."/>
                                    <x-form.input class="col-md-6 fv-row" type="text" label="NIK" name="nik"
                                                  :default-value="$employee->nik"
                                                  :required="true"
                                                  placeholder="NIK..."/>
                                    <x-form.input class="col-md-6 fv-row" type="text" label="Email" name="email"
                                                  :default-value="$employee->user->email"
                                                  id="email_create"
                                                  :required="true"
                                                  placeholder="Email..."/>
                                    <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Birth"
                                                  name="date_of_birth"
                                                  :default-value="$employee->user->date_of_birth"
                                                  placeholder="Date Of Birth..."/>
                                    <x-data-driven.select2.timezone type="row"
                                                                    :default-value="$employee->user->timezone"
                                                                    class="col-md-6 fv-row" timezone="Asia/Jakarta"/>
                                    <x-form.select-box name="role_name" class="col-md-6 fv-row" type="row"
                                                       placeholder="Select Role..." value-key="name" :required="true"
                                                       label="Role"
                                                       :default-value="$employee->user?->roleName()"
                                                       :items="\Spatie\Permission\Models\Role::all()"/>
                                    <x-form.select-box name="sub_department_id" class="col-md-6 fv-row" type="row"
                                                       placeholder="Select Sub Department..." :required="true"
                                                       label="Sub Department"
                                                       :default-value="$employee->sub_department_id"
                                                       id="sub_department_id_create"
                                                       :items="$subDepartments"/>

                                    <x-form.select-box name="level_grade_id" class="col-md-6 fv-row" type="row"
                                                       placeholder="Select Level Name..." :required="true"
                                                       label="Level Name"
                                                       id="level_grade_id_create"
                                                       :default-value="$employee->level_grade_id"
                                                       custom-name-key="$t->levelName->name.' ('.$t->name.')'"
                                                       :items="$levelGrades"/>

                                    <x-form.input class="col-md-6 fv-row" type="text" label="Position" name="position"
                                                  placeholder="Position..." :required="true"
                                                  :default-value="$employee->position"/>

                                    <x-form.input class="col-md-6 fv-row" type="date" label="Join Date" name="join_date"
                                                  placeholder="Join Date..." :required="true"
                                                  :default-value="$employee->join_date"/>

                                    <x-form.input class="col-md-6 fv-row" type="date" label="Date Of Exchange Status"
                                                  name="date_of_exchange_status"
                                                  :default-value="$employee->date_of_exchange_status"
                                                  placeholder="Date Of Exchange Status..."/>

                                    <x-form.select-box name="status" class="col-md-6 fv-row" type="row"
                                                       placeholder="Status..." :required="true"
                                                       :default-value="$employee->status"
                                                       label="Status"
                                                       :items="StatusEmployee::valuesObject()"/>
                                </div>
                                <x-form.radio-button-gender class="flex-column mb-8"
                                                            :default-value="$employee->user->gender"/>
                                <div class="row g-9 mb-8">
                                    <x-data-driven.select2.geographic type="row" class="col-md-6 fv-row"
                                                                      :province-i-d="$employee->user->province_id"
                                                                      :district-i-d="$employee->user->district_id"
                                                                      :sub-district-i-d="$employee->user->sub_district_id"
                                                                      :sub-district-village-i-d="$employee->user->sub_district_village_id"
                                                                      form-method="POST"/>
                                </div>
                                <x-form.text-area class="d-flex flex-column mb-8" auto-resize="true" row="2"
                                                  label="Address"
                                                  name="address"
                                                  placeholder="Address..." :default-value="$employee->user->address"/>

                                <x-form.input type="text" class="d-flex flex-column mb-8" label="Password"
                                              name="password"
                                              with-clipboard="true" id="password_create"
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
                                            <th style="width: 20px; vertical-align: middle; text-align: left;">Feature
                                            </th>
                                            <th style="vertical-align: middle; text-align: left;">Approval Type</th>
                                            <th style="vertical-align: middle; text-align: left;">Approved By</th>
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
                                                                    <div data-repeater-list="{{$employeeConfig->id}}">
                                                                        <div data-repeater-item>
                                                                            <div
                                                                                class="d-flex mt-2 w-100 align-items-center">
                                                                                <select name="employee_id"
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
                                                                    <a href="javascript:;" data-repeater-create
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
            <div class="d-flex justify-content-end gap-3">
                <a href="{{route('receivable.customer.index')}}" class="btn btn-danger">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <span class="indicator-label">Update</span>
                </button>
            </div>
        </form>
    </x-general-section-content>

@endsection
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
                    mask: "(+62) [9]{0,20}",
                    placeholder: "(+62) xxxxxxxx",
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
                    mask: "(+62) [9]{0,20}",
                    placeholder: "(+62) xxxxxxxx",
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
        @elseif($employee->phoneNumbers())
        let phoneNumbers = @json($employee->phoneNumbers());
        let list = [];

        phoneNumbers.forEach(phone => {
            list.push({
                'phone_number': phone
            });
        });

        console.log(list)
        $repeater.setList(list);
        @endif


        $('[id^="email_create"]').change(function () {
            var email = this.value;
            var password = email.split('@')[0] ? email.split('@')[0] : '';
            $('[id^="password_create"]').val(password);
        });
    </script>

    {{-- APPROVAL_SALES_MAPPING   --}}
    <script>
        var $repeater = $('#APPROVAL_SALES_MAPPING').repeater({
            initEmpty: false,

            defaultValues: {
                'employee_id': ''
            },

            show: function () {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="approved_byAPPROVAL_SALES_MAPPING"]').select2({
                    ajax: {
                        url: "{{ route('api.get.employees') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                $('[data-kt-repeater="approved_byAPPROVAL_SALES_MAPPING"]').select2({
                    ajax: {
                        url: "{{ route('api.get.employees') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            }
        });

        let employeeConfigs = @json($employee->employeeConfigs);
        let approvalSalesMapping = [];

        employeeConfigs.forEach(employeeConfig => {
            if (employeeConfig.type === "APPROVAL_SALES_MAPPING") {
                employeeConfig.externalEmployees.forEach(approval => {
                    approvalSalesMapping.push({
                        'employee_id': approval.id,
                    });
                })
            }
        });

        if (approvalSalesMapping.length > 0) {
            console.log(approvalSalesMapping)
            $repeater.setList(approvalSalesMapping);

            setTimeout(() => {
                $('#APPROVAL_SALES_MAPPING').find('[data-kt-repeater="approved_byAPPROVAL_SALES_MAPPING"]').each(function (index) {
                    let $select = $(this);
                    let employeeId = approvalSalesMapping[index].employee_id;
                    if (employeeId) {
                        $.ajax({
                            url: "/api/employee/" + employeeId,
                            dataType: 'json',
                            success: function (data) {
                                let employee = data.result;
                                let option = new Option(employee.user.name, employee.id, true, true);
                                $select.append(option).trigger('change');
                            }
                        });
                    }
                });
            }, 500);
        }
    </script>

    {{--  APPROVAL_SCHEDULE_VISIT  --}}
    <script>
        var $repeater = $('#APPROVAL_SCHEDULE_VISIT').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'Default Outer',
            },

            show: function () {
                $(this).slideDown();

                $('[data-kt-repeater="approved_byAPPROVAL_SCHEDULE_VISIT"]').select2({
                    ajax: {
                        url: "{{route('api.get.employees')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total // load more data
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                $('[data-kt-repeater="approved_byAPPROVAL_SCHEDULE_VISIT"]').select2({
                    ajax: {
                        url: "{{route('api.get.employees')}}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                                page_size: 25,
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            return {
                                results: data.result.data.map(function (item) {
                                    return {
                                        id: item.id,
                                        text: item.user.name
                                    };
                                }),
                                pagination: {
                                    more: (params.page * 25) < data.result.total // load more data
                                }
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: 'Select an Approval',
                });
            }
        });

        let approvalScheduleVisit = [];

        employeeConfigs.forEach(employeeConfig => {
            if (employeeConfig.type === "APPROVAL_SCHEDULE_VISIT") {
                employeeConfig.externalEmployees.forEach(approval => {
                    approvalScheduleVisit.push({
                        'employee_id': approval.id,
                    });
                })
            }
        });

        if (approvalScheduleVisit.length > 0) {
            console.log(approvalScheduleVisit)
            $repeater.setList(approvalScheduleVisit);

            setTimeout(() => {
                $('#APPROVAL_SCHEDULE_VISIT').find('[data-kt-repeater="approved_byAPPROVAL_SCHEDULE_VISIT"]').each(function (index) {
                    let $select = $(this);
                    let employeeId = approvalScheduleVisit[index].employee_id;
                    if (employeeId) {
                        $.ajax({
                            url: "/api/employee/" + employeeId,
                            dataType: 'json',
                            success: function (data) {
                                let employee = data.result;
                                let option = new Option(employee.user.name, employee.id, true, true);
                                $select.append(option).trigger('change');
                            }
                        });
                    }
                });
            }, 500);
        }
    </script>
@endpush
