<?php

namespace App\Http\Controllers\ReceivableEntry;

use App\Http\Controllers\Controller;
use App\Imports\ReceivableEntry\ImportInvoice;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function readInvoice()
    {
        $filePath = public_path('Contoh-Format-Excel-Invoice.xlsx');
        if (!file_exists($filePath)) {
            dd('File Not Found');
        }
        // Import file Excel
        $data = Excel::import(new ImportInvoice, $filePath);
    }
}
