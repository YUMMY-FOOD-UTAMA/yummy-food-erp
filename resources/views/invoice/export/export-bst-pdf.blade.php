<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            size: 21cm 29.7cm;
            margin-top: 2cm;
            margin-bottom: 2cm;
            margin-left: 0.8cm;
            margin-right: 0.8cm;
        }

        .table-header {
            border-collapse: collapse;
            width: 100%;
        }

        .table-header td {
            font-size: 12px;
        }

        .table-header td,
        .table-header th {
            border: 0;
            text-align: left;
            padding: 3px;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            padding: 2px 5px;
        }

        .table td,
        .table th {
            border: 1px solid black;
            text-align: left;
            padding: 3px;
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .align-middle {
            vertical-align: middle;
        }

        .min-w-30px {
            min-width: 30px;
        }

        .min-w-80px {
            min-width: 80px;
        }

        .min-w-100px {
            min-width: 100px;
        }

        .min-w-150px {
            min-width: 150px;
        }

        .min-w-200px {
            min-width: 200px;
        }

        .min-w-250px {
            min-width: 250px;
        }

        .content {
            width: 100%;
            min-height: auto;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
<div class="content">
    <h2 style="text-align: center; margin: 0;">Bukti Serah Terima</h2>
    <table class="table-header" style="margin-bottom: 1rem;">
        <tr>
            <td>
                <span style="font-weight: bold;">Kepada</span>
                <br>
                Admin Collector
            </td>
            <td><span style="font-weight: bold; text-align: center">{{$bstNumber}}</span></td>
            <td></td>
            <td></td>
            <td><span style="font-weight: bold; text-align: right;">Tanggal</span></td>
            <td>{{$timestamp}}</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td rowspan="3" style="vertical-align: top;width: 290px; max-width: 290px">
                <span style="font-weight: bold;">Dari</span>
                <br>
                {{$from}}
            </td>
        </tr>
    </table>

    <table class="table">
        <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center">Customer Name</th>
            <th style="text-align: center">Customer Account</th>
            <th style="width:80px; max-width: 80px; text-align: center;">Kwitansi Number</th>
            <th style="width:105px; max-width: 105px; text-align: center;">Buyer Order Number</th>
            <th style="width:80px; max-width: 80px; text-align: center;">Invoice Number</th>
            <th style="width:75px; max-width: 75px; text-align: center;">Invoice Date</th>
            <th style="width:80px; max-width: 80px; text-align: center;">Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td style="text-align: left;">{{$invoice->customer->name}}</td>
                <td style="text-align: left;">{{$invoice->customer->account_name}}</td>
                <td style="text-align: left;">{{$invoice->receipt_number}}</td>
                <td style="text-align: center;">
                    {{ isset($invoice->products[0]) ? $invoice->products[0]->buyer_order_number : '' }}
                </td>
                <td>{{$invoice->date}}</td>
                <td>{{$invoice->number}}</td>
                <td style="text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate()["grand_total"],false,true,true)}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" rowspan="3"
                style="vertical-align: top; padding-bottom: 0; border-left: 0; border-bottom: 0; border-right: 0;"></td>
            <td style="text-align: center"><span style="font-weight: bold;">Total</span></td>
            <td style="text-align: center"><span style="font-weight: bold;">{{$totalReceiptNumber}}</span></td>
            <td style="text-align: center"><span style="font-weight: bold;">{{$totalBuyerOrderNumber}}</span></td>
            <td style="text-align: center"><span style="font-weight: bold;">{{$totalInvoiceNumber}}</span></td>
            <td style="text-align: center"><span style="font-weight: bold;">{{$totalInvoiceDate}}</span></td>
            <td style="text-align: right"><span style="font-weight: bold;">{{\App\Utils\Util::rupiah($grandTotal,false,false,true)}}</span></td>
        </tr>
        </tbody>
    </table>
</div>
</body>

</html>
