@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Customer" route-create-name="receivable.customer.store" using-create-modal="true"
                       route-trash-name="receivable.customer.trash">
                @include('customer.partials.create_customer_modal')
            </x-toolbar>
        @endslot
        @slot('bottomSlot')
            <x-toolbar name="Customer" route-create-name="receivable.customer.store" using-create-modal="true"
                       route-trash-name="receivable.customer.trash" with-out-heading="true">
            </x-toolbar>
        @endslot
        <div class="card">
            @include('customer.partials.filter_customer')
            <x-table.basic-filter-and-export name="Customer"/>

            @include('customer.partials.customer_table',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $customers->links() !!}
        </div>
    </x-general-section-content>

@endsection
