<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    public function index(Request $request)
    {
        $roles = new Role;
        if ($request->query('search')) {
            $roles = $roles->where('name', 'LIKE', '%' . $request->query('search') . '%');
        }
        $roles = $roles->paginate($request->query('page_size', 10))->appends($request->query());
        return view('role_management.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('role_management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_name' => ['required', Rule::unique('roles', 'name')],
            'permissions' => 'required|array|min:1',
        ]);

        $role = Role::create(['name' => $request->input('role_name')]);
        $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
        $role->syncPermissions($permissions);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Role created successfully!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role_name' => ['required', Rule::unique('roles', 'name')->ignore($id)],
            'permissions' => 'required|array|min:1',
        ]);

        $role = Role::findOrFail($id);
        $role->update(['name' => $request->input('role_name')]);
        $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
        $role->syncPermissions($permissions);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Role updated successfully!'
        ]);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);
        $permissions = $role->permissions->pluck('name')->toArray();
        return view('role_management.edit', [
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Role deleted successfully!'
        ]);
    }
}
