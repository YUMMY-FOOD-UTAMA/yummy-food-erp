<?php

namespace App\Utils\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PermissionHelper
{
    public static function onlySelfAccessEmployeeIDs(): array
    {
        if (Auth::user()->hasRole('Super Admin')) {
            return [];
        }

        $currentRouteName = Route::currentRouteName() . ".only-self";
        if (Auth::user()->can($currentRouteName)) {
            return [Auth::user()->employee->id];
        }
        return [];
    }

    public static function onlySelfAccessEmployeeID()
    {
        if (Auth::user()->hasRole('Super Admin')) {
            return null;
        }

        $currentRouteName = Route::currentRouteName() . ".only-self";
        if (Auth::user()->can($currentRouteName)) {
            return Auth::user()->employee->id;
        }
        return null;
    }

    public static function isOnlySelfAccess(): bool
    {
        if (Auth::user()->hasRole('Super Admin')) {
            return false;
        }

        $user = Auth::user();

        $currentRouteName = Route::currentRouteName() . ".only-self";
        if (Auth::user()->can($currentRouteName)) {
            return true;
        }

        return false;
    }
}
