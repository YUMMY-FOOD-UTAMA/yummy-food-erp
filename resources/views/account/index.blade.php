@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        @include('account.layout.breadcumb')
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                @include('account.layout.header')
                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                        <a href="{{route('account.setting')}}"
                           class="btn btn-sm btn-primary align-self-center">Edit Profile</a>
                    </div>
                    <div class="card-body p-9">
                        @feature('mail-verified')
                        @if(!Auth::user()->hasVerifiedEmail())
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
                                        <div class="fs-6 text-gray-700">Your email is not Verified, please activation
                                            your
                                            email
                                            <form action="{{route('verification.send')}}" method="POST">
                                                @csrf
                                                <a class="fw-bold" href="{{route('verification.send')}}" onclick="event.preventDefault();
                                                this.closest('form').submit();">Activation Your
                                                    Mail</a>.
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @endfeature
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->full_name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Name</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->name}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Email
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                   title="Phone number must be active"></i></label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bold fs-6 text-gray-800 me-2">{{Auth::user()->email}}</span>
                                @feature('mail-verified')
                                @if(Auth::user()->hasVerifiedEmail())
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-danger">Not Verified</span>
                                @endif
                                @endfeature
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Phone Number</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->phone_number ?? '-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Timezone</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->timezone}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Bio</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->bio??'-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Gender</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->gender??'-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Date Of Birth</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->date_of_birth??'-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Address</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->address??'-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Province</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->province?->name ?? '-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">District</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{Auth::user()->district?->format() ?? '-'}}
                                </span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Sub District</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bold fs-6 text-gray-800">{{Auth::user()->subDistrict?->name ?? '-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Village</label>
                            <div class="col-lg-8">
                                <span
                                    class="fw-bold fs-6 text-gray-800">{{Auth::user()->subDistrictVillage?->name ?? '-'}}</span>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Postal Code</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{Auth::user()->subDistrictVillage?->zip ?? '-'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
