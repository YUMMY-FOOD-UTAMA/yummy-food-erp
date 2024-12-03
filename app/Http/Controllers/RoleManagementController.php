<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index()
    {
        return view('role_management.index', [

        ]);
    }

    public function trashed()
    {
        return view('role_management.trash', [

        ]);
    }

    public function create()
    {
        return view('role_management.create');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function restore($id)
    {

    }

}
