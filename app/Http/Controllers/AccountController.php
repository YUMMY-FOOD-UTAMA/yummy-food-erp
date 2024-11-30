<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Utils\Helpers\FileHelper;
use App\Utils\Helpers\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AccountController extends Controller
{
    private string $avatarPath = "users/avatar";

    public function index()
    {
        return view('account.index', [
            'title' => 'Account',
        ]);
    }

    public function setting()
    {
        return view('account.setting', [
            'title' => 'Account setting',
        ]);
    }

    public function update(ProfileUpdateRequest $request, User $user): RedirectResponse
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

        return Redirect::route('account.setting')->with([
            'status' => 'success',
            'message' => 'Profile updated successfully'
        ]);
    }

    public function changeMail(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($request->user()->id),
            ],
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages()->getMessages();
            $errorMessages = collect($messages)->flatten()->implode('. ');
            return Redirect::back()->with([
                'status' => 'error',
                'message' => $errorMessages
            ]);
        }

        if ($user->email === $request->email) {
            return Redirect::back()->with([
                'status' => 'info',
                'message' => "you didn't change your email"
            ]);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return Redirect::back()->with([
                'status' => 'error',
                'message' => "wrong your password"
            ]);
        }

        $request->user()->update([
            'email' => $request->email,
            'email_verified_at' => null,
        ]);
        return Redirect::route('account.setting')->with([
            'status' => 'success',
            'message' => 'Email updated successfully'
        ]);
    }

    public function changePassword(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required'],
            'new_password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            $messages = $validator->messages()->getMessages();
            $errorMessages = collect($messages)->flatten()->implode('. ');
            return Redirect::back()->with([
                'status' => 'error',
                'message' => $errorMessages
            ]);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return Redirect::back()->with([
                'status' => 'error',
                'message' => "wrong your password"
            ]);
        }

        $request->user()->update([
            'password' => bcrypt($request->input('new_password')),
        ]);
        return Redirect::route('account.setting')->with([
            'status' => 'success',
            'message' => 'Change Password successfully'
        ]);
    }
}
