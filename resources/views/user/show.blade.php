@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="User" heading-name="Edit User {{$user->name}}" route-list-name="user.index"
                       route-trash-name="user.trash" modal-size="1000" route-create-name="user.store"
                       :using-create-modal="true">
                @include('user.partials.create_user_modal')
            </x-toolbar>
        @endslot
        <form action="{{ route('user.edit',$user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Avatar</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <x-form.image-input name="avatar" :image="'users/avatar/'.$user->avatar"/>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column me-n7 pe-7">
                                <div class="row g-9 mb-8">
                                    <x-form.input class="col-md-6 fv-row" :required="true"
                                                  :default-value="$user->full_name"
                                                  label="Full Name" name="full_name" type="text"
                                                  placeholder="Full Name..."/>
                                    <x-form.input class="col-md-6 fv-row" :required="true" :default-value="$user->name"
                                                  label="Name" name="name" type="text"
                                                  placeholder="Name..."/>
                                    <x-form.input class="col-md-6 fv-row" :required="true" :default-value="$user->email"
                                                  label="Email" name="email" type="email"
                                                  placeholder="Email..."/>
                                    <x-form.input class="col-md-6 fv-row" :default-value="$user->bio"
                                                  label="Biography" name="bio" type="bio"
                                                  placeholder="Biography..."/>
                                    <x-form.input class="col-md-6 fv-row" :required="true"
                                                  :default-value="$user->date_of_birth"
                                                  label="Date Of Birth" name="date_of_birth" type="date"
                                                  placeholder="Date Of Birth..."/>
                                    <x-form.select-box-timezones class="col-md-6 fv-row" type="row"
                                                                 :timezone="$user->timezone"/>
                                </div>

                                <x-form.radio-button-gender :default-value="$user->gender"
                                                            class="fv-row mb-10"></x-form.radio-button-gender>
                                <x-form.select-box-geographic class="col-md-6 fv-row" type="row"
                                                              form-method="POST"
                                                              :province-i-d="$user->province_id"
                                                              :district-i-d="$user->district_id"
                                                              :sub-district-i-d="$user->sub_district_id"
                                                              :sub-district-village-i-d="$user->sub_district_village_id"/>
                                <div class="d-flex gap-3">
                                    <a href="{{route('user.index')}}" class="btn btn-danger">
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </x-general-section-content>
@endsection
