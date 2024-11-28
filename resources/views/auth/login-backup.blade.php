@extends('layouts.auth')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                    <form class="form w-100" novalidate="novalidate" method="POST" action="{{route('login.store')}}">
                        @csrf
                        <div class="text-center mb-11">
                            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
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
                            <input type="text" placeholder="Email" name="email" autocomplete="off"
                                   class="form-control bg-transparent"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Password" name="password" autocomplete="off"
                                   class="form-control bg-transparent"/>
                        </div>
                        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                            <div></div>
                            <a href="{{route('password.request')}}"
                               class="link-primary">Forgot Password ?</a>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">Sign In</span>
                                <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        @feature('register')
                        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                            <a href="{{route('register')}}"
                               class="link-primary">Sign up</a></div>
                        @endfeature
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/js/custom/authentication/sign-in/general.js')}}"></script>
@endpush
