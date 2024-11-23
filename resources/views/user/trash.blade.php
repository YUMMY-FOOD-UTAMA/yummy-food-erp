@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="User" route-list-name="user.index" modal-size="1000" route-create-name="user.store"
                       :using-create-modal="true">
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

            @include('user.partials.user_table',['isTrash'=>true])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $users->links() !!}
        </div>
    </x-general-section-content>
@endsection
