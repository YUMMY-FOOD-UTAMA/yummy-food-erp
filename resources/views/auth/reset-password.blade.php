@extends('layouts.auth')

@section('content')
    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
            <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                <form class="form w-100" novalidate="novalidate" id="kt_new_password_form" method="POST"
                      action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="text-center mb-10">
                        <h1 class="text-dark fw-bolder mb-3">Setup New Password</h1>
                        <div class="text-gray-500 fw-semibold fs-6">Have you already reset the password ?
                            <a href="{{route('login')}}"
                               class="link-primary fw-bold">Sign in</a></div>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Email" name="email"
                               autocomplete="off" value="{{old('email',$request->email)}}" class="form-control bg-transparent"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                    <div class="fv-row mb-8" data-kt-password-meter="true">
                        <div class="mb-1">
                            <div class="position-relative mb-3">
                                <input class="form-control bg-transparent" type="password" placeholder="Password"
                                       name="password" autocomplete="off"/>
                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                      data-kt-password-meter-control="visibility">
													<i class="bi bi-eye-slash fs-2"></i>
													<i class="bi bi-eye fs-2 d-none"></i>
												</span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>
                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.
                        </div>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="password" placeholder="Repeat Password" name="password_confirmation"
                               autocomplete="off" class="form-control bg-transparent"/>
                    </div>
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/js/custom/authentication/reset-password/new-password.js')}}"></script>
@endpush
