@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        @include('account.layout.breadcumb')
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                @include('account.layout.header')
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_profile_details" aria-expanded="true"
                         aria-controls="kt_account_profile_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        @feature('mail-verified')
                        @if(!Auth::user()->hasVerifiedEmail())
                            <div class="card-body border-top p-9">
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-6">
                                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
													<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
														<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                                                              fill="currentColor"/>
														<rect x="11" y="14" width="7" height="2" rx="1"
                                                              transform="rotate(-90 11 14)" fill="currentColor"/>
														<rect x="11" y="17" width="2" height="2" rx="1"
                                                              transform="rotate(-90 11 17)" fill="currentColor"/>
													</svg>
												</span>

                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">We need your attention!</h4>
                                            <div class="fs-6 text-gray-700">Your email is not Verified, please
                                                activation
                                                your
                                                email
                                                <form action="{{route('verification.send')}}" method="POST">
                                                    @csrf
                                                    <a class="fw-bold" href="{{route('verification.send')}}"
                                                       onclick="event.preventDefault();
                                                this.closest('form').submit();">Activation Your
                                                        Mail</a>.
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endfeature
                        <form action="{{route('account.update',Auth::user()->id)}}" method="POST" class="form"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                             style="background-image: url('{{asset('assets/media/svg/avatars/blank.svg')}}')">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                 style="background-image: url({{ Auth::user() && Auth::user()->avatar ? asset("storage/users/avatar/" . Auth::user()->avatar) : asset('assets/media/avatars/blank.png') }})"></div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="avatar"/>
                                                <input type="hidden" name="avatar_remove"/>
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
																	<i class="bi bi-x fs-2"></i>
																</span>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
																	<i class="bi bi-x fs-2"></i>
																</span>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <x-input-error :messages="$errors->get('avatar')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="full_name"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Full name"
                                               value="{{old('full_name',Auth::user()->full_name)}}"/>
                                        <x-input-error :messages="$errors->get('full_name')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Name</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Name"
                                               value="{{old('name',Auth::user()->name)}}"/>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Phone Number</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                           title="Phone number must be active"></i>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="tel" name="phone_number"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Phone number"
                                               value="{{old('phone_number',Auth::user()->phone_number)}}"/>
                                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span>Bio</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="bio"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Bio"
                                               value="{{old('bio',Auth::user()->bio)}}"/>
                                        <x-input-error :messages="$errors->get('bio')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Date Of Birth</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="date" name="date_of_birth"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Date Of Birth"
                                               value="{{old('date_of_birth',Auth::user()->date_of_birth)}}"/>
                                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Gender</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="gender" class="form-select form-select-lg form-select-solid">
                                            <option value=""
                                                    disabled {{ old('gender', Auth::user()->gender) === null ? 'selected' : '' }}>
                                                Select Gender
                                            </option>
                                            <option
                                                value="Male" {{ old('gender', Auth::user()->gender) === 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option
                                                value="Female" {{ old('gender', Auth::user()->gender) === 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option
                                                value="Other" {{ old('gender', Auth::user()->gender) === 'Other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2"/>
                                    </div>
                                </div>
                                <x-form.select-box-timezones class="row mb-6" type="inline"
                                                             :timezone="Auth::user()->timezone">
                                </x-form.select-box-timezones>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                        <span class="required">Address</span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="address"
                                               class="form-control form-control-lg form-control-solid"
                                               placeholder="Address"
                                               value="{{old('address',Auth::user()->address)}}"/>
                                        <x-input-error :messages="$errors->get('address')" class="mt-2"/>
                                    </div>
                                </div>
                                <x-form.select-box-geographic
                                    form-method="POST"
                                    :province-i-d="Auth::user()->province_id"
                                    :district-i-d="Auth::user()->district_id"
                                    :sub-district-i-d="Auth::user()->sub_district_id"
                                    :sub-district-village-i-d="Auth::user()->sub_district_village_id"></x-form.select-box-geographic>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary"
                                        id="kt_account_profile_details_submit">Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Sign-in Method</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_signin_method" class="collapse show">
                        <div class="card-body border-top p-9">
                            <div class="d-flex flex-wrap align-items-center">
                                <div id="kt_signin_email">
                                    <div class="fs-6 fw-bold mb-1">Email Address</div>
                                    <div
                                        class="fw-semibold text-gray-600">
                                        {{Auth::user()->email}}
                                        @feature('mail-verified')
                                        @if(Auth::user()->hasVerifiedEmail())
                                            <span class="badge badge-success">Verified</span>
                                        @else
                                            <span class="badge badge-danger">Not Verified</span>
                                        @endif
                                        @endfeature
                                    </div>
                                </div>
                                <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                    <form id="kt_signin_change_email"
                                          action="{{route('account.change-mail',Auth::user()->id)}}"
                                          method="POST" class="form" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-6">
                                            <div class="col-lg-6 mb-4 mb-lg-0">
                                                <div class="fv-row mb-0">
                                                    <label for="email" class="form-label fs-6 fw-bold mb-3">Enter
                                                        New Email Address</label>
                                                    <input type="email"
                                                           class="form-control form-control-lg form-control-solid"
                                                           id="email" placeholder="Email Address"
                                                           name="email" value="{{old('email',Auth::user()->email)}}"/>
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="fv-row mb-0">
                                                    <label for="password"
                                                           class="form-label fs-6 fw-bold mb-3">Confirm
                                                        Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="password" id="password"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_signin_submit" type="button"
                                                    class="btn btn-primary me-2 px-6">Update Email
                                            </button>
                                            <button id="kt_signin_cancel" type="button"
                                                    class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @feature('change-mail')
                                <div id="kt_signin_email_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">Change Email</button>
                                </div>
                                @endfeature
                            </div>
                            <div class="separator separator-dashed my-6"></div>
                            <div class="d-flex flex-wrap align-items-center mb-10">
                                <div id="kt_signin_password">
                                    <div class="fs-6 fw-bold mb-1">Password</div>
                                    <div class="fw-semibold text-gray-600">************</div>
                                </div>
                                <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                    <form id="kt_signin_change_password"
                                          action="{{route('account.change-password',Auth::user()->id)}}"
                                          method="POST" class="form" novalidate="novalidate">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-1">
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="password"
                                                           class="form-label fs-6 fw-bold mb-3">Current
                                                        Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="password" id="password"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="new_password" class="form-label fs-6 fw-bold mb-3">New
                                                        Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="new_password" id="new_password"/>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="fv-row mb-0">
                                                    <label for="confirm_new_password"
                                                           class="form-label fs-6 fw-bold mb-3">Confirm New
                                                        Password</label>
                                                    <input type="password"
                                                           class="form-control form-control-lg form-control-solid"
                                                           name="confirm_new_password" id="confirm_new_password"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-text mb-5">Password must be at least 8 character and
                                            contain symbols
                                        </div>
                                        <div class="d-flex">
                                            <button id="kt_password_submit" type="button"
                                                    class="btn btn-primary me-2 px-6">Update Password
                                            </button>
                                            <button id="kt_password_cancel" type="button"
                                                    class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div id="kt_signin_password_button" class="ms-auto">
                                    <button class="btn btn-light btn-active-light-primary">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @feature('deactive-account')
                <div class="card">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_deactivate" aria-expanded="true"
                         aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Deactivate Account</h3>
                        </div>
                    </div>
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <form id="kt_account_deactivate_form" class="form">
                            <div class="card-body border-top p-9">
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                        <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                      rx="10" fill="currentColor"/>
																<rect x="11" y="14" width="7" height="2" rx="1"
                                                                      transform="rotate(-90 11 14)"
                                                                      fill="currentColor"/>
																<rect x="11" y="17" width="2" height="2" rx="1"
                                                                      transform="rotate(-90 11 17)"
                                                                      fill="currentColor"/>
															</svg>
														</span>
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Account</h4>
                                            <div class="fs-6 text-gray-700">For extra security, this requires you to
                                                confirm your email or phone number when you reset yousignr password.
                                                <br/>
                                                <a class="fw-bold" href="#">Learn more</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value=""
                                           id="deactivate"/>
                                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm
                                        my account deactivation</label>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="kt_account_deactivate_account_submit" type="submit"
                                        class="btn btn-danger fw-semibold">Deactivate Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endfeature
            </div>
        </div>
    </div>
    @push('script')
        <script src="{{asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
    @endpush
@endsection
