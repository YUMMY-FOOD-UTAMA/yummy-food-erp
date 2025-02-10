<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Invoice\CustomerInvoice;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;

class CustomerInvoiceRepository
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
        $onlyAvailableInvoice = $this->request->query('only_available_invoice');
        $pageSize = $this->request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $this->request->query('search');
        $customerInvoices = new CustomerInvoice();
        if ($this->onlyTrashed) {
            $customerInvoices = $customerInvoices->onlyTrashed();
        }
        if ($this->withTrashed) {
            $customerInvoices = $customerInvoices->withTrashed();
        }
        if ($onlyAvailableInvoice) {
            $customerInvoices = $customerInvoices->whereHas('invoices');
        }
        if ($searchKeyword) {
            $customerInvoices->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('account_name', 'like', '%' . $searchKeyword . '%');
            });
        }

        $customerInvoices = $customerInvoices
            ->orderByRaw("CASE WHEN account_name IS NULL OR account_name = '' THEN 1 ELSE 0 END, account_name")
            ->paginate($pageSize)
            ->appends(request()->query());

        return $customerInvoices;
    }
}
