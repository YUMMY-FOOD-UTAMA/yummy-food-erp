<?php

namespace App\Utils;

class Util
{
    public static function rupiah($amount)
    {
        return 'Rp. ' . number_format($amount, 2, ',', '.');
    }
}
