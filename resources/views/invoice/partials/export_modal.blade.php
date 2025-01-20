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
                ]">
        @slot('slot0')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="kwitansi_model1">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model1.png')}}" alt="Kwitansi Model 1"
                         class="img-preview">
                </div>
                <button type="submit" disabled class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot1')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="kwitansi_model1">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model2.png')}}" alt="Kwitansi Model 2"
                         class="img-preview">
                </div>
                <button type="submit" disabled class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
    </x-tabs>
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
                <button type="submit" disabled class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
        @slot('slot5')
            <form method="POST" action="{{route('receivable.entry.invoice.export')}}">
                @csrf
                <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
                <input hidden name="export_invoice_model" value="kwitansi_model1">
                <div class="checkbox-container">
                    <img src="{{asset('assets/images/invoice/kwitansi-model2.png')}}" alt="Kwitansi Model 2"
                         class="img-preview">
                </div>
                <button type="submit" disabled class="btn btn-primary">
                    Export
                </button>
            </form>
        @endslot
    </x-tabs>
@endif
