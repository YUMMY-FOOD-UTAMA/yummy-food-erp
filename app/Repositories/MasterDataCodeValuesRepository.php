<?php

namespace App\Repositories;

use App\Models\MasterDataCodeValue;
use App\Utils\Primitives\Enum\MasterDataCodeValues;

class MasterDataCodeValuesRepository
{

    public function getMasterData(string $type)
    {
        return MasterDataCodeValue::where('type', $type)->get();
    }

    public function getMasterDataById($id)
    {
        if (!$id) {
            return '';
        }

        return MasterDataCodeValue::where('id', $id)->first();
    }

    public function getMasterDataBrand()
    {
        return self::getMasterData(MasterDataCodeValues::PRODUCT_ITEM_BRAND);
    }

    public function getMasterDataType()
    {
        return self::getMasterData(MasterDataCodeValues::PRODUCT_ITEM_TYPE);
    }

    public function getMasterDataCategory()
    {
        return self::getMasterData(MasterDataCodeValues::PRODUCT_CATEGORY);
    }

    public function getMasterDataDivision()
    {
        return self::getMasterData(MasterDataCodeValues::PRODUCT_ITEM_DIVISION);
    }

    public function getMasterDataPackingSize()
    {
        return self::getMasterData(MasterDataCodeValues::PRODUCT_ITEM_PACKING_SIZE);
    }
}
