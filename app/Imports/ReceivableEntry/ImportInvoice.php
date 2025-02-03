<?php

namespace App\Imports\ReceivableEntry;

use App\Repositories\InvoiceRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\BeforeSheet;

class ImportInvoice implements ToCollection, WithEvents
{
    private $processedData = [];
    private int $currentSheetIndex = -1;

    private function getBuyerData(Collection $buyerData)
    {
        $isBuyerAddr = false;
        $isBuyerName = false;
        $buyerAddress = '';
        $buyerName = '';
        foreach ($buyerData as $index => $row) {

            if ($isBuyerName) {
                $buyerName = $row[0];
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
            if ($row[1] == "PPN") {
                $ppn = $row[10];
                break;
            }

            if ($isProductData && $row[0] != "") {
                $qty = (int)floatval($row[$rowQty] ?? '0');
                $discount = $row[$rowDiscount];
                $totalAmountProduct += $row[$rowRate] * $qty;
                if ($discount != 0) {
                    $discount = $discount/100;
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
    public function collection(Collection $rows)
    {
        if ($this->currentSheetIndex !== 0) {
            return;
        }
        $buyerData = $this->getBuyerData($rows);
        $invoiceData = $this->getInvoiceData($rows);
        $productData = $this->getProductData($rows, $invoiceData);

        $this->processedData = [
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
        ];
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
