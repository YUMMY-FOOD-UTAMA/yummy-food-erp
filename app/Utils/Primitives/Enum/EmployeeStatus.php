<?php

namespace App\Utils\Primitives\Enum;

enum EmployeeStatus
{
    const CONTRACT = 'Kontrak';
    const PERMANENT_EMPLOYEE = 'Karyawan Tetap';
    const FREELANCE = 'Freelance';
    const INTERNSHIP = 'Magang';

    public static function values(): array
    {
        return [
            self::CONTRACT,
            self::PERMANENT_EMPLOYEE,
            self::FREELANCE,
            self::INTERNSHIP,
        ];
    }

    public static function valuesObject(): array
    {
        $options = [
            [
                "id" => self::CONTRACT,
                "name" => self::CONTRACT
            ],
            [
                "id" => self::PERMANENT_EMPLOYEE,
                "name" => self::PERMANENT_EMPLOYEE
            ],
            [
                "id" => self::FREELANCE,
                "name" => self::FREELANCE
            ],
            [
                "id" => self::INTERNSHIP,
                "name" => self::INTERNSHIP
            ]
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }
}
