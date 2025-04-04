<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
    <style>
        @page {
            margin-top: 1.5cm;
            margin-bottom: 1.5cm; /* Atau 56.69px */
            margin-left: 3cm;
            margin-right: 1.5cm; /* Minimum 1.5cm */
        }

        .content {

        }
    </style>
</head>

<body>
<div class="content">
    <h2 style="text-align: center; font-size: 24px; margin-top: 30px">KWITANSI</h2>

    <div style="display: table; width: 100%;">
        <div style="display: table-row;">
            <!-- Bagian tabel -->
            <div style="display: table-cell; vertical-align: top; width: 75%;">
                <table style="width: 100%; border-spacing: 0; font-size: 15px;">
                    <tr>
                        <td style="padding: 5px 0; width: 130px; vertical-align: top;">Sudah terima dari</td>
                        <td style="padding: 5px 0; vertical-align: top; text-align: right;">:</td>
                        <td style="padding: 5px;"><span
                                style="font-weight: bold;">{{$invoices[0]->customer->name}}</span><br>{{$invoices[0]->customer->account_name}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; vertical-align: top;">Uang Sejumlah</td>
                        <td style="padding: 5px 0; vertical-align: top;">:</td>
                        <td style="padding: 5px;">{{$grand_total_as_indonesia}} Rupiah
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; vertical-align: top;">Untuk Pembayaran</td>
                        <td style="padding: 5px 0; vertical-align: top;">:</td>
                        <td style="padding: 5px;">Pembelian produk sesuai dengan nota / faktur / invoice
                            (terlampir)
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Bagian barcode -->
            <div style="display: table-cell; vertical-align: top; text-align: right; width: 25%;">
                <div style="margin-left: 10px;">
                    <strong>{{$receiptNumber}}</strong><br>
                    <img src="{{ public_path('storage/qr-codes/'.$receiptNumber.".png") }}" alt="QR Code"
                         width="100" style="margin-top: 20px;">
                    <p style="font-size: 14px; text-align: right; margin-top: 20px;">
                        {{$timestamp}}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <table style="border-spacing: 0; font-size: 15px; margin-top: -15px;">
        <tr>
            <td style="padding: 5px 0; width: 130px; margin-top: 15px">Jumlah</td>
            <td style="padding: 5px 0; vertical-align: top;">:</td>
            <td style="padding: 5px; font-weight: bold; font-size: 18px;">{{\App\Utils\Util::rupiah($grand_total,false,false,true)}}</td>
        </tr>
    </table>

    <p style="font-size: 15px; margin-top: 20px; font-weight: normal; font-style: italic;">
        Untuk Pembayaran Via Transfer dapat dilakukan melalui:<br>
        BCA Cab KCP Hasanudin 523.0313.204 a.n. PT. Yummy Food Utama
        Bank Mandiri Cabang Cimanggis: 129.000.476062.1 a.n PT. Yummy Food Utama
    </p>
</div>
</body>

</html>
