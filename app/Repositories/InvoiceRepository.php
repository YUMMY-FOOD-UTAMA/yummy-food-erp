<?php

namespace App\Repositories;

use App\Models\Invoice\Invoice;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;

class InvoiceRepository
{
    private Request $request;
    private bool $onlyTrashed = false;
    private bool $withTrashed = false;

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

    public function getAll()
    {
        $pageSize = $this->request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $this->request->query('search');
        $startDate = $this->request->query('start_date');
        $endDate = $this->request->query('end_date');
        $customerID = $this->request->query('customer_id');
        $productInvoiceID = $this->request->query('product_invoice_id');
        $invoiceNo = $this->request->query('invoice_no');
        $invoiceID = $this->request->query('invoice_id');

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
            $invoices->whereBetween('created_at', [$startDate, $endDate]);
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


        $invoices = $invoices->orderByDesc('created_at')->paginate($pageSize)->appends(request()->query());
        return $invoices;
    }
}
