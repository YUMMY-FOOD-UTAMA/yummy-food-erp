<?php

namespace App\Utils\Primitives\Enum;

enum SalesScheduleVisitCategory
{
    const FIELD = 'Field Visit';
    const CALL = 'Call Visit';

    public static function values(): array
    {
        return [
            self::FIELD,
            self::CALL,
        ];
    }

    public static function valuesObject(): array
    {
        $options = [
            [
                "id" => self::FIELD,
                "name" => self::FIELD
            ],
            [
                "id" => self::CALL,
                "name" => self::CALL
            ],
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }
}
