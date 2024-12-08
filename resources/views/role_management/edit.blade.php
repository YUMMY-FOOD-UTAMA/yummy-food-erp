@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Role Management" route-list-name="user-management.role-management.index">
            </x-toolbar>
        @endslot
        <div class="card">
            <div class="card-body px-5">
                <form action="{{ route('user-management.role-management.update',$role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <div class="mb-5">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control form-control-sm" id="role_name"
                                   value="{{old('role_name',$role->name)}}" name="role_name"
                                   required>
                        </div>
                        <div
                            class="form-check form-check-custom form-check-solid form-check-sm form-check-success text-center flex-column">
                            <label class="form-check-label text-black d-block mb-2 fs-5">Select All</label>
                            <input class="form-check-input" type="checkbox" id="select-all">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-1">
                            <h6>Authority</h6>
                        </div>
                        {{-- User Management --}}
                        @include('role_management.partials.user_management')
                        {{-- Account Receivable --}}
                        @include('role_management.partials.account_receivable')
                        {{-- Account Payable --}}
                        @include('role_management.partials.account_payable_group')
                    </div>
                    @can('user-management.role-management.update')
                        <div class="d-flex gap-3">
                            <a href="{{route('user-management.role-management.index')}}" class="btn btn-danger">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
                            </button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </x-general-section-content>
    @push('script')
        <script>
            $(document).ready(function () {
                $('#user-management').on('change', e => {
                    const isChecked = e.target.checked;

                    $('#user-management-input input[type="checkbox"]').each(function () {
                        this.checked = isChecked;
                    });
                });

                $('#account-receivable').on('change', e => {
                    const isChecked = e.target.checked;

                    $('#account-receivable-input input[type="checkbox"]').each(function () {
                        this.checked = isChecked;
                    });
                });

                $('#select-all').on('change', e => {
                    const isChecked = e.target.checked;

                    $('input[type="checkbox"]').each(function () {
                        this.checked = isChecked;
                    });
                });
            });
        </script>
    @endpush
@endsection
