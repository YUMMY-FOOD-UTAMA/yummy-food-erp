<?php

namespace App\Http\Controllers\ReceivableEntry;

use App\Http\Controllers\Controller;
use App\Imports\ReceivableEntry\ImportInvoice;
use App\Models\Invoice\CustomerInvoice;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\ProductInvoice;
use App\Utils\Helpers\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function importInvoice()
    {
        $filePath = public_path('Summary-Output-Format-Export.xlsx');
        if (!file_exists($filePath)) {
            dd('File Not Found');
        }

        $import = new ImportInvoice();
        Excel::import($import, $filePath);
        $data = $import->getProcessedData();

        $existsInvoice = Invoice::where("number", $data['invoice_number'])->first();
        if ($existsInvoice) {
            return redirect()->back()->with([
                'status' => "error",
                'message' => "Invoice Number already exists"
            ]);
        }

        $res = Transaction::doTx(function () use ($data) {
            $customer = CustomerInvoice::firstOrCreate(
                ['name' => $data['customer_name']],
                ['address' => $data['address'], "account_name" => ""]
            );

            $invoice = Invoice::create([
                'customer_invoice_id' => $customer->id,
                'supplier_name' => $data['supplier_name'],
                'supplier_address' => $data['supplier_address'],
                'supplier_ref' => $data['supplier_ref'],
                'number' => $data['invoice_number'],
                'date' => $data['invoice_date'],
                'term_of_payment' => $data['term_of_payment'],
                'term_of_delivery' => $data['term_of_delivery'],
                'ppn' => $data['ppn'],
                'product_net_rate' => $data['product_total_net_rate'],
                'product_total_amount' => $data['product_total_amount'],
                'product_total_amount_ppn' => $data['product_total_amount_ppn'],
                'total_quantity_product' => $data['total_quantity_product'],
            ]);


            foreach ($data['products'] as $product) {
                ProductInvoice::create([
                    'invoice_id' => $invoice->id,
                    'name' => $product['name'],
                    'buyer_order_number' => $product['buyer_order_number'],
                    'delivery_note' => $product['delivery_note'],
                    'delivery_note_date' => $product['delivery_note_date'],
                    'quantity' => $product['quantity'],
                    'unit' => $product['unit'],
                    'rate' => $product['rate'],
                    'net_rate' => $product['net_rate'],
                    'discount' => $product['discount'],
                    'amount' => $product['amount'],
                ]);
            }
        });
        if ($res) {
            return redirect()->back()->with($res);
        }

        return redirect()->back()->with([
            'status' => "success",
            'message' => "import invoice successfully"
        ]);
    }
}
