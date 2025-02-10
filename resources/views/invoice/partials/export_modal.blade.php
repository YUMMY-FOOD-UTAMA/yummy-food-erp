@push('css')
    <style>
        .checkbox-container {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .checkbox-label {
            font-weight: bold;
        }

        .img-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .form-check-input {
            margin-right: 10px;
        }
    </style>
@endpush

@if($onlyReceipt)
    <x-tabs :tabs="[
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'kwitansi model 1'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'kwitansi model 2'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'Faktur Pajak'
                        ],
                ]">
        @slot('slot0')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" id="invoice_ids_kwitansi_model1">
                <input hidden name="export_invoice_model" value="kwitansi_model1">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model1.png')}}" alt="Kwitansi Model 1"
                         class="img-preview">
                </div>
                <button onclick="processSelected('btn_kwitansi_model1','invoice_ids_kwitansi_model1')"
                        class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot1')
            kwitansi_model2
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" id="invoice_ids_kwitansi_model2">
                <input hidden name="export_invoice_model" value="kwitansi_model2">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model2.png')}}" alt="Kwitansi Model 2"
                         class="img-preview">
                </div>
                <button onclick="processSelected('btn_kwitansi_model2','invoice_ids_kwitansi_model2')"
                        id="btn_kwitansi_model2" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot2')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" id="tax_invoice_export" value="{{$invoice? $invoice->id :""}}">
                <div class="checkbox-container">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Select Tax Invoice</span>
                    </label>
                    <select name="export_invoice_model" aria-label="Select Tax Invoice Type" data-allow-clear="true"
                            data-control="select2" data-dropdown-parent="#invoiceExportAllInOne"
                            data-placeholder="Select Tax Invoice Type"
                            class="form-select form-select-solid form-select-lg">
                        <option value="header_and_body_tax_invoice">Header And Body Faktur Pajak</option>
                        <option value="xml_tax_invoice">XML upload ke coretax</option>
                    </select>

                    @include('invoice.partials.tax_invoice_form_input',['dataDropdownParent'=>"invoiceExportAllInOne"])
                </div>

                <button onclick="processSelected('btn_tax_invoice_export','tax_invoice_export')"
                        id="btn_tax_invoice_export" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
    </x-tabs>
    @push('script')
        <script>
            function processSelected(btnID, invoiceIDsInput) {
                const selectedIds = Array.from(document.querySelectorAll('.select-item-invoice:checked'))
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    toastr.warning('No items selected.')
                    return;
                }

                document.getElementById(invoiceIDsInput).value = selectedIds.join(',');
                document.getElementById(btnID).submit();
            }
        </script>
    @endpush
@else
    <x-tabs :tabs="[
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'Invoice Model 1'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'Invoice Model 2'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'Invoice Model 3 with tax'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'Invoice Model 3 without tax'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'kwitansi model 1'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'kwitansi model 2'
                        ],
                        [
                            'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                            'title'=>'Faktur Pajak'
                        ],
                ]">

        @slot('slot0')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_id" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="invoice_model1">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/invoice-model1.png')}}" alt="Invoice Model 1"
                         class="img-preview">
                </div>
                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot1')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_id" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="invoice_model2">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/invoice-model2.png')}}" alt="Invoice Model 1"
                         class="img-preview">
                </div>
                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot2')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_id" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="invoice_model3_tax">
                <div class="checkbox-container">
                    <x-form.input class="fv-row mb-10" label="tax Number" required="true" placeholder="Input Tax Number"
                                  name="tax_number"/>
                    <img src="{{asset('assets/images/invoice/invoice-model3-with-tax.png')}}" alt="Invoice Model 1"
                         class="img-preview">
                </div>
                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot3')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_id" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="invoice_model3_no_tax">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/invoice-model3-without-tax.png')}}" alt="Invoice Model 1"
                         class="img-preview">
                </div>
                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot4')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="kwitansi_model1">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model1.png')}}" alt="Kwitansi Model 1"
                         class="img-preview">
                </div>
                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot5')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="kwitansi_model2">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model2.png')}}" alt="Kwitansi Model 2"
                         class="img-preview">
                </div>
                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot6')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
                <div class="checkbox-container">
                    <label class="d-flex align-items-center fs-6 fw-semibold mt-2 mb-2">
                        <span class="required">Select Tax Invoice</span>
                    </label>
                    <select name="export_invoice_model" aria-label="Select Tax Invoice Type" data-allow-clear="true"
                            data-control="select2" required data-dropdown-parent="#modalExportInvoice{{$invoice->id}}"
                            data-placeholder="Select Tax Invoice Type"
                            class="form-select form-select-solid form-select-lg">
                        <option value="header_and_body_tax_invoice">Header And Body Faktur Pajak</option>
                        <option value="xml_tax_invoice">XML upload ke coretax</option>
                    </select>

                    @include('invoice.partials.tax_invoice_form_input',['dataDropdownParent'=>"modalExportInvoice".$invoice->id])


                    <x-form.text-area class="fv-row mb-10 mt-2" auto-resize="true"
                                      label="Supporting Document"
                                      name="supporting_document"/>

                    <x-form.text-area class="fv-row mb-10 mt-2" auto-resize="true"
                                      label="Number Document Buyer"
                                      name="number_document_buyer"/>

                </div>

                <button type="submit" class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
    </x-tabs>
@endif
