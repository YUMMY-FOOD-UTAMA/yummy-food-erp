@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Customer Invoice">
            </x-toolbar>
        @endslot
        @slot('bottomSlot')
            <x-toolbar name="Customer Invoice" :with-out-heading="true"/>
        @endslot
        <div class="card">
            @include('master_data.customer_invoice.partials.filter')
            <x-table.basic-filter-and-export name="Employee"/>

            @include('master_data.customer_invoice.partials.table',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $customerInvoices->links() !!}
        </div>
    </x-general-section-content>

@endsection
