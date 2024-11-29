<?php

namespace App\Http\Repositories;

use App\Helpers\GetParams;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerRepository
{
    private Request $request;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setOnlyTrashed(bool $onlyTrashed): void
    {
        $this->onlyTrashed = $onlyTrashed;
    }

    private bool $onlyTrashed = false;

    public function getAll()
    {
        $pageSize = $this->request->query('page_size', 10);
        $regionID = $this->request->query('region_id');
        $subRegionID = $this->request->query('sub_region_id');
        $areaID = $this->request->query('area_id');
        $customerCategoryID = $this->request->query('customer_category_id');
        $searchKeyword = $this->request->query('search');

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
                $query->select('id', 'sub_region_id', 'name', 'code')->with([
                    'subRegion' => function ($query) {
                        $query->select('id', 'region_id', 'name', 'code')->with([
                            'region' => function ($query) {
                                $query->select('id', 'name', 'code', 'covered');
                            }
                        ]);
                    }
                ]);
            }
        ]);
        if ($this->onlyTrashed) {
            $customers->onlyTrashed();
        }
        if ($areaID) {
            $customers->where('area_id', $areaID);
        }
        if ($subRegionID && !$areaID) {
            $customers->whereHas('area', function ($query) use ($subRegionID) {
                $query->where('sub_region_id', $subRegionID);
            });
        }
        if ($regionID && !$subRegionID && !$areaID) {
            $customers->whereHas('area.subRegion', function ($query) use ($regionID) {
                $query->where('region_id', $regionID);
            });
        }
        if ($customerCategoryID) {
            $customers->where('customer_category_id', $customerCategoryID);
        }
        if ($searchKeyword) {
            $customers->where(function ($query) use ($searchKeyword) {
                $query->where('name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('code', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('company_name', 'like', '%' . $searchKeyword . '%');
            });
        }
        $customers = $customers->orderByDesc('created_at')->paginate($pageSize)->appends(request()->query());

        return $customers;
    }
}
