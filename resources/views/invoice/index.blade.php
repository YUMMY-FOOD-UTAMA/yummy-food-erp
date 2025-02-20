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
            <x-table.basic-filter-and-export style="pointer-events: none" export-modal-i-d="invoiceExportAllInOne"
                                             export-route="receivable.entry.invoice.export"
                                             name="Invoice">
                @slot('slotExtraBtn')
                    <form action="{{route('receivable.entry.invoice.deletes')}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button onclick="processSelected('deleted_select_box_btn',null,true)"
                                id="deleted_select_box_btn" style="pointer-events: none" class="btn btn-danger ms-3">
                            Delete
                        </button>
                        <input type="hidden" name="invoice_ids" id="deleted_invoice_ids">

                    </form>
                @endslot
            </x-table.basic-filter-and-export>
            <x-modal id="invoiceExportAllInOne"
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
@push('script')
    <script>
        function processSelected(btnID, invoiceIDsInput, isDeleted) {
            const selectedIds = Array.from(document.querySelectorAll('.select-item-invoice:checked'))
                .map(cb => cb.value);

            if (invoiceIDsInput && invoiceIDsInput != '') {
                document.getElementById(invoiceIDsInput).value = selectedIds.join(',');
            }
            document.getElementById('deleted_invoice_ids').value = selectedIds.join(',');
            if (!isDeleted) {
                const formData = new FormData();
                formData.append('invoice_ids', selectedIds.join(','));
                formData.append('export_invoice_model', "kwitansi_model2");

                fetch('{{route('receivable.entry.invoice.export')}}', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    setTimeout(() => window.location.reload(), 1000);
                }).catch(
                    error => {
                        setTimeout(() => window.location.reload(), 1000);
                    })
            }

        }
    </script>
@endpush
