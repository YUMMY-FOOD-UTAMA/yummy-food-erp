<?php

namespace App\Http\Controllers;

use App\Http\Repositories\EmployeeRepository;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Models\Division\SubDepartment;
use App\Models\Employee;
use App\Models\Level\LevelGrade;
use App\Models\User;
use App\Utils\Helpers\FileHelper;
use App\Utils\Helpers\Transaction;
use App\Utils\Primitives\Enum\EmployeeStatus;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{
    private string $avatarPath = "users/avatar";

    public function index(Request $request)
    {
        $subDepartments = SubDepartment::all();
        $levelGrades = LevelGrade::all();
        $employees = EmployeeRepository::getAllFromRequest($request);
        $pageSizes = ListPageSize::pageSizes();
        $title = 'user management';
        return view('user_management.index', compact(
            'title',
            'employees',
            'levelGrades',
            'subDepartments',
            'pageSizes',
        ));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $image = null;
        if ($request->hasFile('avatar')) {
            $image = FileHelper::optimizeAndUploadPicture($request->file('avatar'), $this->avatarPath);
        }

        $res = Transaction::doTx(function () use ($request, $image) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->date_of_birth),
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'sub_district_village_id' => $request->sub_district_village_id,
                'sub_district_id' => $request->sub_district_id,
                'district_id' => $request->district_id,
                'province_id' => $request->province_id,
                'timezone' => $request->timezone,
                'phone' => $request->phone,
                'full_name' => $request->full_name,
                'avatar' => $image,
                'address' => $request->address,
                'bio' => $request->bio,
                'phone_number' => $request->phone_number,
                'is_active' => true,
            ]);

            Employee::create([
                'user_id' => $user->id,
                'join_date' => $request->join_date,
                'position' => $request->position,
                'nik' => $request->nik,
                'status' => $request->status,
                'date_of_exchange_status' => $request->date_of_exchange_status,
                'level_grade_id' => $request->level_grade_id,
                'sub_department_id' => $request->sub_department_id,
            ]);
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
        $employee = Employee::withTrashed()->firstOrFail($id);
        if (!$employee) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {

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

    public function trash(Request $request)
    {
        $subDepartments = SubDepartment::all();
        $levelGrades = LevelGrade::all();
        $employees = EmployeeRepository::getAllFromRequest($request, true);
        $pageSizes = ListPageSize::pageSizes();
        $title = 'user management';
        return view('user_management.trash', compact(
            'title',
            'employees',
            'pageSizes',
            'subDepartments',
            'levelGrades',
        ));
    }
}
