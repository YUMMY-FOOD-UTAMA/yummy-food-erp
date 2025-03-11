<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Invoice\CustomerInvoice;
use App\Repositories\CustomerInvoiceRepository;
use App\Repositories\EmployeeRepository;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\Request;

class CustomerInvoiceController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $customerInvoices = new CustomerInvoiceRepository();
        $customerInvoices->setRequest($request);
        $customerInvoices = $customerInvoices->getAll();
        return view('master_data.customer_invoice.index', compact(
            'customerInvoices',
        ));
    }

    public function edit($id)
    {
        $customerInvoice = CustomerInvoice::where('id', $id)->first();
        return view('master_data.customer_invoice.edit', compact('customerInvoice'));
    }

    public function update(Request $request, $id)
    {
        CustomerInvoice::where('id', $id)->update([
            'npwp_customer' => $request->npwp_customer,
            'id_tku_customer' => $request->id_tku_customer,
            'npwp_address' => $request->npwp_address
        ]);
        return redirect()->route('master-data.customer-invoice.index')->with([
            'status' => 'success',
            'message' => 'Customer Invoice has been updated!'
        ]);
    }

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
