@extends('layouts.auth')

@section('content')
    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
            <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                <form class="form w-100" novalidate="novalidate" method="POST"
                      action="{{ route('password.email') }}">
                    @csrf
                    <div class="text-center mb-10">
                        <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
                        <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
                    </div>
                    <div class="fv-row mb-8">
                        <input type="text" placeholder="Email" name="email" autocomplete="off"
                               class="form-control bg-transparent"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
											<span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <a href="{{route('login')}}"
                           class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
