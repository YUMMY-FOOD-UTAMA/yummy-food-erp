<?php

namespace App\Utils\Primitives\Enum;

enum MasterDataCodeValues
{
    const PRODUCT_ITEM_TYPE = 'product_item_type';
    const PRODUCT_CATEGORY = 'product_item_category';
    const PRODUCT_ITEM_GROUP = 'product_item_group';
    const PRODUCT_ITEM_MANUFACTURE = 'product_item_manufacture';
    const PRODUCT_ITEM_DIVISION = 'product_item_division';
    const PRODUCT_ITEM_BRAND = 'product_item_brand';
    const PRODUCT_UNIT_SMALL = 'small_unit';
    const PRODUCT_UNIT_BIG = 'big_unit';

    public static function values(): array
    {
        return [
            self::PRODUCT_ITEM_TYPE,
            self::PRODUCT_CATEGORY,
            self::PRODUCT_ITEM_GROUP,
            self::PRODUCT_ITEM_MANUFACTURE,
            self::PRODUCT_UNIT_SMALL,
            self::PRODUCT_UNIT_BIG,
            self::PRODUCT_ITEM_BRAND,
            self::PRODUCT_ITEM_DIVISION,
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
                'id' => self::PRODUCT_UNIT_BIG,
                'name' => self::PRODUCT_UNIT_BIG,
            ],
            [
                'id' => self::PRODUCT_UNIT_SMALL,
                'name' => self::PRODUCT_UNIT_SMALL,
            ],
            [
                'id' => self::PRODUCT_ITEM_TYPE,
                'name' => self::PRODUCT_ITEM_TYPE,
            ],
            [
                'id' => self::PRODUCT_ITEM_GROUP,
                'name' => self::PRODUCT_ITEM_GROUP,
            ],
            [
                'id' => self::PRODUCT_ITEM_MANUFACTURE,
                'name' => self::PRODUCT_ITEM_MANUFACTURE,
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
