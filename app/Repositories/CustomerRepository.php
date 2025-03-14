<?php

namespace App\Repositories;

use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerRepository
{
    private Request $request;
    private bool $nameIsNotNull = false;
    private bool $onlyTrashed = false;
    private bool $withTrashed = false;
    private bool $withBookedBy = false;
    private bool $withEmployeeDetail = false;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setOnlyTrashed(bool $onlyTrashed): void
    {
        $this->onlyTrashed = $onlyTrashed;
    }

    public function setNameIsNotNull(bool $nameIsNotNull): void
    {
        $this->nameIsNotNull = $nameIsNotNull;
    }

    public function setWithTrashedOnly(bool $withTrashed): void
    {
        $this->withTrashed = $withTrashed;
    }

    public function setWithBookedBy(bool $withBookedBy): void
    {
        $this->withBookedBy = $withBookedBy;
    }

    private function setWithEmployeeDetail(bool $withEmployeeDetail): void
    {
        $this->withEmployeeDetail = $withEmployeeDetail;
    }


    public function findOne($id)
    {
        $customer = Customer::with(['area.region', 'customerSegment', 'customerCategory'])
            ->findOrFail($id);

        $areaCode = $customer->area?->code() ?? '';
        $regionCode = $customer->area?->region?->code() ?? '';
        $segmentCode = $customer->customerSegment?->code() ?? '';
        $categoryCode = $customer->customerCategory?->code() ?? '';
        $customer->code = Customer::codeFormater($regionCode,$areaCode,$segmentCode,$categoryCode,$customer->nameCode());

        return $customer;
    }


    public function getAll()
    {
        $pageSize = $this->request->query('page_size', 10);
        $regionID = $this->request->query('region_id');
        $areaID = $this->request->query('area_id');
        $customerCategoryID = $this->request->query('customer_category_id');
        $searchKeyword = $this->request->query('search');
        $availableCustomer = $this->request->query("available_customer");

        $customers = Customer::with([
            'customerCategory' => function ($query) {
                $query->select('id', 'name');
            },
            'customerGroup' => function ($query) {
                $query->select('id', 'name');
            },
            'customerSegment' => function ($query) {
                $query->select('id', 'name');
            },
            'area' => function ($query) {
                $query->select('id', 'region_id', 'name', 'description')->with([
                    'region' => function ($query) {
                        $query->select('id', 'name');
                    }
                ]);
            }
        ]);
        if ($this->withBookedBy) {
            $customers->with(['bookedBys.employee.user']);
        } else if ($this->withEmployeeDetail) {
            $customers->with(['employee.user']);
        }

        if ($this->onlyTrashed) {
            $customers->onlyTrashed();
        }
        if ($this->withTrashed) {
            $customers->withTrashed();
        }
        if (($availableCustomer == 0 || $availableCustomer == 1) && $availableCustomer != null) {
            if ($availableCustomer == 1) {
                $customers->where('is_booked_by_sales', false);
            } else {
                $customers->where('is_booked_by_sales', true);
            }
        }
        if ($this->nameIsNotNull) {
            $customers->whereNotNull('name')->where('name', '<>', '');
        }
        if ($areaID) {
            $customers->where('area_id', $areaID);
        }
        if ($regionID && !$areaID) {
            $customers->whereHas('area.region', function ($query) use ($regionID) {
                $query->where('region_id', $regionID);
            });
        }
        if ($customerCategoryID) {
            $customers->where('customer_category_id', $customerCategoryID);
        }
        if ($searchKeyword) {
            $customers->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('company_name', 'like', '%' . $searchKeyword . '%');
            });
        }
        $customers = $customers->orderByDesc('created_at')->paginate($pageSize)->appends(request()->query())
            ->through(function ($customer) {
                $areaCode = $customer->area ? $customer->area->code() : "";
                $regionCode = $customer->area?->region ? $customer->area->region->code() : "";
                $segmentCode = $customer->customerSegment ? $customer->customerSegment->code() : "";
                $categoryCode = $customer->customerCategory ? $customer->customerCategory->code() : "";
                $customer->code = Customer::codeFormater($regionCode,$areaCode,$segmentCode,$categoryCode,$customer->nameCode());
                return $customer;
            });

        return $customers;
    }
}
