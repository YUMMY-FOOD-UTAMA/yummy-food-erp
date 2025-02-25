<?php

namespace App\Imports\ReceivableEntry;

use App\Repositories\InvoiceRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ImportInvoice implements ToCollection, WithEvents, WithCalculatedFormulas
{
    private $type = "single_invoice";
    private $processedData = [];
    private int $currentSheetIndex = -1;

    public function __construct($type)
    {
        $this->type = $type;
    }

    private function getBuyerData(Collection $buyerData)
    {
        $isBuyerAddr = false;
        $isBuyerName = false;
        $buyerAddress = '';
        $buyerName = '';
        $buyerAccountName = '';
        foreach ($buyerData as $index => $row) {

            if ($isBuyerName) {
                $buyerName = $row[0];
                $buyerAccountName = $buyerData[$index + 1][0];
                $isBuyerAddr = true;
                $isBuyerName = false;
                continue;
            }

            if ($isBuyerAddr) {
                foreach ($row as $key => $value) {
                    if (strtolower($value) === 'description of goods') {
                        $isBuyerName = false;
                        $isBuyerAddr = false;
                        break;
                    }
                }
            }
            if ($isBuyerAddr) {
                $buyerAddress = $buyerAddress . " " . $row[0];
            }

            if (!$isBuyerAddr) {
                foreach ($row as $key => $value) {
                    if (strtolower($value) === 'buyer') {
                        $isBuyerName = true;
                        break;
                    }
                }
            }
        }

        return [
            'buyerAddress' => trim($buyerAddress),
            'buyerName' => $buyerName,
            'buyerAccountName' => $buyerAccountName,
        ];
    }

    private function getInvoiceData(Collection $invoiceData)
    {
        $dateInvoice = '';
        $invoiceNo = '';
        $deliveryNote = '';
        $deliveryNoteDate = '';
        $termOfPayment = '';
        $termOfDelivery = '';
        $buyerOrderNumber = '';
        $productDate = '';
        $supplierReference = '';
        foreach ($invoiceData as $index => $row) {
            foreach ($row as $key => $value) {
                if ((strtolower($value) === 'dated' || strtolower($value) === 'date') && $dateInvoice == '') {
                    $dateInvoice = $invoiceData[$index + 1][$key];
                }

                if ((strtolower($value) === 'dated' || strtolower($value) === 'date') && $dateInvoice != '') {
                    $productDate = trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $invoiceData[$index + 1][$key])));
                }

                if (strtolower($value) === 'invoice no.' || strtolower($value) === 'invoice no') {
                    $invoiceNo = ltrim($invoiceData[$index + 1][$key], ": ");
                }

                if (strtolower($value) === 'mode/terms of payment' || strtolower($value) === 'terms of payment') {
                    $termOfPayment = ltrim($invoiceData[$index + 1][$key], ": ");
                }

                if (strtolower($value) === 'delivery note') {
                    $deliveryNote = trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $invoiceData[$index + 1][$key])));
                }

                if (strtolower($value) === 'delivery note date') {
                    $deliveryNoteDate = trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $invoiceData[$index + 1][$key])));
                }
                if (strtolower($value) === "buyer's order no." || strtolower($value) === "buyer order no." || strtolower($value) === "buyers order no.") {
                    $buyerOrderNumber = trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $invoiceData[$index + 1][$key])));
                }

                if (strtolower($value) === 'terms of delivery') {
                    $termOfDelivery = $invoiceData[$index + 1][$key] ?? "";
                }
                if (strtolower($value) === "supplier's ref." || strtolower($value) === "suppliers ref." || strtolower($value) === "supplier ref." || strtolower($value) === "supplier's ref") {
                    $supplierReference = $invoiceData[$index + 1][$key] ?? "";
                }
            }
        }

        return [
            'dateInvoice' => $dateInvoice,
            'invoiceNo' => $invoiceNo,
            'deliveryNotes' => explode(',', $deliveryNote),
            'deliveryNoteDates' => explode(',', $deliveryNoteDate),
            'termOfPayment' => $termOfPayment,
            'termOfDelivery' => $termOfDelivery,
            'buyerOrderNumbers' => explode(',', $buyerOrderNumber),
            'productDates' => explode(',', $productDate),
            'supplierRef' => $supplierReference,
        ];
    }

    private function getProductData(Collection $productData, array $invoiceData)
    {
        $products = [];
        $isProductData = false;
        $rowProduct = 0;
        $rowQty = 0;
        $rowRate = 0;
        $rowUnit = 0;
        $rowDiscount = 0;
        $rowNetRate = 0;
        $rowAmount = 0;
        $ppn = '';
        $totalAmountProduct = 0;
        $totalDiscountProduct = 0;

        foreach ($productData as $index => $row) {
            foreach ($row as $key => $value) {
                if ((strtolower($value) === 'ppn' || strtolower($value) === 'total')) {
                    $ppn = 11;
                    break 2;
                }
            }

            if ($isProductData && $row[0] != "") {
                $qty = (int)floatval($row[$rowQty] ?? '0');
                $discount = $row[$rowDiscount];
                $totalAmountProduct += $row[$rowRate] * $qty;
                if ($discount != 0) {
                    $discount = $discount / 100;
                    $discountPerProduct = ($row[$rowRate] * $discount);
                    $totalDiscountProduct += $discountPerProduct * $qty;
                }

                $products[] = [
                    'name' => $row[$rowProduct],
                    'quantity' => $qty,
                    'rate' => $row[$rowRate] ?? 0,
                    'unit' => $row[$rowUnit] ?? "",
                    'discount' => $discount,
                    'net_rate' => $row[$rowNetRate] ?? 0,
                    'amount' => $row[$rowAmount] ?? 0,
                    'delivery_note' => $invoiceData["deliveryNotes"][count($products)] ?? $invoiceData["deliveryNotes"][0],
                    'buyer_order_number' => $invoiceData["buyerOrderNumbers"][count($products)] ?? $invoiceData["buyerOrderNumbers"][0],
                    'date' => $invoiceData["productDates"][count($products)] ?? $invoiceData["productDates"][0],
                    'delivery_note_date' => $invoiceData["deliveryNoteDates"][count($products)] ?? $invoiceData["deliveryNoteDates"][0],
                ];
            }

            if (!$isProductData) {
                foreach ($row as $key => $value) {
                    if (strtolower($value) === 'description of goods') {
                        $rowProduct = $key;
                        $isProductData = true;
                    }
                    if (strtolower($value) === 'quantity' || strtolower($value) === 'qty') {
                        $rowQty = $key;
                    }
                    if (strtolower($value) === 'rate') {
                        $rowRate = $key;
                    }
                    if (strtolower($value) === 'per') {
                        $rowUnit = $key;
                    }
                    if (strtolower($value) === 'discount' || strtolower($value) === 'disc. %') {
                        $rowDiscount = $key;
                    }
                    if (strtolower($value) === 'net rate') {
                        $rowNetRate = $key;
                    }
                    if (strtolower($value) === 'amount') {
                        $rowAmount = $key;
                    }
                }
            }
        }

        return [
            'products' => $products,
            'totalAmountProduct' => $totalAmountProduct,
            'totalDiscountProduct' => $totalDiscountProduct,
            'ppn' => $ppn,
        ];
    }

    /**
     * @param Collection $rows
     */

    public function singleInvoice(Collection $rows)
    {
        if ($this->currentSheetIndex !== 0) {
            return;
        }
        $buyerData = $this->getBuyerData($rows);
        $invoiceData = $this->getInvoiceData($rows);
        $productData = $this->getProductData($rows, $invoiceData);

        $invoices[] = [
            'invoice_number' => $invoiceData['invoiceNo'],
            'invoice_date' => $invoiceData['dateInvoice'],
            'supplier_address' => "Jl. Raya Bogor No. 40 Kec. Ciracas, Jakarta 13750 <br>Indonesia",
            'customer_name' => $buyerData["buyerName"],
            'address' => $buyerData["buyerAddress"],
            'products' => $productData['products'],
            'product_total_amount' => $productData['totalAmountProduct'],
            'product_total_discount' => round($productData['totalDiscountProduct'] ?? 0, 2),
            'ppn' => $productData['ppn'],
            'term_of_payment' => $invoiceData['termOfPayment'],
            'term_of_delivery' => $invoiceData['termOfDelivery'],
            'supplier_ref' => $invoiceData['supplierRef'],
            'supplier_name' => "YUMMY FOOD UTAMA",
            'buyer_account_name' => $buyerData["buyerAccountName"],
        ];
        $this->processedData = $invoices;
    }


    public function multipleInvoice(Collection $rows)
    {
        //
        $invoices = [];
        $fetch = false;
        $isAppendInvoice = false;
        $invoiceDate = '';
        $invoiceNo = '';
        $buyerName = '';
        $buyerAddress = '';
        $ppn = 11;
        $termsOfDelivery = '';
        $termOfPayment = '';
        $supplierRef = '';
        $supplierName = 'YUMMY FOOD UTAMA';
        $supplierAddress = 'Jl. Raya Bogor No. 40 Kec. Ciracas, Jakarta 13750 <br>Indonesia';
        $products = [];
        $deliveryNote = '';
        $deliveryNoteDate = '';
        $buyerOrderNumber = '';
        $productTotalAmount = 0;
        $productTotalDiscount = 0;
        $buyerAccountName = '';
        foreach ($rows as $index => $row) {
            if ($row[0] == 'Date') {
                $fetch = true;
                continue;
            }
            if ($fetch) {
                if ($row[0] != 0) {
                    if ($rows[$index - 1][0] != 'Date') {
                        $isAppendInvoice = true;
                    }
                    if ($isAppendInvoice) {
                        $isAppendInvoice = false;
                        $invoices[] = [
                            'invoice_number' => $invoiceNo,
                            'invoice_date' => $invoiceDate,
                            'supplier_address' => $supplierAddress,
                            'customer_name' => $buyerName,
                            'address' => $buyerAddress,
                            'products' => $products,
                            'product_total_amount' => $productTotalAmount,
                            'product_total_discount' => $productTotalDiscount,
                            'ppn' => $ppn,
                            'term_of_payment' => $termOfPayment,
                            'term_of_delivery' => $termsOfDelivery,
                            'supplier_ref' => $supplierRef,
                            'supplier_name' => $supplierName,
                            'buyer_account_name' => $buyerAccountName,
                        ];
                        $productTotalAmount = 0;
                        $productTotalDiscount = 0;
                        $products = [];
                    }
                    $doAndDoDate = ltrim($row[15], ': ');
                    preg_match('/^(.*?)\s+dt\.(.*)$/', $doAndDoDate, $matches);
                    $deliveryNote = trim($matches[1] ?? '');
                    $deliveryNoteDate = trim($matches[2] ?? '');
                    preg_match('/^(.*?)\s+dt\.(.*)$/', $row[11], $matchesBuyerOrder);
                    $buyerOrderNumber = $matchesBuyerOrder[1];
                    $invoiceDate = Date::excelToDateTimeObject($row[0])->format('j-M-Y');
                    $invoiceNo = ltrim($row[4], ": ");
                    $buyerName = $row[2];
                    $buyerAccountName = $row[1];
                    $buyerAddress = $row[3];
                    $termsOfDelivery = $row[14];
                    $termOfPayment = $row[12];
                    $supplierRef = '-';
                } else {
                    if (strtolower($row[1]) == "grand total") {
                        continue;
                    }
                    $unit = "pcs";
                    if (str_contains(strtolower($row[1]), 'pack') || str_contains(strtolower($row[1]), 'pail')) {
                        $unit = "pail";
                    }
                    $qty = (int)floatval($row[24] ?? '0');
                    $totalPriceProduct = $row[27] ?? 0;
                    $netRate = 0;
                    if ($totalPriceProduct != 0 && $qty != 0) {
                        $netRate = $totalPriceProduct / $qty;
                    }
                    $rate = $row[26] ?? 0;
                    $grossProduct = $rate * $qty;
                    $discountPrice = $grossProduct - $totalPriceProduct;
                    $productTotalDiscount += $discountPrice;
                    $discount = $grossProduct > 0 ? ($discountPrice / $grossProduct) * 100 : 0;
                    if ($discount != 0) {
                        $discount = $discount / 100;
                    }
                    $productTotalAmount += $grossProduct;


                    $products[] = [
                        'name' => $row[1],
                        'quantity' => $qty,
                        'rate' => $rate,
                        'unit' => $unit,
                        'discount' => $discount,
                        'discount_price' => $discountPrice,
                        'net_rate' => $netRate,
                        'amount' => $totalPriceProduct,
                        'delivery_note' => $deliveryNote,
                        'buyer_order_number' => $buyerOrderNumber,
                        'delivery_note_date' => $deliveryNoteDate,
                    ];
                }
            }
        }
        if ($invoiceNo != '') {
            $invoices[] = [
                'invoice_number' => $invoiceNo,
                'invoice_date' => $invoiceDate,
                'supplier_address' => $supplierAddress,
                'customer_name' => $buyerName,
                'address' => $buyerAddress,
                'products' => $products,
                'product_total_amount' => $productTotalAmount,
                'product_total_discount' => $productTotalDiscount,
                'ppn' => $ppn,
                'term_of_payment' => $termOfPayment,
                'term_of_delivery' => $termsOfDelivery,
                'supplier_ref' => $supplierRef,
                'supplier_name' => $supplierName,
                'buyer_account_name' => $buyerAccountName,
            ];
        }
        $this->processedData = $invoices;
    }

    public function collection(Collection $rows)
    {
        if ($this->type == "single_invoice") {
            $this->singleInvoice($rows);
        } else {
            $this->multipleInvoice($rows);
        }
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                $this->currentSheetIndex++;
            },
        ];
    }

    public function getProcessedData()
    {
        return $this->processedData;
    }
}
