@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Invoice" route-create-name="receivable.entry.invoice.import" create-label-name="Import"
                       using-create-modal="true">
                @include('invoice.partials.import_invoice_modal')
            </x-toolbar>
        @endslot
        @slot('bottomSlot')
            <x-toolbar name="Invoice" :with-out-heading="true" route-create-name="receivable.entry.invoice.import"
                       create-label-name="import"
                       using-create-modal="true"/>
        @endslot
        <div class="card">
            @include('invoice.partials.filter_invoice')
            <x-table.basic-filter-and-export style="pointer-events: none" export-route="receivable.entry.invoice.export"
                                             name="Invoice"/>
            <x-modal id="receivable.entry.invoice.export"
                     title="Export Kwitansi" size="1000">
                @include('invoice.partials.export_modal',['onlyReceipt'=>true,'invoice'=>null])
            </x-modal>
            @include('invoice.partials.table_invoice',['isTrash'=>false])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $invoices->links() !!}
        </div>
    </x-general-section-content>

@endsection
