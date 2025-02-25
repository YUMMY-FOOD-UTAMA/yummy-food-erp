<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EditUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Utils\Helpers\FileHelper;
use App\Utils\Helpers\Transaction;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private string $avatarPath = "users/avatar";

    public function index(Request $request)
    {
        $pageSize = $request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $request->query('search_keyword');
        $provinceID = $request->query('province_id');
        $districtID = $request->query('district_id');
        $subDistrictID = $request->query('sub_district_id');
        $subDistrictVillageID = $request->query('sub_district_village_id');

        $users = new User;
        if ($searchKeyword) {
            $users = $users->where(function ($query) use ($searchKeyword) {
                $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(full_name) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(email) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(timezone) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(address) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(phone_number) like ?', ['%' . strtolower($searchKeyword) . '%']);
            });
        }
        if ($provinceID) {
            $users = $users->where('province_id', $provinceID);
        }
        if ($districtID) {
            $users = $users->where('district_id', $districtID);
        }
        if ($subDistrictID) {
            $users = $users->where('sub_district_id', $subDistrictID);
        }
        if ($subDistrictVillageID) {
            $users = $users->where('sub_district_village_id', $subDistrictVillageID);
        }

        $users = $users->paginate($pageSize)->appends($request->query());
        return view('user.index', [
            'title' => 'user',
            'users' => $users
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = Arr::except($request->validated(), ['password']);
        $data['password'] = bcrypt($data['date_of_birth']);
        User::create($data);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User created successfully!'
        ]);
    }

    public function show($id)
    {
        $user = User::whereId($id)->firstOrFail();
        if (!$user) {
            abort(404);
        }
        return view('user.show', [
            'title' => 'user',
            'user' => $user,
        ]);
    }

    public function edit(EditUserRequest $request, User $user)
    {
        $data = Arr::except($request->validated(), ['avatar']);

        $request->user()->fill($request->validated());

        if (isset($data['email']) && $data['email'] !== $user->email) {
            $data['email_verified_at'] = null;
        }

        $oldImage = null;
        if ($request->hasFile('avatar')) {
            $data['avatar'] = FileHelper::optimizeAndUploadPicture($request->file('avatar'), $this->avatarPath);
            $oldImage = $user->avatar;
        }

        $res = Transaction::doTx(function () use ($request, $user, $data, $oldImage) {
            $user->update($data);
            if (isset($oldImage)) {
                FileHelper::deleteImage($this->avatarPath, $oldImage);
            }
        });

        if ($res) {
            return Redirect::back()->withInput($request->all())->with($res);
        }

        return Redirect::route('user.show', $user->id)->with([
            'status' => 'success',
            'message' => 'User updated successfully'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User deleted successfully!'
        ]);
    }

    public function forceDelete($id)
    {
        $user = User::whereId($id)->withTrashed()->firstOrFail();
        if (!$user) {
            abort(404);
        }
        $user->forceDelete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User deleted successfully!'
        ]);
    }

    public function restore($id)
    {
        $user = User::whereId($id)->withTrashed()->firstOrFail();
        if (!$user) {
            abort(404);
        }

        $user->restore();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User restored successfully!'
        ]);
    }

    public function trash(Request $request)
    {
        $pageSize = $request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $request->query('search_keyword');
        $provinceID = $request->query('province_id');
        $districtID = $request->query('district_id');
        $subDistrictID = $request->query('sub_district_id');
        $subDistrictVillageID = $request->query('sub_district_village_id');

        $users = new User;
        if ($searchKeyword) {
            $users = $users->where(function ($query) use ($searchKeyword) {
                $query->whereRaw('LOWER(name) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(full_name) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(email) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(timezone) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(address) like ?', ['%' . strtolower($searchKeyword) . '%']);
                $query->orWhereRaw('LOWER(phone_number) like ?', ['%' . strtolower($searchKeyword) . '%']);
            });
        }
        if ($provinceID) {
            $users = $users->where('province_id', $provinceID);
        }
        if ($districtID) {
            $users = $users->where('district_id', $districtID);
        }
        if ($subDistrictID) {
            $users = $users->where('sub_district_id', $subDistrictID);
        }
        if ($subDistrictVillageID) {
            $users = $users->where('sub_district_village_id', $subDistrictVillageID);
        }

        $users = $users->onlyTrashed()->paginate($pageSize)->appends($request->query());
        return view('user.trash', [
            'title' => 'user',
            'users' => $users
        ]);
    }
}
