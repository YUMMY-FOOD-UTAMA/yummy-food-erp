<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\MasterDataCodeValue;
use App\Models\Product;
use App\Repositories\EmployeeRepository;
use App\Repositories\MasterDataCodeValuesRepository;
use App\Repositories\ProductRepository;
use App\Trait\ApiResponseTrait;
use App\Utils\Primitives\Enum\MasterDataCodeValues;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponseTrait;

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
            'masterDataCategories' => $masterDataRepository->getMasterDataCategory(),
            'masterDataDivisions' => $masterDataRepository->getMasterDataDivision(),
            'masterDataPackingSize' => $masterDataRepository->getMasterDataPackingSize(),
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
            'masterDataCategories' => $masterDataRepository->getMasterDataCategory(),
            'masterDataDivisions' => $masterDataRepository->getMasterDataDivision(),
            'masterDataPackingSize' => $masterDataRepository->getMasterDataPackingSize(),
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $brandId = $request->input('brand_id');
        $divisionId = $request->input('division_id');
        $categoryId = $request->input('category_id');
        $typeId = $request->input('type_id');
        $packingSizeId = $request->input('packing_size_id');

        $productCodeAndName = ProductRepository::generateCodeAndName($brandId, $divisionId, $categoryId, $typeId, $packingSizeId);

        Product::create([
            'code' => $productCodeAndName->productCode,
            'name' => $productCodeAndName->productName,
            'brand_id' => $brandId,
            'division_id' => $divisionId,
            'category_id' => $categoryId,
            'type_id' => $typeId,
            'packing_size_id' => $request->packing_size_id,
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
            'masterDataCategories' => $masterDataRepository->getMasterDataCategory(),
            'masterDataDivisions' => $masterDataRepository->getMasterDataDivision(),
            'masterDataPackingSize' => $masterDataRepository->getMasterDataPackingSize(),
        ]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $brandId = $request->input('brand_id');
        $divisionId = $request->input('division_id');
        $categoryId = $request->input('category_id');
        $typeId = $request->input('type_id');
        $packingSizeId = $request->input('packing_size_id');

        $productCodeAndName = ProductRepository::generateCodeAndName($brandId, $divisionId, $categoryId, $typeId, $packingSizeId);

        Product::where('id', $id)->update([
            'code' => $productCodeAndName->productCode,
            'name' => $productCodeAndName->productName,
            'brand_id' => $brandId,
            'division_id' => $divisionId,
            'category_id' => $categoryId,
            'type_id' => $typeId,
            'packing_size_id' => $request->packing_size_id,
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

    public function generateNameCode(Request $request)
    {
        $brandId = $request->brandId;
        $divisionId = $request->divisionId;
        $categoryId = $request->categoryId;
        $typeId = $request->typeId;
        $packingSizeId = $request->packingSizeId;

        $result = ProductRepository::generateCodeAndName($brandId, $divisionId, $categoryId, $typeId, $packingSizeId);

        return $this->successResponse([
            'productCode' => $result->productCode,
            'productName' => $result->productName,
        ]);
    }

    public function apiGet(Request $request)
    {
        $products = new ProductRepository;
        $products->setRequest($request);

        $products = $products->all();
        return $this->successResponse($products);
    }
}
