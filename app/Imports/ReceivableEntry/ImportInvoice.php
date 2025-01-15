<?php

namespace App\Imports\ReceivableEntry;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportInvoice implements ToCollection
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        $invoiceNo = ltrim($rows[2][6],": ");
        $date = $rows[2][9];
        $address = $rows[2][0];
        $city = explode(" ",$rows[3][0])[0];
        $postalCode = explode(" ",$rows[3][0])[1];
        $country = $rows[4][0];
        $deliveryNote = ltrim($rows[4][6],": ");
        $TOP = $rows[4][9];
//        dd($invoiceNo, $date, $address, $city, $postalCode, $deliveryNote);
        foreach ($rows as $row) {
            dd($rows[4]);
            foreach ($row as $index => $value) {
                if ($value == "PPN") {
                    dd($row);
                    dd($row[1]);
                }
            }
        }
    }
}
