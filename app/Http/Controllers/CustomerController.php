<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerCategory;
use App\Models\Customer\CustomerGroup;
use App\Repositories\CustomerRepository;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    use ApiResponseTrait;

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

    public function store(CreateCustomerRequest $request)
    {
        $customerGroup = CustomerGroup::where('id', $request->customer_group_id)->first();
        if (!$customerGroup) {
            $customerGroup = CustomerGroup::create([
                'name' => $request->customer_group_id,
            ]);
        }
        $request->merge(['customer_group_id' => $customerGroup->id]);
        $request->merge(['name_code' => Customer::generateNameCode(
            $request->area_id,
            $request->customer_segment_id,
            $request->customer_category_id,
        )]);
        Customer::create($request->all());
        return redirect()->route('receivable.customer.index')->with([
            'status' => 'success',
            'message' => 'created customer successfully'
        ]);
    }

    public function show($id)
    {
        $customers = new CustomerRepository;
        $customer = $customers->findOne($id);
        return view('customer.show', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customerGroup = CustomerGroup::where('id', $request->customer_group_id)->first();
        if (!$customerGroup) {
            $customerGroup = CustomerGroup::create([
                'name' => $request->customer_group_id,
            ]);
        }
        $request->merge(['customer_group_id' => $customerGroup->id]);
        $customer = Customer::find($id);
        $customer->update($request->all());

        return Redirect::back()->with([
            'status' => 'success',
            'message' => 'updated customer successfully'
        ]);
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

    public function apiGet(Request $request)
    {
        $customers = new CustomerRepository;
        $customers->setRequest($request);
        $customers->setWithBookedBy($request->query('with_booked_by', false));
        $customers->setNameIsNotNull($request->query('name_is_not_null', false));
        $customers->setOnlyTrashed($request->query('only_trashed', false));
        $customers->setWithTrashedOnly($request->query('with_trashed', false));
        $customers = $customers->getAll();

        return $this->successResponse($customers);
    }
}
