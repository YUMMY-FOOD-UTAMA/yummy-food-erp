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

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        if ($this->currentSheetIndex !== 0) {
            return;
        }
        $products = [];
        $netRate = 0;

        $isProductData = false;
        $totalAmountProduct = 0;
        $ppn = 0;
        $totalAmountAfterPPN = 0;
        $totalQuantity = 0;
        $deliveryNotes = explode(",", trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $rows[4][6]))));
        $buyerOrderNumbers = explode(",", trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $rows[8][6]))));
        $productBuyerDates = explode(",", trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $rows[8][9]))));
        $deliveryNoteDates = explode(",", trim(preg_replace('/\s*,\s*/', ',', str_replace(':', '', $rows[10][9]))));
        foreach ($rows as $index => $row) {
            if ($row[1] == "PPN") {
                $ppn = $row[10];
                $totalQuantity = $rows[$index + 1][9];
                $totalAmountAfterPPN = $rows[$index + 1][14];
                $totalAmountProduct = $row[14];
                $netRate = $rows[$index - 1][13];
                break;
            }
            if ($isProductData && $row[0] != null && $row[0] != "") {
                $products[] = [
                    'name' => $row[0],
                    'quantity' => $row[9] ?? 0,
                    'rate' => $row[10] ?? 0,
                    'unit' => $row[11] ?? "",
                    'discount' => $row[12] ?? 0,
                    'net_rate' => $row[13] ?? 0,
                    'amount' => $row[14] ?? 0,
                    'delivery_note' => $deliveryNotes[count($products)] ?? "",
                    'buyer_order_number' => $buyerOrderNumbers[count($products)] ?? "",
                    'date' => $productBuyerDates[count($products)] ?? "",
                    'delivery_note_date' => $deliveryNoteDates[count($products)] ?? "",
                ];
            }
            if ($row[0] == "Description of Goods") {
                $isProductData = true;
            }

        }

        $invoiceNo = ltrim($rows[2][6], ": ") ?? "";
        $date = $rows[2][9] ?? "";
        $customerName = $rows[6][0] ?? "";
        $address = trim($rows[7][0] . " " . $rows[8][0] . " " . $rows[9][0] . " " . $rows[10][0] . " " . $rows[11][0]) ?? "";
        $supplierName = $rows[1][0];
        $TOP = $rows[4][9] ?? "";
        $supplierRef = $rows[6][6] ?? "";
        $termOfDelivery = $rows[14][6] ?? "";


        $this->processedData = [
            'invoice_number' => $invoiceNo,
            'invoice_date' => $date,
            'supplier_address' => "Jl. Raya Bogor No. 40 Kec. Ciracas, Jakarta 13750, Indonesia",
            'customer_name' => $customerName,
            'address' => $address,
            'products' => $products,
            'product_total_amount' => $totalAmountProduct,
            'total_quantity_product' => $totalQuantity,
            'product_total_net_rate' => $netRate,
            'ppn' => $ppn,
            'product_total_amount_ppn' => $totalAmountAfterPPN,
            'term_of_payment' => $TOP,
            'term_of_delivery' => $termOfDelivery,
            'supplier_ref' => $supplierRef,
            'supplier_name' => $supplierName,
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
