<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">

<x-toast-message></x-toast-message>
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <p class="text-center fs-5">
                Terima kasih telah melakukan pembayaran. Berikut detail pembayaran Anda:
            </p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Nomor Kwitansi:</strong>
                            <span id="receiptNumber">{{$receiptNumber}}</span>
                        </li>
                        <li class="list-group-item">
                            <strong>Nomor Invoice:</strong>
                            <ul id="invoiceList" class="mt-2 mb-0">
                                @foreach($invoices as $invoice)
                                    <li>{{$invoice->number}}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <strong>Total Pembayaran (IDR):</strong>
                            <span id="totalAmount">{{\App\Utils\Util::rupiah($grandTotal)}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4">
                <form method="POST" action="{{route('public-uri.invoice-payment')}}">
                    @csrf
                    <input type="text" name="receipt_number" hidden value="{{$receiptNumber}}">
                    <button type="submit" class="btn btn-success btn-lg">
                        Konfirmasi Pembayaran
                    </button>
                </form>
            </div>
            <div class="mt-4 text-center">
                <small class="text-muted">
                    Pastikan informasi di atas sesuai sebelum melakukan konfirmasi pembayaran.
                </small>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
@stack('script')
</body>
</html>
