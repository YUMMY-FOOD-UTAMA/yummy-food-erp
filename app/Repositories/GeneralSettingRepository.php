<?php

namespace App\Repositories;

use App\Models\GeneralSetting;

class GeneralSettingRepository
{
    public static function getAll()
    {
        $generalSettings = GeneralSetting::all();
        $generalSettingsArray = [];
        foreach ($generalSettings as $generalSetting) {
            $generalSettingsArray[$generalSetting->key] = $generalSetting->value;
        }

        $generalSettingMapping = (object)array_map(function ($item) {
            return (object)$item;
        }, $generalSettingsArray);
        return $generalSettingMapping;
    }
}
