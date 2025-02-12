<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Utils\Primitives\Enum\EmployeeConfigs;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;

class EmployeeRepository
{
    private Request $request;
    private bool $onlyTrashed = false;
    private bool $onlySales = false;
    private bool $withTrashed = false;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setOnlyTrashed(bool $onlyTrashed): void
    {
        $this->onlyTrashed = $onlyTrashed;
    }

    public function setOnlySales(bool $onlySales): void
    {
        $this->onlySales = $onlySales;
    }

    public function setWithTrashed(bool $withTrashed): void
    {
        $this->withTrashed = $withTrashed;
    }

    public function getAll()
    {
        $status = $this->request->query('status');
        $pageSize = $this->request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $this->request->query('search');
        $subDepartmentID = $this->request->query('sub_department_id');
        $levelGradeID = $this->request->query('level_grade_id');
        $roleID = $this->request->query('role_id');
        $provinceID = $this->request->query('province_id');
        $districtID = $this->request->query('district_id');
        $subDistrictID = $this->request->query('sub_district_id');
        $subDistrictVillageID = $this->request->query('sub_district_village_id');
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
            },
            'user',
            'user.roles',
            'user.district',
            'user.subDistrict',
            'user.subDistrictVillage',
            'user.province',
            'employeeConfigs.externalEmployee.user'
        ]);
        if ($this->onlyTrashed) {
            $employees = $employees->onlyTrashed();
        }
        if ($this->onlySales) {
            $employees->whereHas('subDepartment.department.subDepartments', function ($query) {
                $query->where('name', 'like', '%sales%');
            });
        }
        if ($this->withTrashed) {
            $employees = $employees->withTrashed();
        }
        if ($searchKeyword) {
            $employees->where(function ($query) use ($searchKeyword) {
                $query->where('position', 'like', '%' . $searchKeyword . '%')
                    ->orWhereHas('user', function ($query) use ($searchKeyword) {
                        $query->where('name', 'like', '%' . $searchKeyword . '%')
                            ->orWhere('email', 'like', '%' . $searchKeyword . '%');
                    })
                    ->orWhere('nik', 'like', '%' . $searchKeyword . '%');
            });
        }
        if ($status) {
            $employees->where('status', $status);
        }
        if ($subDepartmentID) {
            $employees->where('sub_department_id', $subDepartmentID);
        }
        if ($levelGradeID) {
            $employees->where('level_grade_id', $levelGradeID);
        }
        if ($roleID) {
            $employees->whereHas('user.roles', function ($query) use ($roleID) {
                $query->where('id', $roleID);
            });
        }
        if ($provinceID) {
            $employees->whereHas('user', function ($query) use ($provinceID) {
                $query->where('province_id', $provinceID);
            });
        }
        if ($districtID) {
            $employees->whereHas('user', function ($query) use ($districtID) {
                $query->where('district_id', $districtID);
            });
        }
        if ($subDistrictID) {
            $employees->whereHas('user', function ($query) use ($subDistrictID) {
                $query->where('sub_district_id', $subDistrictID);
            });
        }
        if ($subDistrictVillageID) {
            $employees->whereHas('user', function ($query) use ($subDistrictVillageID) {
                $query->where('sub_district_village_id', $subDistrictVillageID);
            });
        }

        $employees = $employees->orderByDesc('created_at')
            ->paginate($pageSize)
            ->appends(request()->query());

        $employees->getCollection()->transform(function ($employee) {
            $groupedConfigs = $employee->employeeConfigs
                ->whereIn('type', [
                    EmployeeConfigs::CRM_APPROVAL_SCHEDULE_VISIT,
                    EmployeeConfigs::CRM_APPROVAL_SALES_MAPPING,
                ])
                ->groupBy('type')
                ->map(function ($items, $type) {
                    return [
                        'type' => $type,
                        'externalEmployees' => $items->pluck('externalEmployee')->toArray(),
                    ];
                })
                ->values();

            $employee->employeeConfigs = $groupedConfigs;


            return $employee;
        });
        return $employees;
    }
}
