<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\MasterDataCodeValue;
use App\Models\Product;
use App\Repositories\MasterDataCodeValuesRepository;
use App\Repositories\ProductRepository;
use App\Utils\Primitives\Enum\MasterDataCodeValues;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = new ProductRepository;
        $products->setRequest($request);
        $products = $products->all();
        $masterDataRepository = new MasterDataCodeValuesRepository;
        return view('inventory.product.index', [
            'products' => $products,
            'masterDataBrands' => $masterDataRepository->getMasterDataBrand(),
            'masterDataTypes' => $masterDataRepository->getMasterDataType(),
            'masterDataManufacture' => $masterDataRepository->getMasterDataManufacture(),
            'masterDataCategories' => $masterDataRepository->getMasterDataCategory(),
            'masterDataGroups' => $masterDataRepository->getMasterDataGroup(),
            'masterDataDivisions' => $masterDataRepository->getMasterDataDivision(),
            'masterDataSmallUnits' => $masterDataRepository->getMasterDataSmallUnit(),
            'masterDataBigUnits' => $masterDataRepository->getMasterDataBigUnit(),
        ]);
    }

    public function trash(Request $request)
    {
        $products = new ProductRepository;
        $products->setRequest($request);
        $products->setOnlyTrashed(true);
        $products = $products->all();
        $masterDataRepository = new MasterDataCodeValuesRepository;
        return view('inventory.product.trash', [
            'products' => $products,
            'masterDataBrands' => $masterDataRepository->getMasterDataBrand(),
            'masterDataTypes' => $masterDataRepository->getMasterDataType(),
            'masterDataManufacture' => $masterDataRepository->getMasterDataManufacture(),
            'masterDataCategories' => $masterDataRepository->getMasterDataCategory(),
            'masterDataGroups' => $masterDataRepository->getMasterDataGroup(),
            'masterDataDivisions' => $masterDataRepository->getMasterDataDivision(),
            'masterDataSmallUnits' => $masterDataRepository->getMasterDataSmallUnit(),
            'masterDataBigUnits' => $masterDataRepository->getMasterDataBigUnit(),
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $masterDataRepository = new MasterDataCodeValuesRepository;

        $brandId = $request->input('brand_id');
        $divisionId = $request->input('division_id');
        $categoryId = $request->input('category_id');
        $groupId = $request->input('group_id');
        $typeId = $request->input('type_id');
        $manufactureId = $request->input('manufacture_id');

        $brand = $masterDataRepository->getMasterDataById($brandId);
        $division = $masterDataRepository->getMasterDataById($divisionId);
        $category = $masterDataRepository->getMasterDataById($categoryId);
        $group = $masterDataRepository->getMasterDataById($groupId);
        $type = $masterDataRepository->getMasterDataById($typeId);
        $manufacture = $masterDataRepository->getMasterDataById($manufactureId);

        $productID = trim("{$brand->code}{$division->code}{$category->code}{$group->code}{$type->code}{$manufacture->code}");
        $productName = trim("{$brand->value} {$division->value} {$category->value} {$group->value} {$manufacture->value}");

        Product::create([
            'code' => $productID,
            'name' => $productName,
            'brand_id' => $brandId,
            'division_id' => $divisionId,
            'category_id' => $categoryId,
            'group_id' => $groupId,
            'type_id' => $typeId,
            'manufacture_id' => $manufactureId,
            'small_unit_id' => $request->small_unit_id,
            'big_unit_id' => $request->big_unit_id,
        ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Create Product Successfully!'
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->withTrashed()->firstOrFail();
        $masterDataRepository = new MasterDataCodeValuesRepository;
        return view('inventory.product.show', [
            'product' => $product,
            'masterDataBrands' => $masterDataRepository->getMasterDataBrand(),
            'masterDataTypes' => $masterDataRepository->getMasterDataType(),
            'masterDataManufacture' => $masterDataRepository->getMasterDataManufacture(),
            'masterDataCategories' => $masterDataRepository->getMasterDataCategory(),
            'masterDataGroups' => $masterDataRepository->getMasterDataGroup(),
            'masterDataDivisions' => $masterDataRepository->getMasterDataDivision(),
            'masterDataSmallUnits' => $masterDataRepository->getMasterDataSmallUnit(),
            'masterDataBigUnits' => $masterDataRepository->getMasterDataBigUnit(),
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $masterDataRepository = new MasterDataCodeValuesRepository;
        $brandId = $request->input('brand_id');
        $divisionId = $request->input('division_id');
        $categoryId = $request->input('category_id');
        $groupId = $request->input('group_id');
        $typeId = $request->input('type_id');
        $manufactureId = $request->input('manufacture_id');

        $brand = $masterDataRepository->getMasterDataById($brandId);
        $division = $masterDataRepository->getMasterDataById($divisionId);
        $category = $masterDataRepository->getMasterDataById($categoryId);
        $group = $masterDataRepository->getMasterDataById($groupId);
        $type = $masterDataRepository->getMasterDataById($typeId);
        $manufacture = $masterDataRepository->getMasterDataById($manufactureId);

        $productID = trim("{$brand->code}{$division->code}{$category->code}{$group->code}{$type->code}{$manufacture->code}");
        $productName = trim("{$brand->value} {$division->value} {$category->value} {$group->value} {$manufacture->value}");

        Product::where('id', $id)->update([
            'code' => $productID,
            'name' => $productName,
            'brand_id' => $brandId,
            'division_id' => $divisionId,
            'category_id' => $categoryId,
            'group_id' => $groupId,
            'type_id' => $typeId,
            'manufacture_id' => $manufactureId,
            'small_unit_id' => $request->small_unit_id,
            'big_unit_id' => $request->big_unit_id,
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Update Product Successfully!'
        ]);
    }

    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Product has been deleted'
        ]);
    }

    public function restore($id)
    {
        Product::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Product has been restored'
        ]);
    }
}
