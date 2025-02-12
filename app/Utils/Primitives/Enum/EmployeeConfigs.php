<?php

namespace App\Utils\Primitives\Enum;

enum EmployeeConfigs
{
    const FEATURE_CRM = "CRM";
    const CRM_APPROVAL_SALES_MAPPING = "APPROVAL_SALES_MAPPING";
    const CRM_APPROVAL_SCHEDULE_VISIT = "APPROVAL_SCHEDULE_VISIT";

    public static function values(): array
    {
        $options = [
            [
                "id" => self::FEATURE_CRM,
                "name" => "CRM",
                "values" => [
                    [
                        "id" => self::CRM_APPROVAL_SALES_MAPPING,
                        "name" => "Approval Sales Mapping"
                    ],
                    [
                        "id" => self::CRM_APPROVAL_SCHEDULE_VISIT,
                        "name" => "Approval Schedule Visit"
                    ],
                ],
            ]
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }

    public static function getByType($type): array
    {
        if ($type === self::CRM_APPROVAL_SALES_MAPPING) {
            return [
                "id" => self::CRM_APPROVAL_SALES_MAPPING,
                "name" => "Sales Mapping Approval",
                "feature" => self::FEATURE_CRM,
            ];
        }
        if ($type === self::CRM_APPROVAL_SCHEDULE_VISIT) {
            return [
                "id" => self::CRM_APPROVAL_SCHEDULE_VISIT,
                "feature" => self::FEATURE_CRM,
                "name" => "Schedule Visit Approval"
            ];
        }
    }

    public static function tableValues(): array
    {
        $options = [
            [
                "id" => self::CRM_APPROVAL_SALES_MAPPING,
                "name" => "Sales Mapping Approval",
                "feature" => self::FEATURE_CRM,
            ],
            [
                "id" => self::CRM_APPROVAL_SCHEDULE_VISIT,
                "feature" => self::FEATURE_CRM,
                "name" => "Schedule Visit Approval"
            ],
        ];

        return array_map(function ($item) {
            return (object)$item;
        }, $options);
    }
}
