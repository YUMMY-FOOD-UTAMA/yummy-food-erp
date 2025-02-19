<?php

namespace App\Http\Controllers\ReceivableEntry;

use App\Exports\ReceivableEntry\ExportInvoiceTax;
use App\Exports\ReceivableEntry\ExportInvoiceTaxHeader;
use App\Http\Controllers\Controller;
use App\Imports\ReceivableEntry\ImportInvoice;
use App\Models\Customer\Customer;
use App\Models\Invoice\CustomerInvoice;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\ProductInvoice;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Repositories\InvoiceRepository;
use App\Repositories\ProductInvoiceRepository;
use App\Trait\ApiResponseTrait;
use App\Utils\Helpers\Transaction;
use App\Utils\Util;
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

    public function invoicePaymentView(Request $request, string $receiptNumber)
    {
        $invoices = new InvoiceRepository();
        $invoices->setRequest($request);
        $invoices->setReceiptNumber($receiptNumber);
        $invoices = $invoices->getAll();

        $grandTotal = 0;
        foreach ($invoices as $invoice) {
            $grandTotal += $invoice->calculate()["grand_total"];
        }
        return view('invoice.invoice-payment', compact('invoices', 'receiptNumber', 'grandTotal'));
    }

    public function invoicePaymentPost(Request $request)
    {
        Invoice::where('receipt_number', $request->get('receipt_number'))->update(['status' => "done"]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Confirmation Payment Successfully'
        ]);
    }

    public function importInvoice(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $import = new ImportInvoice($request->get("type"));
        Excel::import($import, $file);
        $data = $import->getProcessedData();

        $invoiceNumbers = [];
        foreach ($data as $invoice) {
            $invoiceNumbers[] = $invoice["invoice_number"];
        }

        Invoice::whereIn('number', $invoiceNumbers)->forceDelete();
        $res = Transaction::doTx(function () use ($data, $request) {
            foreach ($data as $invoice) {
                $customer = CustomerInvoice::firstOrCreate(
                    ['name' => $invoice['customer_name']],
                    ['address' => $invoice['address'], "account_name" => ""]
                );

                $invoiceCreate = Invoice::create([
                    'customer_invoice_id' => $customer->id,
                    'supplier_name' => $invoice['supplier_name'],
                    'supplier_address' => $invoice['supplier_address'],
                    'supplier_ref' => $invoice['supplier_ref'],
                    'number' => $invoice['invoice_number'],
                    'date' => $invoice['invoice_date'],
                    'term_of_payment' => $invoice['term_of_payment'],
                    'term_of_delivery' => $invoice['term_of_delivery'],
                    'ppn' => $invoice['ppn'],
                    'product_total_amount' => $invoice['product_total_amount'],
                    'product_total_discount' => $invoice['product_total_discount'],
                ]);


                foreach ($invoice['products'] as $product) {
                    ProductInvoice::create([
                        'invoice_id' => $invoiceCreate->id,
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
        $invoiceIDs = explode(",", $request->get("invoice_ids")) ?? [];
        $invoiceID = $request->get("invoice_id");

        if ($exportModel == "invoice_model1" || $exportModel == "invoice_model2" || $exportModel == "invoice_model3_tax" ||
            $exportModel == "invoice_model3_no_tax") {
            $invoice = Invoice::with([
                'products',
                'customer',
            ])->where("id", $invoiceID)->withTrashed()->first();
            if (!$invoice) {
                redirect()->back()->with([
                    'status' => "error",
                    'message' => "invoice not found"
                ]);
            }

            $timestamp = Carbon::now('Asia/Jakarta')->format('d-M-Y');
            $timestamp = "Jakarta, " . $timestamp;
            $formatInvoiceNumber = str_replace("/", "-", $invoice->number);
            $filename = "Invoice_{$invoice->customer->name}_{$formatInvoiceNumber}.pdf";
            $pdf = null;
            if ($exportModel === "invoice_model1") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-1', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            } else if ($exportModel === "invoice_model2") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-2', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            } else if ($exportModel === "invoice_model3_tax") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-3-with-tax', ['invoice' => $invoice, 'timestamp' => $timestamp,
                    'taxNumber' => $request->get('tax_number')]);
            } else if ($exportModel === "invoice_model3_no_tax") {
                $pdf = Pdf::loadView('invoice.export.invoice-pdf-model-3-without-tax', ['invoice' => $invoice, 'timestamp' => $timestamp]);
            }
            return $pdf->download($filename);
        } else if ($exportModel == "kwitansi_model1" || $exportModel == "kwitansi_model2" || $exportModel == "bst") {
            if (count($invoiceIDs) <= 0) {
                redirect()->back()->with([
                    'status' => "error",
                    'message' => "minimum invoice is 1"
                ]);
            }

            $invoicesRepo = new InvoiceRepository();
            $invoicesRepo->setRequest($request);
            $invoicesRepo->setInvoiceIDs($invoiceIDs);
            $invoicesRepo->setWithOutPagination(true);
            $invoices = $invoicesRepo->getAll();

            $grandTotal = 0;
            $formatInvoiceNumber = "";
            $invoices = $invoices->sortByDesc('date');
            $timestamp = $invoices->first()->date;
            foreach ($invoices as $invoice) {
                $grandTotal += $invoice->calculate()["grand_total"];
                $formatInvoiceNumber = $formatInvoiceNumber . " " . $invoice->number;
            }
            $grandTotalAsIndonesia = Util::amountToIndonesia($grandTotal);

            $formatInvoiceNumber = str_replace("/", "-", $formatInvoiceNumber);
            $timestamp = "Jakarta, " . $timestamp;

            $pdf = null;

            if ($exportModel === "bst") {
                $totalInvoiceNumber = $invoices->count();
                $totalBuyerOrderNumber = $invoices->count();
                $bstNumber = $invoicesRepo->generateBSTNumber();
                Invoice::whereIn('id', $invoiceIDs)->update(['bst_number' => $bstNumber]);
                $filename = str_replace(".", "", $bstNumber).".pdf";
                $timestamp = Carbon::now('Asia/Jakarta')->format('d/m/Y');
                $pdf = Pdf::loadView('invoice.export.export-bst-pdf', [
                    'invoices' => $invoices,
                    'bstNumber' => $bstNumber,
                    'timestamp' => $timestamp,
                    'from' => $request->get('from'),
                    'totalInvoiceNumber' => $totalInvoiceNumber,
                    'totalBuyerOrderNumber' => $totalBuyerOrderNumber,
                    'grandTotal' => $grandTotal,
                ]);
            } else {
                $receiptNumber = $invoicesRepo->generateReceiptNumber();
                Invoice::whereIn('id', $invoiceIDs)->update(['receipt_number' => $receiptNumber]);

                $filename = "Kwitansi_{$invoices[0]->customer->name}_{$formatInvoiceNumber}.pdf";
                $urL = config('app.url') . '/public-uri/invoice-payment/' . $receiptNumber;

                $qrCodePath = "qr-codes/{$receiptNumber}.png";
                Storage::disk('public')->put($qrCodePath, QrCode::format('png')->size(200)->generate($urL));


                if ($exportModel === "kwitansi_model1") {
                    $pdf = Pdf::loadView('invoice.export.kwitansi-pdf-model-1', ['invoices' => $invoices,
                        'grand_total' => $grandTotal, 'grand_total_as_indonesia' => $grandTotalAsIndonesia, 'receiptNumber' => $receiptNumber, 'timestamp' => $timestamp]);
                } else if ($exportModel === "kwitansi_model2") {
                    $pdf = Pdf::loadView('invoice.export.kwitansi-pdf-model-2', ['invoices' => $invoices,
                        'grand_total' => $grandTotal, 'grand_total_as_indonesia' => $grandTotalAsIndonesia, 'receiptNumber' => $receiptNumber, 'timestamp' => $timestamp]);
                }
            }

            return $pdf->download($filename);
        } else {
            $invoices = new InvoiceRepository();
            $invoices->setRequest($request);
            $invoices->setInvoiceIDs($invoiceIDs);
            $invoices->setWithOutPagination(true);
            $invoices = $invoices->getAll();
            $invoices = $invoices->sortByDesc('date');

            $formatInvoiceNumber = "";
            if (count($invoices) > 0) {
                $firstInvoice = $invoices->first()->number;
                $lastInvoice = $invoices->last()->number;

                $formatInvoiceNumber = ($firstInvoice === $lastInvoice)
                    ? $firstInvoice
                    : "{$firstInvoice} s.d {$lastInvoice}";
            }
            $formatInvoiceNumber = str_replace("/", "-", $formatInvoiceNumber);

            $date = Carbon::createFromFormat('j-M-Y', '3-Jan-2025');
            $monthName = $date->translatedFormat('F');
            if ($exportModel === "header_and_body_tax_invoice") {
                $fileName = "Faktur Pajak Excel_{$monthName}_{$formatInvoiceNumber}.xlsx";
                return Excel::download(new ExportInvoiceTax($invoices, $request), $fileName);
            } else {
                $fileName = "Faktur Pajak Xml_{$monthName}_{$formatInvoiceNumber}.xml";
                $xml = view('invoice.export.xml_tax_invoice', compact(
                    'invoices',
                    'request'
                ))->render();

                return response()->streamDownload(function () use ($xml) {
                    echo $xml;
                }, $fileName, [
                    'Content-Type' => 'application/xml',
                ]);
            }
        }
    }

    public function delete(Invoice $invoice)
    {
        ProductInvoice::where('invoice_id', $invoice->id)->forceDelete();
        $invoice->forceDelete();

        return redirect()->back()->with([
            'status' => "success",
            'message' => "delete invoice successfully"
        ]);
    }

    public function deletes(Request $request)
    {
        $invoiceIDs = explode(",", $request->input('invoice_ids'));
        ProductInvoice::whereIn('invoice_id', $invoiceIDs)->forceDelete();
        Invoice::whereIn('id', $invoiceIDs)->forceDelete();

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
