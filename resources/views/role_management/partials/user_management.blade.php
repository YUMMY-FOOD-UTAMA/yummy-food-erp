<div class="col-12 col-md-3">
    <h6>Dashboard</h6>
    <x-Form.CheckboxInput
        name="permissions[]"
        class="mb-10 ms-3"
        :checked="in_array('dashboard', old('permissions', $permissions ?? []))"
        value="dashboard">
        View Dashboard
    </x-Form.CheckboxInput>

    <x-Form.CheckboxInput
        name="permissions[]"
        value="dashboard"
        id="user-management"
        :checked="in_array('dashboard', old('permissions', $permissions ?? []))">
        <h6 class="mt-2">User Management</h6>
    </x-Form.CheckboxInput>

    <div class="ms-13" id="user-management-input">
        {{-- All Department --}}
        <div class="mb-5">
            <h6>All Department</h6>
            <div class="ms-3">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.index', old('permissions', $permissions ?? []))"
                    value="user-management.employee.index">
                    View Employee
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.store', old('permissions', $permissions ?? []))"
                    value="user-management.employee.store">
                    Create New Employee
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.update', old('permissions', $permissions ?? []))
                               || in_array('user-management.employee.update,user-management.employee.show', old('permissions', $permissions ?? []))"
                    value="user-management.employee.update,user-management.employee.show">
                    Edit Employee
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.destroy', old('permissions', $permissions ?? []))"
                    value="user-management.employee.destroy">
                    Delete Employee
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.trash', old('permissions', $permissions ?? []))"
                    value="user-management.employee.trash">
                    View Trash Employee
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.restore', old('permissions', $permissions ?? []))"
                    value="user-management.employee.restore">
                    Restore Employee
                </x-Form.CheckboxInput>
            </div>
        </div>
        {{-- Sales Department --}}
        <div class="mb-5">
            <h6>Sales Department
                <i class="fas fa-exclamation-circle ms-2 fs-7"
                   data-bs-toggle="tooltip"
                   title="The sales employee page is the same as all departments, so there is no create sales or edit or delete">
                </i>
            </h6>
            <div class="ms-3">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.sales.index', old('permissions', $permissions ?? []))"
                    value="user-management.employee.sales.index">
                    View Sales Employee
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.employee.sales.trash', old('permissions', $permissions ?? []))"
                    value="user-management.employee.sales.trash">
                    View Trash Sales Employee
                </x-Form.CheckboxInput>
            </div>
        </div>
        {{-- Role Management --}}
        <div class="mb-5">
            <h6>Role Management</h6>
            <div class="ms-3">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.role-management.index', old('permissions', $permissions ?? []))"
                    value="user-management.role-management.index">
                    View Role
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.role-management.create,user-management.role-management.store', old('permissions', $permissions ?? []))
                            || in_array('user-management.role-management.store', old('permissions', $permissions ?? []))"
                    value="user-management.role-management.create,user-management.role-management.store">
                    Create New Role
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.role-management.show', old('permissions', $permissions ?? []))"
                    value="user-management.role-management.show">
                    View Detail Role
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.role-management.update', old('permissions', $permissions ?? []))"
                    value="user-management.role-management.update">
                    Edit Role
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    :checked="in_array('user-management.role-management.destroy', old('permissions', $permissions ?? []))"
                    value="user-management.role-management.destroy">
                    Delete Role
                </x-Form.CheckboxInput>
            </div>
        </div>
    </div>
</div>
