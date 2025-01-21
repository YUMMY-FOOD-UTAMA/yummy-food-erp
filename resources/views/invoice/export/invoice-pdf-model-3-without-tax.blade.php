<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table-header {
            border-collapse: collapse;
            width: 100%;
        }

        .table-header td {
            font-size: 13px;
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
            font-size: 11px;
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
    </style>
</head>

<body>
<h3 style="text-align: center; margin: 0; margin-top: 30px">INVOICE</h3>
<table class="table-header" style="margin-bottom: 1rem;">
    <tr>
        <td>
            <span style="font-weight: bold;">{{ $invoice->supplier_name }}</span>
            <br>
            {!! $invoice->supplier_address !!}
        </td>
        <td colspan="2" style="font-weight: bold; font-size: 20px; vertical-align: top;">
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Invoce Number</td>
        <td style="text-align: right;">:</td>
        <td style="text-align: left;">{{ $invoice->number }}</td>
    </tr>
    <tr>
        <td rowspan="3" style="vertical-align: top;">
            <span style="font-weight: bold;">{{ $invoice->customer->name }}</span>
            <br>
            {!! $invoice->customer->address !!}
        </td>
        <td></td>
        <td>Date</td>
        <td style="text-align: right;">:</td>
        <td style="text-align: left;">{{ $invoice->date }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Cust. Acc</td>
        <td style="text-align: right;">:</td>
        <td style="text-align: left;">{{ $invoice->customer->account_name }}</td>
    </tr>
    <tr>
        <td></td>
        <td>Due Date</td>
        <td style="text-align: right;">:</td>
        <td style="text-align: left;">{{ $invoice->term_of_payment }}</td>
    </tr>
</table>
<table class="table">
    <thead>
    <tr>
        <th style="width:20px; max-width: 40px; text-align: center;">No</th>
        <th style="width:130px; max-width: 130px; text-align: center;">Delivery Note Date</th>
        <th style="width:130px; max-width: 130px; text-align: center;">Delivery Note Number</th>
        <th style="width:130px; max-width: 130px; text-align: center;">Total Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice->products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->delivery_note_date }}</td>
            <td>{{ $product->delivery_note }}</td>
            <td>@rupiah($product->rate * $product->quantity)</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="2" rowspan="8"
            style="vertical-align: top; padding-bottom: 0; border-left: 0; border-bottom: 0; border-right: 0;">
            <div style="width: 50%; margin-top: 20px;">
                <div style="text-align: center;">
                    <p style="margin-bottom: 0;">{{$timestamp}}</p>
                </div>
                <div style="text-align: center; margin-top: 100px;">
                    <div style="border-top: 1px solid black; width: 200px; margin: 0 auto; padding-top: 10px;">
                        Finance Manager
                    </div>
                </div>
            </div>
        </td>
        <td>Sub Total</td>
        <td>@rupiah($invoice->calculate()['sub_total'])</td>
    </tr>
    <tr>
        <td>Discount</td>
        <td>@rupiah($invoice->calculate()['discount_total'])</td>
    </tr>
    <tr>
        <td>DPP</td>
        <td>@rupiah($invoice->calculate()['dpp'])</td>
    </tr>
    <tr>
        <td>DPP Nilai lain</td>
        <td>@rupiah($invoice->calculate()['dpp_etc_value'])</td>
    </tr>
    <tr>
        <td>PPN 12%</td>
        <td>@rupiah($invoice->calculate()['ppn12'])</td>
    </tr>
    <tr>
        <td>Bea</td>
        <td>Rp0</td>
    </tr>
    <tr>
        <td style="font-weight: bold;">Grand Total</td>
        <td style="font-weight: bold;">@rupiah($invoice->calculate()['grand_total'])</td>
    </tr>
    <tr>
        <td style="border: 0"></td>
        <td style="border: 0;"></td>
    </tr>
    </tbody>
</table>
</body>

</html>
