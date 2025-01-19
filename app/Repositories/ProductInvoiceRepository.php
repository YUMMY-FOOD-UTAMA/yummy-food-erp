<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Invoice\CustomerInvoice;
use App\Models\Invoice\ProductInvoice;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;

class ProductInvoiceRepository
{
    private Request $request;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getAll()
    {
        $pageSize = $this->request->query('page_size', ListPageSize::defaultPageSize());
        $searchKeyword = $this->request->query('search');
        $productInvoice = new ProductInvoice();
        if ($searchKeyword) {
            $productInvoice->where(function ($query) use ($searchKeyword) {
                $query->where('delivery_note', 'like', '%' . $searchKeyword . '%');
            });
        }

        $productInvoice = $productInvoice->orderByDesc('created_at')->paginate($pageSize)->appends(request()->query());

        return $productInvoice;
    }
}
