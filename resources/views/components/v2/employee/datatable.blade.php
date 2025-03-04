@props([
    'id'=>'employee_datatable',
    'subDepartmentIdFilter'=>"filter_sub_department_id",
    'levelGradeIdFilter'=>"filter_level_grade_id",
    'roleIdFilter'=>"filter_role_id",
    'searchFilter'=>'filter_search_id'
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
    </tr>
    </thead>
</table>
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
            ],
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
@endpush
