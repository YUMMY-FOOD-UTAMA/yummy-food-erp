<?php

namespace App\Utils\Primitives;


class Timezone
{
    public static function getTimezones()
    {
        $timezones = [];
        $regions = [
            \DateTimeZone::AFRICA,
            \DateTimeZone::AMERICA,
            \DateTimeZone::ANTARCTICA,
            \DateTimeZone::ASIA,
            \DateTimeZone::ATLANTIC,
            \DateTimeZone::AUSTRALIA,
            \DateTimeZone::EUROPE,
            \DateTimeZone::INDIAN,
            \DateTimeZone::PACIFIC,
            \DateTimeZone::UTC,
        ];

        foreach ($regions as $region) {
            foreach (\DateTimeZone::listIdentifiers($region) as $timezone) {
                $dateTime = new \DateTime('now', new \DateTimeZone($timezone));
                $name = $timezone . ' (UTC' . $dateTime->format('P') . ')';
                $timezones[] = [
                    'name' => $name,
                    'id' => $timezone,
                ];
            }
        }

        return array_map(function ($item) {
            return (object)$item;
        }, $timezones);
    }
}
