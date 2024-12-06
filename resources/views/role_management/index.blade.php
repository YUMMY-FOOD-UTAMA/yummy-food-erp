@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Role Management" route-create-name="user-management.role-management.create"
                       route-trash-name="user-management.role-management.trash">
            </x-toolbar>
        @endslot
        <div class="card">
            <x-table.basic-filter-and-export name="Role Management"/>
        </div>
        <div class="d-flex p-5 justify-content-end">
            {{--            {!! $employees->links() !!}--}}
        </div>
    </x-general-section-content>

@endsection
