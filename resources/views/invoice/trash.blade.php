@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Invoice" route-create-name="receivable.entry.invoice.import" create-label-name="Import"
                       using-create-modal="true"
                       route-list-name="receivable.entry.invoice.index">
                @include('invoice.partials.import_invoice_modal')
            </x-toolbar>
        @endslot
        @slot('bottomSlot')
            <x-toolbar name="Invoice" :with-out-heading="true" route-create-name="receivable.entry.invoice.import"
                       create-label-name="import"
                       using-create-modal="true"
                       route-list-name="receivable.entry.invoice.index"/>
        @endslot
        <div class="card">
            @include('invoice.partials.filter_invoice')
            <x-table.basic-filter-and-export name="Invoice"/>

            @include('invoice.partials.table_invoice',['isTrash'=>true])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $invoices->links() !!}
        </div>
    </x-general-section-content>

@endsection
