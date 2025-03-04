@props([
    'id'=>'employee_datatable',
    'subDepartmentIdFilter'=>"filter_sub_department_id",
    'levelGradeIdFilter'=>"filter_level_grade_id",
    'roleIdFilter'=>"filter_role_id",
    'searchFilter'=>'filter_search_id',
    'modalDetailId'=>'modal_edit_employee',
    'btnDetailViewId'=>'btn_detail_view_employee'
])
@push('css')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endpush
<table id="{{$id}}" class="table table-bordered table-row-bordered gy-3 gs-5">
    <thead>
    <tr class="fw-semibold fs-6 text-gray-800">
        <th>Name</th>
        <th>NIK</th>
        <th>Email</th>
        <th>Sub Department</th>
        <th>Position</th>
        <th>Level Name</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    </thead>
</table>
<div class="modal fade" id="{{$modalDetailId}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-1000px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                      transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <x-v2.employee.form-edit/>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        const datatableEmployee = $("#{{$id}}").DataTable({
            "fixedHeader": {
                "header": true
            },
            ordering: false,
            "ajax": function (data, callback, settings) {
                const filters = {};

                document.querySelectorAll('select[id^="selectRegion"]').forEach(filterEl => {
                    filters[filterEl.name] = filterEl.value;
                });
                filters['role_id'] = $('#{{$roleIdFilter}}').val()
                filters['sub_department_id'] = $('#{{$subDepartmentIdFilter}}').val()
                filters['level_grade_id'] = $('#{{$levelGradeIdFilter}}').val()
                filters['search'] = $('#{{$searchFilter}}').val()
                $.get("{{config('app.urlapi')}}/api/v1/employee/get-all", {
                        page_size: data.length,
                        page: (data.start / data.length) + 1,
                        sort_direction: "desc",
                        sort_field: "employees.created_at",
                        ...filters
                    },
                    function (json) {
                        console.log(json.metadata)
                        callback({
                            recordsTotal: json.metadata.pagination.total,
                            recordsFiltered: json.metadata.pagination.total,
                            data: json.data
                        });
                    });
            },
            processing: true,
            serverSide: true,
            pageLength: 10,
            searching: true,
            aoColumns: [
                {
                    data: 'user.name',
                },
                {
                    data: 'nik',
                },
                {
                    data: 'user.email',
                },
                {
                    data: 'sub_department.name',
                },
                {
                    data: 'position',
                },
                {
                    data: 'level_grade.level_name.name',
                },
                {
                    data: 'user.role_name',
                },
                {
                    data: null, // Kolom untuk tombol Actions
                    orderable: false, // Tidak bisa diurutkan
                    searchable: false, // Tidak bisa dicari
                    render: function (data, type, row) {
                        return `
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-primary btn-active-light-primary"
                                   style="height: 24px; display: inline-flex; align-items: center;"
                                   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    Actions
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a class="menu-link px-3" data-bs-toggle="modal"
                                            data-employee='${JSON.stringify(row).replace(/'/g, "&#39;")}'
                                            id="{{$btnDetailViewId}}"
                                            data-bs-target="#{{$modalDetailId}}">View</a>
                                    </div>
                                </div>
                            </td>`;
                    },
                }
            ],
            drawCallback: function () {
                KTMenu.init();
            }
        });

        $('#{{$subDepartmentIdFilter}}').on('change', function () {
            datatableEmployee.ajax.reload()
        })
        $('#{{$levelGradeIdFilter}}').on('change', function () {
            datatableEmployee.ajax.reload()
        })
        $('#{{$roleIdFilter}}').on('change', function () {
            datatableEmployee.ajax.reload()
        })
        $('#{{$searchFilter}}').on('keyup', function () {
            datatableEmployee.ajax.reload()
        })
    </script>

    <script>
        function updateGenderSelection(value) {
            if (value === 'Male') {
                $('#gender_edit_employee_male').prop('checked', true).closest('label').addClass('active');
                $('#gender_edit_employee_female').prop('checked', false).closest('label').removeClass('active');
            } else if (value === 'Female') {
                $('#gender_edit_employee_female').prop('checked', true).closest('label').addClass('active');
                $('#gender_edit_employee_male').prop('checked', false).closest('label').removeClass('active');
            }
        }
        $(document).on("click", "#{{$btnDetailViewId}}", function () {
            let employeeData = $(this).data("employee");

            $.ajax({
                url: "{{config("app.urlapi")}}/api/v1/employee/detail/" + employeeData.id,
                dataType: 'json',
                success: function (data) {

                    data = data.data
                    console.log(data)
                    $('#full_name_edit_employee').val(data.user.full_name)
                    $('#name_edit_employee').val(data.user.name)
                    $('#nik_edit_employee').val(data.nik)
                    $('#email_edit_employee').val(data.user.email)
                    $('#date_of_birth_edit_employee').val(data.user.date_of_birth)
                    $('#position_edit_employee').val(data.position)
                    $('#join_date_edit_employee').val(data.join_date)
                    $('#date_of_exchange_status_edit_employee').val(data.date_of_exchange_status)
                    $('#gender_edit_employee').val(data.date_of_exchange_status)
                    $('#address_edit_employee').val(data.user.address)
                    $('#avatar_placeholder_edit_employee').css('background-image', `url("${data.user.avatar}")`);
                    updateGenderSelection(data.user.gender)

                    let select2Roles = $('#role_id_select2_edit')
                    let option = new Option(data.user.role_name, data.user.role_id, true, true);
                    select2Roles.append(option).trigger('change')

                    let select2SubDepartment = $('#sub_department_select2_edit')
                    option = new Option(data.sub_department.name, data.sub_department.id, true, true);
                    select2SubDepartment.append(option).trigger('change')

                    let select2LevelGradeId = $('#level_grade_select2_edit')
                    option = new Option(`${data.level_grade.level_name.name} (${data.level_grade.name})`, data.level_grade.id, true, true);
                    select2LevelGradeId.append(option).trigger('change')

                    let select2Status = $('#status_edit_employee')
                    option = new Option(data.status, data.status, true, true);
                    select2Status.append(option).trigger('change')
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });

        })
    </script>
@endpush
