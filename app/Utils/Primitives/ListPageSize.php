<?php

namespace App\Utils\Primitives;

class ListPageSize
{
    public static function defaultPageSize()
    {
        return 10;
    }

    public static function pageSizes(): array
    {
        $options = [
            [
                "id" => 10,
                "name" => "10"
            ],
            [
                "id" => 25,
                "name" => "25"
            ],
            [
                "id" => 50,
                "name" => "50"
            ],
            [
                "id" => 100,
                "name" => "100"
            ],
            [
                "id" => 200,
                "name" => "200"
            ],
            [
                "id" => 300,
                "name" => "300"
            ],
            [
                "id" => 400,
                "name" => "400"
            ],
            [
                "id" => 800,
                "name" => "800"
            ],
            [
                "id" => 1000,
                "name" => "1000"
            ],
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }
}
