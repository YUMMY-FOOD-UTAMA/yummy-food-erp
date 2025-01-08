<?php

namespace App\Repositories;

use App\Models\Product;
use App\Utils\Primitives\ListPageSize;
use Illuminate\Http\Request;

class ProductRepository
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

    public static function generateCodeAndName($brandId, $divisionId, $categoryId, $typeId, $packingSizeId)
    {
        if (!$brandId && !$divisionId && !$categoryId && !$typeId && !$packingSizeId) {
            return null;
        }
        $masterDataRepository = new MasterDataCodeValuesRepository;

        $brand = $masterDataRepository->getMasterDataById($brandId);
        $division = $masterDataRepository->getMasterDataById($divisionId);
        $category = $masterDataRepository->getMasterDataById($categoryId);
        $type = $masterDataRepository->getMasterDataById($typeId);
        $packingSize = $masterDataRepository->getMasterDataById($packingSizeId);

        $productCode = trim("{$brand->code}{$division->code}{$category->code}{$type->code}{$packingSize->code}");
        $productName = trim("{$brand->value} {$type->value} {$packingSize->value}");

        $productNameCode = new \stdClass();
        $productNameCode->productCode = $productCode;
        $productNameCode->productName = $productName;

        return $productNameCode;
    }

    public function all()
    {
        $pageSize = $this->request->query('page_size', ListPageSize::defaultPageSize());
        $search = $this->request->query('search');
        $brandID = $this->request->query('brand_id');
        $divisionID = $this->request->query('division_id');
        $categoryID = $this->request->query('category_id');
        $groupID = $this->request->query('group_id');
        $typeID = $this->request->query('type_id');

        $products = Product::with([
            'category',
            'brand',
            'division',
            'type',
            'packingSize'
        ]);
        if ($this->onlyTrashed) {
            $products->onlyTrashed();
        }
        if ($this->withTrashed) {
            $products->withTrashed();
        }
        if ($brandID) {
            $products->where('brand_id', $brandID);
        }
        if ($divisionID) {
            $products->where('division_id', $divisionID);
        }
        if ($categoryID) {
            $products->where('category_id', $categoryID);
        }
        if ($groupID) {
            $products->where('group_id', $groupID);
        }
        if ($typeID) {
            $products->where('type_id', $typeID);
        }
        if ($search) {
            $products->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('brand', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('division', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('group', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('type', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('manufacture', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('smallUnit', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('bigUnit', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $products = $products->orderBy('created_at', 'desc')->paginate($pageSize)->appends(request()->query());
        return $products;
    }
}
