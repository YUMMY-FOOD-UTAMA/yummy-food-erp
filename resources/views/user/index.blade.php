@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="User" :using-create-modal="true" modal-size="1000" route-trash-name="user.trash"
                       route-create-name="user.store">
                @include('user.partials.create_user_modal')
            </x-toolbar>
        @endslot
        <div class="card">
            <x-table.basic-filter-and-export name="User">
                @slot('slotFilterForm')
                    <x-form.select-box-geographic province-i-d="{{request()->province_id}}"
                                                  form-method="GET"
                                                  type="vertical"></x-form.select-box-geographic>
                @endslot
                @slot('slotFilterExport')
                    <x-form.select-box-geographic
                            type="vertical"></x-form.select-box-geographic>
                @endslot
            </x-table.basic-filter-and-export>

            @include('user.partials.user_table',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
        {!! $users->links() !!}
    </x-general-section-content>

@endsection
