<?php

namespace App\Utils\Primitives;

class DefaultCustomerDepartment
{
    public static function values(): array
    {
        $options = [
            [
                "id" => "Purchasing",
                "name" => "Purchasing"
            ],
            [
                "id" => "Finance",
                "name" => "Finance"
            ],
            [
                "id" => "Receiving",
                "name" => "Receiving"
            ],
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }
}
