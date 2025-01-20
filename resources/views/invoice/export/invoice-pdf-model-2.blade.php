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
    <h3 style="text-align: center; margin: 0;">INVOICE</h3>
    <table class="table-header" style="margin-bottom: 1rem;">
        <tr>
            <td><span style="font-weight: bold;">YUMMY FOOD UTAMA 2024</span><br>Jl. Raya Bogor No. 40 Kec. Ciracas,
                Jakarta 13750<br>indonesia
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
            <td style="text-align: left;">GI 24/11/0736</td>
        </tr>
        <tr>
            <td rowspan="3" style="vertical-align: top;"><span style="font-weight: bold;">PT. JCO DONUT &amp;
                    COFFE</span><br>Buaran Plaza Lantai Dasar, Jl. Radin Inten <br> No. 1 Buaran Klender, Duren Sawit,
                <br> Jakarta Timur
            </td>
            <td></td>
            <td>Date</td>
            <td style="text-align: right;">:</td>
            <td style="text-align: left;">15-Nov-2024</td>
        </tr>
        <tr>
            <td></td>
            <td>Cust. Acc </td>
            <td style="text-align: right;">:</td>
            <td style="text-align: left;">J. CO Donuts &amp; Coffe Buaran </td>
        </tr>
        <tr>
            <td></td>
            <td>Due Date</td>
            <td style="text-align: right;">:</td>
            <td style="text-align: left;">14 Days</td>
        </tr>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="width:130px; max-width: 130px; text-align: center;">Product Name</th>
                <th class="min-w-50px" style="text-align: center;">Qty</th>
                <th class="min-w-80px" style="text-align: center;">Unit Price</th>
                <th class="min-w-50px" style="text-align: center;">Unit</th>
                <th class="min-w-50px" style="text-align: center;">Disc. %</th>
                <th class="min-w-80px" style="text-align: center;">Net Price</th>
                <th class="min-w-80px" style="text-align: center;">Total Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $data = [1, 2, 3];
            @endphp
            @foreach ($data as $data)
                <tr>
                    <td>1</td>
                    <td>Yummy Yoghurt Natural Plain</td>
                    <td style="text-align: center;">6 pcs</td>
                    <td style="text-align: center;">Rp30.630,60</td>
                    <td style="text-align: center;">pcs</td>
                    <td style="text-align: center;">0%</td>
                    <td style="text-align: center;">Rp30.630,60</td>
                    <td style="text-align: center;">Rp30.630,60</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" rowspan="6"
                    style="vertical-align: top; padding-bottom: 0; border-left: 0; border-bottom: 0; border-right: 0;">
                    <div style="width: 50%; margin-top: 20px;">
                        <div style="text-align: center;">
                            <p style="margin-bottom: 0;">Jakarta, 15-Nov-2024</p>
                        </div>
                        <div style="text-align: center; margin-top: 100px;">
                            <div style="border-top: 1px solid black; width: 200px; margin: 0 auto; padding-top: 10px;">
                                Finance Manager
                            </div>
                        </div>
                    </div>
                </td>
                <td>Sub Total</td>
                <td>Rp551.350,80</td>
            </tr>
            <tr>
                <td>DPP</td>
                <td>Rp551.350,80</td>
            </tr>
            <tr>
                <td>DPP Nilai lain</td>
                <td>Rp505.404,90</td>
            </tr>
            <tr>
                <td>PPN 12%</td>
                <td>Rp505.404,90</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Grand Total</td>
                <td style="font-weight: bold;">Rp505.404,90</td>
            </tr>
            <tr>
                <td style="border: 0"></td>
                <td style="border: 0;"></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
