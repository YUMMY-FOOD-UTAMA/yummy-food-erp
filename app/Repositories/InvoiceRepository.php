<?php

namespace App\Repositories;

use App\Models\Customer\Customer;
use App\Models\Invoice\CustomerInvoice;
use App\Models\Invoice\Invoice;
use App\Utils\Primitives\ListPageSize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceRepository
{
    private Request $request;
    private bool $onlyTrashed = false;
    private bool $withTrashed = false;
    private array $invoiceIDs = [];
    private bool $withOutPagination = false;
    private string $receiptNumber = "";

    private bool $receiptNumberNotNull = false;
    private bool $bstNumberNotNull = false;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setOnlyTrashed(bool $onlyTrashed): void
    {
        $this->onlyTrashed = $onlyTrashed;
    }

    public function setWithTrashed(bool $withTrashed): void
    {
        $this->withTrashed = $withTrashed;
    }

    public function setInvoiceIDs(array $invoiceIDs): void
    {
        $this->invoiceIDs = $invoiceIDs;
    }

    public function setWithOutPagination(bool $withOutPagination): void
    {
        $this->withOutPagination = $withOutPagination;
    }

    public function setReceiptNumber(string $receiptNumber): void
    {
        $this->receiptNumber = $receiptNumber;
    }

    public function setReceiptNumberNotNull(bool $receiptNumberNotNull): void
    {
        $this->receiptNumberNotNull = $receiptNumberNotNull;
    }

    public function setBstNumberNotNull(bool $bstNumberNotNull): void
    {
        $this->bstNumberNotNull = $bstNumberNotNull;
    }

    public function generateReceiptNumber()
    {
        $now = Carbon::now('Asia/Jakarta');
        $year = $now->format('y');
        $month = $now->format('m');
        $day = $now->format('d');

        $receiptPrefix = "IR.{$year}{$month}{$day}";

        $latestReceipt = Invoice::where('receipt_number', 'like', "{$receiptPrefix}%")
            ->orderBy('receipt_number', 'desc')
            ->first();

        if ($latestReceipt) {
            $lastNumber = (int)substr($latestReceipt->receipt_number, -2);
            $nextNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '01';
        }
        $receiptNumber = "{$receiptPrefix}{$nextNumber}";

        return $receiptNumber;
    }

    public function generateBSTNumber()
    {
        $now = Carbon::now('Asia/Jakarta');
        $year = $now->format('y');
        $month = $now->format('m');
        $day = $now->format('d');

        $bstPrefix = "BST.{$year}{$month}{$day}";

        $latestBst = Invoice::where('bst_number', 'like', "{$bstPrefix}%")
            ->orderBy('bst_number', 'desc')
            ->first();

        if ($latestBst) {
            $lastNumber = (int)substr($latestBst->bst_number, -2);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '001';
        }
        $bstNumber = "{$bstPrefix}{$nextNumber}";

        return $bstNumber;
    }

    public function getAll()
    {
        $pageSize = $this->request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $this->request->query('search');
        $startDate = $this->request->query('start_date');
        $endDate = $this->request->query('end_date');
        $startCreatedDate = $this->request->query('start_created_at');
        $endCreatedDate = $this->request->query('end_created_at');
        $customerID = $this->request->query('customer_invoice_id');
        $customerName = $this->request->query('customer_name');
        $customerName = CustomerInvoice::where('id', $customerName)->first()->name ?? null;
        $productInvoiceID = $this->request->query('product_invoice_id');
        $invoiceNo = $this->request->query('invoice_no');
        $invoiceID = $this->request->query('invoice_id');
        $bstNumber = $this->request->query('bst_number');

        $invoices = Invoice::with([
            'products',
            'customer'
        ]);

        if ($this->onlyTrashed) {
            $invoices = $invoices->onlyTrashed();
        }
        if ($this->withTrashed) {
            $invoices = $invoices->withTrashed();
        }
        if ($this->invoiceIDs) {
            $invoices = $invoices->whereIn('id', $this->invoiceIDs);
        }
        if ($this->receiptNumber) {
            $invoices = $invoices->where('receipt_number', $this->receiptNumber);
        }
        if ($this->receiptNumberNotNull) {
            $invoices = $invoices->whereNotNull('receipt_number');
        }
        if ($this->bstNumberNotNull) {
            $invoices = $invoices->whereNotNull('bst_number');
        }
        if ($searchKeyword) {
            $invoices->where(function ($query) use ($searchKeyword) {
                $query->where('number', 'like', '%' . $searchKeyword . '%')
                    ->orWhereHas('customer', function ($query) use ($searchKeyword) {
                        $query->where('name', 'like', '%' . $searchKeyword . '%')
                            ->orWhere('account_name', 'like', '%' . $searchKeyword . '%');
                    })
                    ->orWhere('supplier_name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('supplier_ref', 'like', '%' . $searchKeyword . '%');
            });
        }
        if ($startDate && $endDate) {
            $invoices->whereBetween(
                \DB::raw("STR_TO_DATE(date, '%e-%b-%Y')"),
                [$startDate, $endDate]
            );
        }
        if ($customerName) {
            $invoices->whereHas('customer', function ($query) use ($customerName) {
                $query->where('name', $customerName);
            });
        }
        if ($startCreatedDate && $endCreatedDate) {
            $invoices->whereBetween(DB::raw('DATE(created_at)'), [$startCreatedDate, $endCreatedDate]);
        }
        if ($invoiceID) {
            $invoices->where('id', $invoiceID);
        }
        if ($customerID) {
            $invoices->where('customer_invoice_id', $customerID);
        }
        if ($productInvoiceID) {
            $invoices->whereHas('products', function ($query) use ($productInvoiceID) {
                $query->where('id', $productInvoiceID);
            });
        }
        if ($invoiceNo) {
            $invoices->where('number', $invoiceNo);
        }
        if ($bstNumber) {
            $invoices->where('bst_number', $bstNumber);
        }

        if ($this->withOutPagination) {
            $invoices = $invoices->orderByDesc('created_at')->get();
        } else {
            $invoices = $invoices->orderByDesc('created_at')->paginate($pageSize)->appends(request()->query());
        }
        return $invoices;
    }
}
