@push('css')
    <style>
        .checkbox-container {
            margin-bottom: 20px;
            border: 1px solid #ddd; /* Menambahkan border */
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Efek bayangan */
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
            margin-right: 10px; /* Menambahkan jarak antara radio button dan label */
        }
    </style>
@endpush

<form method="POST" action="{{route('receivable.entry.invoice.export')}}">
    @csrf
    <input hidden name="invoice_ids" value="{{$invoice? $invoice->id :""}}">
    @if(!$onlyReceipt)
        <div class="checkbox-container">
            <input type="radio" name="export_invoice_model" value="invoice_model1"
                   class="form-check-input">
            <label class="form-check-label checkbox-label">Invoice Model 1</label>
            <img src="{{asset('assets/images/invoice/invoice-model1.png')}}" alt="Invoice Model 1" class="img-preview">
        </div>

        <div class="checkbox-container">
            <input type="radio" name="export_invoice_model" value="invoice_model2"
                   class="form-check-input">
            <label class="form-check-label checkbox-label">Invoice Model 2</label>
            <img src="{{asset('assets/images/invoice/invoice-model2.png')}}" alt="Invoice Model 2" class="img-preview">
        </div>

        <div class="checkbox-container">
            <input type="radio" name="export_invoice_model" value="invoice_model3_tax"
                   class="form-check-input">
            <label class="form-check-label checkbox-label">Invoice Model 3 with Tax</label>
            <img src="{{asset('assets/images/invoice/invoice-model3-with-tax.png')}}" alt="Invoice Model 3 with Tax"
                 class="img-preview">
        </div>

        <div class="checkbox-container">
            <input type="radio" name="export_invoice_model" value="invoice_model3_no_tax"
                   class="form-check-input">
            <label class="form-check-label checkbox-label">Invoice Model 3 without Tax</label>
            <img src="{{asset('assets/images/invoice/invoice-model3-without-tax.png')}}"
                 alt="Invoice Model 3 without Tax"
                 class="img-preview">
        </div>
    @endif

    <div class="checkbox-container">
        <input type="radio" name="export_invoice_model" value="kwitansi_model1" class="form-check-input">
        <label class="form-check-label checkbox-label">Kwitansi Model 1</label>
        <img src="{{asset('assets/images/invoice/kwitansi-model1.png')}}" alt="Kwitansi Model 1" class="img-preview">
    </div>

    <div class="checkbox-container">
        <input type="radio" name="export_invoice_model" value="kwitansi_model2" class="form-check-input">
        <label class="form-check-label checkbox-label">Kwitansi Model 2</label>
        <img src="{{asset('assets/images/invoice/kwitansi-model2.png')}}" alt="Kwitansi Model 2" class="img-preview">
    </div>

    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</form>
