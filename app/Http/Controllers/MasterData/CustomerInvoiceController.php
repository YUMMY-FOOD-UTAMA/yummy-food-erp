<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerInvoiceRepository;
use App\Repositories\EmployeeRepository;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\Request;

class CustomerInvoiceController extends Controller
{
    use ApiResponseTrait;

    public function apiGet(Request $request)
    {
        $customerInvoices = new CustomerInvoiceRepository();
        $customerInvoices->setRequest($request);
        $customerInvoices->setOnlyTrashed($request->query('only_trashed', false));
        $customerInvoices->setWithTrashed($request->query('with_trashed', false));

        $customerInvoices = $customerInvoices->getAll();
        return $this->successResponse($customerInvoices);
    }
}
