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
            <x-table.basic-filter-and-export name="User">
                @slot('slotFilterForm')
                    {{--                    <x-form.select-box-geographic province-i-d="{{request()->province_id}}"--}}
                    {{--                                                  form-method="GET"--}}
                    {{--                                                  type="vertical"></x-form.select-box-geographic>--}}
                @endslot
                @slot('slotFilterExport')
                    {{--                    <x-form.select-box-geographic--}}
                    {{--                        type="vertical"></x-form.select-box-geographic>--}}
                @endslot
            </x-table.basic-filter-and-export>

            @include('user_management.partials.employee_table',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
        {!! $employees->links() !!}
    </x-general-section-content>

@endsection
