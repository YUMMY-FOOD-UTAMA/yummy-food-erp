@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Role Management" route-list-name="user-management.role-management.index"
                       route-trash-name="user-management.role-management.trash">
            </x-toolbar>
        @endslot
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user-management.role-management.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role_name" name="role_name" required>
                        </div>

                        <x-card title="General" id="role_general_card">
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="view_dashboard"
                                           id="view_dashboard"
                                           name="authority[]">
                                    <label class="form-check-label" for="view_dashboard">
                                        View Dashboard
                                    </label>
                                </div>
                            </div>
                        </x-card>

                        @include('role_management.partials.account_receivable')

                    </div>

                    <div class="col-12 d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Save Role</button>
                    </div>
                </form>
            </div>
        </div>
    </x-general-section-content>
@endsection
