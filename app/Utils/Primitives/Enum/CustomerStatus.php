<?php

namespace App\Utils\Primitives\Enum;

enum CustomerStatus
{
    const PROSPECT = 'Prospect';
    const NEW = 'New';
    const EXISTING = 'Existing';
    const LOYAL = "Loyal";

    public static function values(): array
    {
        return [
            self::PROSPECT,
            self::NEW,
            self::EXISTING,
            self::LOYAL,
        ];
    }

    public static function valuesObject(): array
    {
        $options = [
            [
                "id" => self::PROSPECT,
                "name" => self::PROSPECT
            ],
            [
                "id" => self::NEW,
                "name" => self::NEW
            ],
            [
                "id" => self::EXISTING,
                "name" => self::EXISTING
            ],
            [
                "id" => self::LOYAL,
                "name" => self::LOYAL
            ]
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }
}
