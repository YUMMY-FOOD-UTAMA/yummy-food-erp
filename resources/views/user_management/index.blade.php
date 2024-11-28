@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Employee" route-create-name="user-management.employee.store" using-create-modal="true"
                       route-trash-name="user-management.employee.trash">
                @include('user_management.partials.create_employee_modal')
            </x-toolbar>
        @endslot
        <div class="card">
            <x-table.advance-filter using-apply-button="true">
                <x-form.select-box-timezones size-form="sm" class="col-12 col-md-3 mb-5" type="row"/>
                <x-form.select-box-geographic size-form="sm" class="col-12 col-md-3 mb-5" type="row"/>
                <x-form.input type="date" name="periode" placeholder="periode" label="periode" class="col-12 col-md-3 mb-5" size-form="sm"></x-form.input>
            </x-table.advance-filter>
            <x-table.basic-filter-and-export name="Employee"/>

            @include('user_management.partials.employee_table',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
        {!! $employees->links() !!}
    </x-general-section-content>

@endsection
