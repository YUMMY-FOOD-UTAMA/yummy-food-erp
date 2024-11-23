<?php

use Illuminate\Contracts\Foundation\Application;

/**
 * @returns array<string, bool>
 */
return static function (Application $app): array {
    return [
        'register' => true,
        'social-lite.google' => true,
        'social-lite.facebook' => true,
        'mail-verified' => true,
        'deactive-account' => false,
        'change-mail' => true
    ];
};
