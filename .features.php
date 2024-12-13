<?php

use Illuminate\Contracts\Foundation\Application;

/**
 * @returns array<string, bool>
 */
return static function (Application $app): array {
    return [
        'register' => false,
        'social-lite.google' => false,
        'social-lite.facebook' => false,
        'mail-verified' => false,
        'deactive-account' => false,
        'change-mail' => true
    ];
};
