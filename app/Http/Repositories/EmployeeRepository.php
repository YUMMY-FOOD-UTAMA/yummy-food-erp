<?php

namespace App\Http\Repositories;

use App\Models\Employee;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;

class EmployeeRepository
{
    public static function getAllFromRequest(Request $request, $onlyTrashed = false)
    {
        $status = $request->get('status');
        $pageSize = $request->query('page_size', ListPageSize::defaultPageSize());
        $salesData = $request->query('is_sales');
        $searchKeyword = $request->query('search');
        $employees = Employee::with([
            'levelGrade' => function ($query) {
                $query->select('id', 'name', 'level_name_id')->with('levelName');
            },
            'subDepartment' => function ($query) {
                $query->select('id', 'name', 'department_id')->with([
                    'department' => function ($query) {
                        $query->select('id', 'name', 'division_id')->with('division');
                    }
                ]);
            }
        ]);
        if ($onlyTrashed) {
            $employees = $employees->onlyTrashed();
        }
        if ($searchKeyword != '') {
            $employees->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('email', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('position', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('nik', 'like', '%' . $searchKeyword . '%');
            });
        }
        if ($status != '') {
            $employees->where('status', $status);
        }
        if ($salesData) {
            $employees->whereHas('subDepartment.department.subDepartments', function ($query) use ($salesData) {
                $query->where('name', 'like', '%sales%');
            });
        }
        $employees = $employees->orderByDesc('created_at')->paginate($pageSize)->appends(request()->query());

        return $employees;
    }
}
