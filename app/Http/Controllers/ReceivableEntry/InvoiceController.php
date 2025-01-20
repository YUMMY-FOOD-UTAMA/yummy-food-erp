<?php

namespace App\Http\Controllers\ReceivableEntry;

use App\Http\Controllers\Controller;
use App\Imports\ReceivableEntry\ImportInvoice;
use App\Models\Customer\Customer;
use App\Models\Invoice\CustomerInvoice;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\ProductInvoice;
use App\Repositories\CustomerInvoiceRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductInvoiceRepository;
use App\Trait\ApiResponseTrait;
use App\Utils\Helpers\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $invoices = new InvoiceRepository();
        $invoices->setRequest($request);
        $invoices = $invoices->getAll();
        return view('invoice.index', [
            'invoices' => $invoices
        ]);
    }

    public function trash(Request $request)
    {
        $invoices = new InvoiceRepository();
        $invoices->setRequest($request);
        $invoices->setOnlyTrashed(true);
        $invoices = $invoices->getAll();
        return view('invoice.trash', [
            'invoices' => $invoices
        ]);
    }

    public function importInvoice(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
            'customer_account_name' => 'nullable|max:255',
        ]);

        $file = $request->file('file');
        $import = new ImportInvoice();
        Excel::import($import, $file);
        $data = $import->getProcessedData();

        $existsInvoice = Invoice::where("number", $data['invoice_number'])->withTrashed()->first();
        if ($existsInvoice) {
            return redirect()->back()->with([
                'status' => "error",
                'message' => "Invoice Number already exists, check in data invoice or check in trashed"
            ]);
        }

        $res = Transaction::doTx(function () use ($data, $request) {
            $customer = CustomerInvoice::firstOrCreate(
                ['name' => $data['customer_name']],
                ['address' => $data['address'], "account_name" => $request->get("customer_account_name") ?? ""]
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
                'product_total_amount' => $data['product_total_amount'],
                'product_total_discount' => $data['product_total_discount'],
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

    public function export(Request $request)
    {
        $request->validate([
            'export_invoice_model' => 'required',
        ]);
        $exportModel = $request->get("export_invoice_model");
        $invoiceIDs = explode(",", $request->get("invoice_ids"));
        $invoiceID = $request->get("invoice_id");

        if ($exportModel == "invoice_model1" || $exportModel == "invoice_model2" || $exportModel == "invoice_model3_tax" ||
            $exportModel == "invoice_model3_no_tax") {
            $invoice = Invoice::where("id", $invoiceID)->withTrashed()->first();
            if (!$invoice) {
                redirect()->back()->with([
                    'status' => "error",
                    'message' => "invoice not found"
                ]);
            }

            $timestamp = Carbon::now('Asia/Jakarta')->format('d-M-Y');
            $timestamp = "Jakarta, " . $timestamp;
            $filename = "{$exportModel}_invoice_{$timestamp}.pdf";
            $pdf = null;
            if ($exportModel === "invoice_model1") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-1', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            } else if ($exportModel === "invoice_model2") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-2', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            } else if ($exportModel === "invoice_model3_tax") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-3-with-tax', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            } else if ($exportModel === "invoice_model3_no_tax") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-3-without-tax', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            }
            return $pdf->download($filename);
        }

        return redirect()->back()->with([
            'status' => "success",
            'message' => "export invoice successfully"
        ]);
    }

    public function delete(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->back()->with([
            'status' => "success",
            'message' => "delete invoice successfully"
        ]);
    }

    public function restore($id)
    {
        Invoice::onlyTrashed()->where('id', $id)->restore();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Invoice has been restored!.'
        ]);
    }

    public function apiGet(Request $request)
    {
        $invoices = new InvoiceRepository();
        $invoices->setRequest($request);
        $invoices->setOnlyTrashed($request->query('only_trashed', false));
        $invoices->setWithTrashed($request->query('with_trashed', false));

        $invoices = $invoices->getAll();
        return $this->successResponse($invoices);
    }

    public function apiGetProductInvoice(Request $request)
    {
        $productInvoice = new ProductInvoiceRepository();
        $productInvoice->setRequest($request);
        $productInvoice = $productInvoice->getAll();

        return $this->successResponse($productInvoice);
    }
}
