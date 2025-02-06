<?php

namespace App\Exports\ReceivableEntry;

use App\Models\Invoice\Invoice;
use DateTime;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class ExportInvoiceTaxHeader implements FromCollection, WithColumnWidths, WithMapping, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $id;
    protected $request;

    public function __construct($id, $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    public function collection()
    {
        $invoice = Invoice::where('id', $this->id)->first();
        return $invoice;
    }

    public function headings(): array
    {
        return [
            ['NPWP Penjual', '', '0013470778007000'],
            ['', ''],
            ['Baris', 'Tanggal Faktur', 'Jenis Faktur', 'Kode Transaksi', 'Keterangan Tambahan', 'Dokumen Pendukung',
                'Referensi', 'Cap Fasilitas', 'ID TKU Penjual', 'NPWP/NIK Pembeli', 'Jenis ID Pembeli', 'Negara Pembeli', 'Nomor Dokumen Pembeli',
                'Nama Pembeli', 'Alamat Pembeli', 'Email Pembeli', 'ID TKU Pembeli'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:B1');

        $sheet->getStyle('A1:B1')->getFont()->setBold(true);
        $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A3:Q3')->getFont()->setBold(true);
        $sheet->getStyle('A3:Q3')->getAlignment()->setHorizontal('left');

        $sheet->getStyle('A4:A100')->getAlignment()->setHorizontal('left');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 20,
            'C' => 16,
            'D' => 16,
            'E' => 25,
            'F' => 25,
            'G' => 20,
            'H' => 20,
            'I' => 26,
            'J' => 26,
            'K' => 26,
            'L' => 26,
            'M' => 26,
            'N' => 30,
            'O' => 130,
            'P' => 80,
            'Q' => 30,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function map($invoice): array
    {
        $date = DateTime::createFromFormat('j-M-Y', $invoice->date);
        return [
            [
                1,
                Date::dateTimeToExcel($date),
                'Normal',
                $this->request->get('code_transaction') ?? '04',
                $this->request->get('additional_information') ?? '',
                $this->request->get('supporting_document') ?? '',
                $invoice->number,
                $this->request->get('facility_stamp') ?? '',
                '0013470778007000000000',
                $invoice->customer->npwp_customer,
                $this->request->get('buyer_id_type') ?? 'TIN',
                'IDN',
                $this->request->get('number_document_buyer') ?? '',
                $invoice->customer->name,
                $invoice->customer->npwp_address,
                $this->request->get('email_buyer') ?? '',
                $this->request->get('id_tku_buyer') ?? '',
            ],
            [
                2,
                Date::dateTimeToExcel($date),
                'Normal',
                $this->request->get('code_transaction') ?? '04',
                $this->request->get('additional_information') ?? '',
                $this->request->get('supporting_document') ?? '',
                $invoice->number,
                $this->request->get('facility_stamp') ?? '',
                '0013470778007000000000',
                $invoice->customer->npwp_customer,
                $this->request->get('buyer_id_type') ?? 'TIN',
                'IDN',
                $this->request->get('number_document_buyer') ?? '',
                $invoice->customer->name,
                $invoice->customer->npwp_address,
                $this->request->get('email_buyer') ?? '',
                $this->request->get('id_tku_buyer') ?? '',
            ],
            [
                'END'
            ]
        ];
    }
}
