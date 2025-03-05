<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            size: 22cm 28cm;
            margin-top: 3cm;
            margin-bottom: 1.5cm; /* Atau 56.69px */
            margin-left: 1cm;
            margin-right: 0.5cm; /* Minimum 1.5cm */
        }

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
            font-size: 14px;
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
        .min-w-60px {
            min-width: 60px;
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
            <td style=" width: 100px; max-width: 90px">Invoce Number</td>
            <td style="text-align: right">:</td>
            <td style="text-align: left;">{{ $invoice->number }}</td>
        </tr>
        <tr>
            <td rowspan="3" style="vertical-align: top;width: 320px; max-width: 320px">
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
            <td style="padding-left: 60px;"></td>
            <td>Due Date</td>
            <td style="text-align: right;">:</td>
            <td style="text-align: left;">{{ $invoice->term_of_payment }}</td>
        </tr>
    </table>
    <table class="table">
        <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="width:230px; max-width: 230px; text-align: center;">Product Name</th>
            <th class="min-w-60px" style="text-align: center;">Qty</th>
            <th class="min-w-80px" style="text-align: center;">Unit Price</th>
            <th class="min-w-50px" style="text-align: center;">Unit</th>
            <th class="min-w-60px" style="text-align: center;">Disc. %</th>
            <th class="min-w-80px" style="text-align: center;">Net Price</th>
            <th class="min-w-80px" style="text-align: center;">Total Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoice->products as $product)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $product->name }}</td>
                <td style="text-align: center;">{{ $product->quantity }} {{ $product->unit }}</td>
                <td style="text-align: right">{{ \App\Utils\Util::rupiah($product->rate,false,true,true)  }}</td>
                <td style="text-align: center;">{{ $product->unit }}</td>
                <td style="text-align: center;">@percentage($product->discount)</td>
                <td style="text-align: right">{{\App\Utils\Util::rupiah($product->net_rate,true,true,true)}}</td>
                <td style="text-align: right">{{\App\Utils\Util::rupiah($product->net_rate * $product->quantity,false,true,true)}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" rowspan="6"
                style="vertical-align: top; padding-bottom: 0; border-left: 0; border-bottom: 0; border-right: 0;">
                <div style="width: 50%; margin-top: 20px;">
                    <div style="text-align: center;">
                        {{--                    <p style="margin-bottom: 0;">{{$timestamp}}</p>--}}
                    </div>
                    <div style="text-align: center; margin-top: 100px;">
                        <div style="border-top: 1px solid black; width: 200px; margin: 0 auto; padding-top: 10px;">
                            Finance Manager
                        </div>
                    </div>
                </div>
            </td>
            <td>Sub Total</td>
            <td style="text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate($ppn)['dpp'],false,true,true)}}</td>
        </tr>
        <tr>
            <td>DPP</td>
            <td style="text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate($ppn)['dpp'],false,true,true)}}</td>
        </tr>
        <tr>
            <td>DPP Nilai lain</td>
            <td style="text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate($ppn)['dpp_etc_value'],false,true,true)}}</td>
        </tr>
        <tr>
            <td>PPN 12%</td>
            <td style="text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate($ppn)['ppn12'],false,true,true)}}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Grand Total</td>
            <td style="font-weight: bold; text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate($ppn)['grand_total'],false,false,true)}}</td>
        </tr>
        <tr>
            <td style="border: 0"></td>
            <td style="border: 0;"></td>
        </tr>
        </tbody>
    </table>
</div>
</body>

</html>
