<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\EditEmployeeRequest;
use App\Models\Division\SubDepartment;
use App\Models\Employee;
use App\Models\EmployeeConfigs;
use App\Models\Level\LevelGrade;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use App\Trait\ApiResponseTrait;
use App\Utils\Helpers\FileHelper;
use App\Utils\Helpers\Transaction;
use App\Utils\Primitives\Enum\EmployeeConfigs as EmployeeConfigsEnum;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    use ApiResponseTrait;

    private string $avatarPath = "users/avatar";

    public function index(Request $request)
    {
        $employees = new EmployeeRepository;
        $employees->setRequest($request);
        $employees = $employees->getAll();

        $subDepartments = SubDepartment::all();
        $levelGrades = LevelGrade::all();
        $roles = Role::all();
        $pageSizes = ListPageSize::pageSizes();
        $title = 'employee management';
//        return view('v2.employee_management.index', compact(
        return view('user_management.index', compact(
            'title',
            'employees',
            'levelGrades',
            'subDepartments',
            'pageSizes',
            'roles'
        ));
    }

    public function trash(Request $request)
    {
        $employees = new EmployeeRepository;
        $employees->setRequest($request);
        $employees->setOnlyTrashed(true);
        $employees = $employees->getAll();

        $subDepartments = SubDepartment::all();
        $levelGrades = LevelGrade::all();
        $pageSizes = ListPageSize::pageSizes();
        $roles = Role::all();
        $title = 'user management';
        return view('user_management.trash', compact(
            'title',
            'employees',
            'pageSizes',
            'subDepartments',
            'levelGrades',
            'roles'
        ));
    }

    public function store(CreateEmployeeRequest $request)
    {

        $image = null;
        if ($request->hasFile('avatar')) {
            $image = FileHelper::optimizeAndUploadPicture($request->file('avatar'), $this->avatarPath);
        }

        $phoneNumbers = [];
        foreach ($request->phone_numbers as $phoneNumber) {
            if (!empty($phoneNumber['phone_number'])) {
                $phoneNumbers[] = $phoneNumber['phone_number'];
            }
        }
        $phoneNumbersString = implode(',', $phoneNumbers);

        $res = Transaction::doTx(function () use ($request, $image, $phoneNumbersString) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'sub_district_village_id' => $request->sub_district_village_id,
                'sub_district_id' => $request->sub_district_id,
                'district_id' => $request->district_id,
                'province_id' => $request->province_id,
                'timezone' => $request->timezone,
                'full_name' => $request->full_name,
                'avatar' => $image,
                'address' => $request->address,
                'bio' => $request->bio,
                'is_active' => true,
            ]);

            $employee = Employee::create([
                'user_id' => $user->id,
                'join_date' => $request->join_date,
                'position' => $request->position,
                'nik' => $request->nik,
                'status' => $request->status,
                'date_of_exchange_status' => $request->date_of_exchange_status,
                'level_grade_id' => $request->level_grade_id,
                'sub_department_id' => $request->sub_department_id,
                'phone_numbers' => $phoneNumbersString,
            ]);

            if ($request->role_name) {
                $user->assignRole($request->role_name);
            }

            $employeeConfigs = [];
            if ($request->APPROVAL_SALES_MAPPING) {
                foreach ($request->APPROVAL_SALES_MAPPING as $key => $value) {
                    if (!empty($value['employee_id'])) {
                        $employeeConfigs[] = [
                            "feature" => EmployeeConfigsEnum::FEATURE_CRM,
                            "type" => EmployeeConfigsEnum::CRM_APPROVAL_SALES_MAPPING,
                            "external_id" => $value["employee_id"],
                            "employee_id" => $employee->id,
                        ];
                    }
                }
            }
            if ($request->APPROVAL_SCHEDULE_VISIT) {
                foreach ($request->APPROVAL_SCHEDULE_VISIT as $key => $value) {
                    if (!empty($value['employee_id'])) {
                        $employeeConfigs[] = [
                            "feature" => EmployeeConfigsEnum::FEATURE_CRM,
                            "type" => EmployeeConfigsEnum::CRM_APPROVAL_SCHEDULE_VISIT,
                            "external_id" => $value["employee_id"],
                            "employee_id" => $employee->id,
                        ];
                    }
                }
            }

            if (!empty($employeeConfigs)) {
                foreach ($employeeConfigs as $employeeConfig) {
                    EmployeeConfigs::create($employeeConfig);
                }
            }
        });

        if ($res) {
            return Redirect::back()->withInput($request->all())->with($res);
        }

        return Redirect::back()->with([
            'status' => 'success',
            'message' => 'Create employee successfully'
        ]);
    }

    public function show($id)
    {
        $employee = Employee::withTrashed()->where('id', $id)->firstOrFail();
        if (!$employee) {
            abort(404);
        }

        $groupedConfigs = $employee->employeeConfigs
            ->whereIn('type', [
                EmployeeConfigsEnum::CRM_APPROVAL_SCHEDULE_VISIT,
                EmployeeConfigsEnum::CRM_APPROVAL_SALES_MAPPING,
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


        $subDepartments = SubDepartment::all();
        $levelGrades = LevelGrade::all();
        $roles = Role::all();

        return view('user_management.edit', compact(
            'employee',
            'subDepartments',
            'levelGrades',
            'roles'
        ));
    }

    public function update(EditEmployeeRequest $request, Employee $employee)
    {
        $emailVerifiedAt = $employee->user->email_verified_at;
        if (isset($data['email']) && $data['email'] !== $employee->user->email) {
            $emailVerifiedAt = null;
        }

        $oldImage = null;
        $image = $employee->user->avatar;
        if ($request->hasFile('avatar')) {
            $image = FileHelper::optimizeAndUploadPicture($request->file('avatar'), $this->avatarPath);
            $oldImage = $employee->user->avatar;
        }

        $password = $employee->user->password;
        if ($request->password != "") {
            $password = bcrypt($request->password);
        }

        $phoneNumbers = [];
        if ($request->phone_numbers) {
            foreach ($request->phone_numbers as $phoneNumber) {
                if (!empty($phoneNumber['phone_number'])) {
                    $phoneNumbers[] = $phoneNumber['phone_number'];
                }
            }
        }
        $phoneNumbersString = implode(',', $phoneNumbers);

        $employeeConfigs = [];
        if ($request->APPROVAL_SALES_MAPPING) {
            foreach ($request->APPROVAL_SALES_MAPPING as $key => $value) {
                if (!empty($value['employee_id'])) {
                    $employeeConfigs[] = [
                        "feature" => EmployeeConfigsEnum::FEATURE_CRM,
                        "type" => EmployeeConfigsEnum::CRM_APPROVAL_SALES_MAPPING,
                        "external_id" => $value["employee_id"],
                        "employee_id" => $employee->id,
                    ];
                }
            }
        }
        if ($request->APPROVAL_SCHEDULE_VISIT) {
            foreach ($request->APPROVAL_SCHEDULE_VISIT as $key => $value) {
                if (!empty($value['employee_id'])) {
                    $employeeConfigs[] = [
                        "feature" => EmployeeConfigsEnum::FEATURE_CRM,
                        "type" => EmployeeConfigsEnum::CRM_APPROVAL_SCHEDULE_VISIT,
                        "external_id" => $value["employee_id"],
                        "employee_id" => $employee->id,
                    ];
                }
            }
        }

        $res = Transaction::doTx(function () use ($request, $employee, $image, $phoneNumbersString, $password, $emailVerifiedAt, $oldImage, $employeeConfigs) {
            User::where('id', $employee->user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'sub_district_village_id' => $request->sub_district_village_id,
                'sub_district_id' => $request->sub_district_id,
                'district_id' => $request->district_id,
                'province_id' => $request->province_id,
                'timezone' => $request->timezone,
                'full_name' => $request->full_name,
                'avatar' => $image,
                'address' => $request->address,
                'bio' => $request->bio,
                'is_active' => true,
                'email_verified_at' => $emailVerifiedAt,
            ]);

            if ($request->role_name) {
                $employee->user->removeRole($employee->user->roleName());
                $employee->user->assignRole($request->role_name);
            }

            Employee::where('id', $employee->id)->update([
                'join_date' => $request->join_date,
                'position' => $request->position,
                'nik' => $request->nik,
                'status' => $request->status,
                'date_of_exchange_status' => $request->date_of_exchange_status,
                'level_grade_id' => $request->level_grade_id,
                'sub_department_id' => $request->sub_department_id,
                'phone_numbers' => $phoneNumbersString,
            ]);


            EmployeeConfigs::where('employee_id', $employee->id)->delete();

            if (!empty($employeeConfigs)) {
                foreach ($employeeConfigs as $employeeConfig) {
                    EmployeeConfigs::create($employeeConfig);
                }
            }

            if (isset($oldImage)) {
                FileHelper::deleteImage($this->avatarPath, $oldImage);
            }
        });

        if ($res) {
            dd($res);
            return Redirect::back()->withInput($request->all())->with($res);
        }
        return redirect()->back()->withInput($request->all())->with([
            'status' => 'success',
            'message' => 'Update employee successfully'
        ]);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Employee deleted successfully!'
        ]);
    }

    public function restore($id)
    {
        $employee = Employee::whereId($id)->withTrashed()->firstOrFail();
        if (!$employee) {
            abort(404);
        }

        $employee->restore();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Employee restored successfully!'
        ]);
    }

    public function apiGet(Request $request)
    {
        $employees = new EmployeeRepository;
        $employees->setRequest($request);
        $employees->setOnlySales($request->query('only_sales', false));
        $employees->setOnlyTrashed($request->query('only_trashed', false));
        $employees->setWithTrashed($request->query('with_trashed', false));

        $employees = $employees->getAll();
        return $this->successResponse($employees);
    }

    public function apiFindOne($id)
    {
        $employee = Employee::where('id', $id)->with([
            'user'
        ])->firstOrFail();

        return $this->successResponse($employee);
    }
}
