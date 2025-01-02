<?php

namespace App\Utils\Primitives\Enum;

enum MasterDataCodeValues
{
    const PRODUCT_ITEM_TYPE = 'product_item_type';
    const PRODUCT_CATEGORY = 'product_item_category';
    const PRODUCT_ITEM_DIVISION = 'product_item_division';
    const PRODUCT_ITEM_BRAND = 'product_item_brand';
    const PRODUCT_ITEM_PACKING_SIZE = 'product_item_packing_size';

    public static function values(): array
    {
        return [
            self::PRODUCT_ITEM_TYPE,
            self::PRODUCT_CATEGORY,
            self::PRODUCT_ITEM_BRAND,
            self::PRODUCT_ITEM_DIVISION,
            self::PRODUCT_ITEM_PACKING_SIZE,
        ];
    }

    public static function valueObject(): array
    {
        $arr = [
            [
                'id' => self::PRODUCT_ITEM_DIVISION,
                'name' => self::PRODUCT_ITEM_DIVISION,
            ],
            [
                'id' => self::PRODUCT_ITEM_BRAND,
                'name' => self::PRODUCT_ITEM_BRAND,
            ],
            [
                'id' => self::PRODUCT_ITEM_TYPE,
                'name' => self::PRODUCT_ITEM_TYPE,
            ],
            [
                'id' => self::PRODUCT_ITEM_PACKING_SIZE,
                'name' => self::PRODUCT_ITEM_PACKING_SIZE,
            ],
            [
                'id' => self::PRODUCT_CATEGORY,
                'name' => self::PRODUCT_CATEGORY,
            ]
        ];
        return array_map(function ($value) {
            return new $value();
        }, $arr);
    }
}
