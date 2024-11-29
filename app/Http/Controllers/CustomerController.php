<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CustomerRepository;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = new CustomerRepository;
        $customers->setRequest($request);
        $customers = $customers->getAll();

        $customerCategories = CustomerCategory::all();
        return view('customer.index', compact(
            'customers',
            'customerCategories',
        ));
    }

    public function trash(Request $request)
    {
        $customers = new CustomerRepository;
        $customers->setRequest($request);
        $customers->setOnlyTrashed(true);
        $customers = $customers->getAll();

        $customerCategories = CustomerCategory::all();
        return view('customer.trash', compact(
            'customers',
            'customerCategories',
        ));
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return Redirect::back()->with([
            'status' => 'success',
            'message' => 'Customer has been deleted!.'
        ]);
    }

    public function restore($id)
    {
        Customer::onlyTrashed()->where('id', $id)->restore();

        return Redirect::back()->with([
            'status' => 'success',
            'message' => 'Customer has been restored!.'
        ]);
    }
}
