@extends('layouts.auth')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                    <form class="form w-100" id="kt_sign_up_form" novalidate="novalidate"
                          action="{{route('register.store')}}" method="POST">
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                        </div>
                        <div class="row g-3 mb-9">
                            @feature('social-lite.google')
                            <div class="@feature('social-lite.facebook') col-md-6 @else col-md-12 @endfeature">
                                <a href="#"
                                   class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                    <img alt="Logo" src="{{asset('assets/media/svg/brand-logos/google-icon.svg')}}"
                                         class="h-15px me-3"/>Sign in with Google</a>
                            </div>
                            @endfeature
                            @feature('social-lite.facebook')
                            <div class="@feature('social-lite.google') col-md-6 @else col-md-12 @endfeature">
                                <a href="#"
                                   class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                    <img alt="Logo" src="{{asset('assets/media/svg/brand-logos/facebook-2.svg')}}"
                                         class="theme-light-show h-15px me-3"/>
                                    <img alt="Logo"
                                         src="{{asset('assets/media/svg/brand-logos/facebook-2.svg')}}"
                                         class="theme-dark-show h-15px me-3"/>Sign in with Facebook</a>
                            </div>
                            @endfeature
                        </div>
                        <div class="separator separator-content my-14">
                            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Email" name="email" value="{{old('email')}}"
                                   autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="fv-row mb-8" data-kt-password-meter="true">
                            <div class="mb-1">
                                <div class="position-relative mb-3">
                                    <input class="form-control bg-transparent" type="password" placeholder="Password"
                                           name="password" autocomplete="off"/>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                    <span
                                        class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                        data-kt-password-meter-control="visibility">
													<i class="bi bi-eye-slash fs-2"></i>
													<i class="bi bi-eye fs-2 d-none"></i>
												</span>
                                </div>
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
                            <input placeholder="Repeat Password" name="confirmed" type="password"
                                   autocomplete="off" class="form-control bg-transparent"/>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                <span class="indicator-label">Sign up</span>
                                <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                            <a href="{{route('login')}}"
                               class="link-primary fw-semibold">Sign in</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="{{asset('assets/js/custom/authentication/sign-up/general.js')}}"></script>
    @endpush
@endsection
