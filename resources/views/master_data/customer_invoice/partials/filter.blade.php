<x-table.advance-filter using-apply-button="true" class="mt-5 ms-6 me-6">
{{--    <x-form.select-box name="status" :items="StatusEmployee::valuesObject()" label="Employee Status"--}}
{{--                       :default-value="request()->status" placeholder="Select Employee Status..."--}}
{{--                       class="col-12 col-md-3 mb-5"--}}
{{--                       type="row" size-form="sm"/>--}}
{{--    <x-data-driven.select2.geographic :province-i-d="request()->province_id" form-method="GET" size-form="sm"--}}
{{--                                      class="col-12 col-md-3 mb-5" type="row"/>--}}
{{--    <x-form.select-box name="sub_department_id" label="Sub Department" :default-value="request()->sub_department_id"--}}
{{--                       placeholder="Select Sub Department..." class="col-12 col-md-3 mb-5"--}}
{{--                       type="row" size-form="sm" :items="$subDepartments"/>--}}
{{--    <x-form.select-box name="level_grade_id" label="Level Name" :default-value="request()->level_grade_id"--}}
{{--                       placeholder="Select Level Name..." class="col-12 col-md-3 mb-5"--}}
{{--                       custom-name-key="$t->levelName->name.' ('.$t->name.')'"--}}
{{--                       type="row" size-form="sm" :items="$levelGrades"/>--}}
{{--    <x-form.select-box name="role_id" label="Role Name" :default-value="request()->role_id"--}}
{{--                       placeholder="Select Role Name..." class="col-12 col-md-3 mb-5"--}}
{{--                       type="row" size-form="sm" :items="$roles"/>--}}
</x-table.advance-filter>
