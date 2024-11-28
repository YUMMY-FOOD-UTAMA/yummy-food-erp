<?php

namespace App\Utils\Primitives\Enum;

enum SalesScheduleVisitStatus
{
    const WAITING_APPROVAL = 'Waiting Approval';
    const APPROVED = 'Approved';
    const EXPIRED = 'Expired';
    const CANCELLED = 'Cancelled';
    const REJECTED = 'Rejected';
    const VISITED = 'Visited';

    public static function values(): array
    {
        return [
            self::WAITING_APPROVAL,
            self::APPROVED,
            self::EXPIRED,
            self::CANCELLED,
            self::REJECTED,
            self::VISITED,
        ];
    }

    public static function valuesObject(): array
    {
        $options = [
            [
                "id" => self::WAITING_APPROVAL,
                "name" => self::WAITING_APPROVAL
            ],
            [
                "id" => self::APPROVED,
                "name" => self::APPROVED
            ],
            [
                "id" => self::EXPIRED,
                "name" => self::EXPIRED
            ],
            [
                "id" => self::CANCELLED,
                "name" => self::CANCELLED
            ],
            [
                "id" => self::REJECTED,
                "name" => self::REJECTED
            ],
            [
                "id" => self::VISITED,
                "name" => self::VISITED
            ],
        ];

        $isConfirmVisit = strpos($_SERVER['REQUEST_URI'], 'confirm-visit') !== false;
        return array_map(function ($item) use ($isConfirmVisit) {
            if ($isConfirmVisit && $item['id'] === self::APPROVED) {
                $item['name'] = 'pending';
            }
            return (object)$item;
        }, $options);
    }

    public static function statusAvailableForBooking(): array
    {
        return [
            self::CANCELLED,
            self::REJECTED,
            self::EXPIRED,
            self::VISITED,
        ];
    }

    public static function getStatusColor(string $status): string
    {
        $isConfirmVisit = strpos($_SERVER['REQUEST_URI'], 'confirm-visit') !== false;
        if ($status === self::APPROVED && $isConfirmVisit) {
            return 'orange';
        }

        // Default switch case
        switch ($status) {
            case self::VISITED:
            case self::APPROVED:
                return 'green';
            case self::CANCELLED:
            case self::EXPIRED:
            case self::REJECTED:
                return 'red';
            case self::WAITING_APPROVAL:
                return 'orange';
            default:
                return 'black';
        }
    }
}
