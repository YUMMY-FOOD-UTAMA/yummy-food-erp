<?php

namespace App\Exports\ReceivableEntry;

use App\Models\Invoice\Invoice;
use Carbon\Carbon;
use DateTime;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExportInvoiceTax implements WithMultipleSheets
{
    protected $invoices;
    protected $request;
    protected $ppn;

    public function __construct($invoices, $request)
    {
        ;
        $this->invoices = $invoices;
        $this->request = $request;
        $this->ppn = $request->get("ppn");
    }

    public function sheets(): array
    {
        return [
            new ExportInvoiceTaxHeader($this->invoices, $this->request),
            new ExportInvoiceTaxBody($this->invoices, $this->ppn),
        ];
    }
}

class ExportInvoiceTaxHeader implements FromArray, WithTitle, WithColumnWidths, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $invoices;
    protected $request;

    public function __construct($invoices, $request)
    {
        $this->invoices = $invoices;
        $this->request = $request;
    }

    public function title(): string
    {
        return 'Faktur';
    }

    public function headings(): array
    {
        return [
            ['NPWP Penjual', '', '0013470778007000'],
            ['', ''],
            ['Baris', 'Tanggal Faktur', 'Jenis Faktur', 'Kode Transaksi', 'Keterangan Tambahan', 'Dokumen Pendukung',
                'Period Dok Pendukung',
                'Referensi', 'Cap Fasilitas', 'ID TKU Penjual', 'NPWP/NIK Pembeli', 'Jenis ID Pembeli', 'Negara Pembeli', 'Nomor Dokumen Pembeli',
                'Nama Pembeli', 'Alamat Pembeli', 'Email Pembeli', 'ID TKU Pembeli'],
        ];
    }

    public function array(): array
    {
        $rowIndex = 0;
        $data[] = [];
        foreach ($this->invoices as $i => $invoice) {
            $rowIndex++;
            $date = Carbon::createFromFormat('j-M-Y', $invoice->date)->format("m/d/Y");
            $data[] = [
                $rowIndex,
                $date,
                'Normal',
                $this->request->get('code_transaction') ?? '04',
                $this->request->get('additional_information') ?? '',
                $this->request->get('supporting_document') ?? '',
                $this->request->get('period_document_supporting') ?? '',
                $invoice->number,
                $this->request->get('facility_stamp') ?? '',
                '0013470778007000000000',
                $invoice->customer->npwp_customer,
                $this->request->get('buyer_id_type') ?? 'TIN',
                'IDN',
                $this->request->get('number_document_buyer') ?? '-',
                $invoice->customer->name,
                $invoice->customer->npwp_address,
                $this->request->get('email_buyer') ?? '',
                $invoice->customer->id_tku_customer,
            ];
        }
        $data[] = ['END'];
        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true);
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('B1:B1000')->getAlignment()->setHorizontal('right');
        $sheet->getStyle('A3:Q3')->getFont()->setBold(true);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8, 'B' => 20, 'C' => 16, 'D' => 16, 'E' => 25,
            'F' => 25, 'G' => 25, 'H' => 20, 'I' => 26, 'J' => 26,
            'K' => 26, 'L' => 26, 'M' => 26, 'N' => 30, 'O' => 80,
            'P' => 130, 'Q' => 30, 'R' => 30,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'Q' => NumberFormat::FORMAT_TEXT,
        ];
    }
}

class ExportInvoiceTaxBody implements FromArray, WithTitle, WithHeadings, WithColumnWidths, WithStyles
{
    protected $invoices;
    protected $ppn;

    public function __construct($invoices, $ppn)
    {
        $this->invoices = $invoices;
        $this->ppn = $ppn;
    }

    public function title(): string
    {
        return 'DetailFaktur';
    }

    public function headings(): array
    {
        return [
            ['Baris', 'Barang/Jasa', 'Kode Barang Jasa', 'Nama Barang/Jasa', 'Nama Satuan Ukur', 'Harga Satuan', 'Jumlah Barang Jasa',
                'Total Diskon', 'DPP', 'DPP Nilai Lain', 'Tarif PPN', 'PPN', 'Tarif PPnBM', 'PPnBM'],
        ];
    }

    public function array(): array
    {
        $data = [];
        $rowIndex = 0;

        foreach ($this->invoices as $invoice) {
            $rowIndex++;
            foreach ($invoice->products as $item) {
                $unit = "UM.0033";
                if ($item->unit == "pcs") {
                    $unit = "UM.0021";
                }

                $data[] = [
                    $rowIndex,
                    "A", // Barang atau jasa
                    "000000", // Kode barang jasa
                    $item->name,
                    $unit,
                    ceil($item->rate),
                    $item->quantity,
                    ceil($item->calculate($this->ppn)["discount_total"]) != 0 ? ceil($item->calculate($this->ppn)["discount_total"]) : '0',
                    ceil($item->calculate($this->ppn)["dpp"]),
                    ceil($item->calculate($this->ppn)["dpp_etc_value"]),
                    12, // Tarif PPN tetap
                    ceil($item->calculate($this->ppn)["ppn12"]),
                    0,
                    0,
                ];

            }
        }
        $data[] = ['END'];

        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->getFont()->setBold(false);
        $sheet->getStyle('A1:N1')->getAlignment()->setHorizontal('left');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8, 'B' => 20, 'C' => 20, 'D' => 50, 'E' => 20,
            'F' => 15, 'G' => 25, 'H' => 15, 'I' => 15, 'J' => 20,
            'K' => 10, 'L' => 15, 'M' => 20, 'N' => 15,
        ];
    }
}
