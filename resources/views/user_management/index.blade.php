@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Employee" route-create-name="user-management.employee.store" using-create-modal="true"
                       route-trash-name="user-management.employee.trash">
                @include('user_management.partials.create_employee_modal')
            </x-toolbar>
        @endslot
        @slot('bottomSlot')
            <x-toolbar name="Employee" :with-out-heading="true" route-create-name="user-management.employee.store"
                       using-create-modal="true"
                       route-trash-name="user-management.employee.trash"/>
        @endslot
        <div class="card">
            @include('user_management.partials.filter-employee')
            <x-table.basic-filter-and-export name="Employee"/>

            @include('user_management.partials.employee_table',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $employees->links() !!}
        </div>
    </x-general-section-content>

@endsection
