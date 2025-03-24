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
        // Get current date with specified format `yymmdd`
        $currentDate = Carbon::now('Asia/Jakarta')->format('ymd');
        // Get current date to throw exception
        $throw = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        // Set format for receipt number
        $receiptNumberFomat = "IR.{$currentDate}";
        // Get new sequence of receipt numbers with specified receipt number format
        $newSequenceNumber = Invoice::selectRaw('COALESCE(CAST(SUBSTR(MAX(receipt_number),10) AS INT) + 1, 1) AS new_sequence')
            ->where('receipt_number', 'LIKE', "{$receiptNumberFomat}%")    
            ->first();
        // throw exception when new sequence number reached limit
        if ($newSequenceNumber->new_sequence > 999) {
            throw new \Exception("Reach limit Receipt Number in current day ({$throw})", 400);
        }
        // Set format for incrementing sequence number
        $newSequenceNumber = str_pad($newSequenceNumber->new_sequence, 3, '0', STR_PAD_LEFT);
        // Set new receipt number
        $newReceiptNumber = "{$receiptNumberFomat}{$newSequenceNumber}";
        // return new receipt number
        return $newReceiptNumber;
    }

    public function generateBSTNumber()
    {
        // Get current date with specified format `yymmdd`
        $currentDate = Carbon::now('Asia/Jakarta')->format('ymd');
        // get current month with specified format `yymm`
        $currentMonth = Carbon::now('Asia/Jakarta')->format('ym');
        // Get current date to throw exception
        $throw = Carbon::now('Asia/Jakarta')->format('F');
        // Set format for BST number
        $bstNumberFomat = "BST.{$currentDate}";
        // Set format for BST number checker
        $bstNumberChecker = "BST.{$currentMonth}";
        // Get new sequence of BST numbers with specified BST number format
        $newSequenceNumber = Invoice::selectRaw('COALESCE(CAST(SUBSTR(MAX(bst_number),11) AS INT) + 1, 1) AS new_sequence')
            ->where('bst_number', 'LIKE', "{$bstNumberChecker}%")    
            ->first();
        // throw exception when new sequence number reached limit
        if ($newSequenceNumber->new_sequence > 999) {
            throw new \Exception("Reach limit BST Number in current month ({$throw})", 400);
        }
        // Set format for incrementing sequence number
        $newSequenceNumber = str_pad($newSequenceNumber->new_sequence, 3, '0', STR_PAD_LEFT);
        // Set new BST number
        $newBstNumber = "{$bstNumberFomat}{$newSequenceNumber}";
        // return new BST number
        return $newBstNumber;
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
