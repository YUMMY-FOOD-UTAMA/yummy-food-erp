<?php

namespace App\Utils\Helpers;

use Illuminate\Support\Facades\DB;
use Throwable;

class Transaction
{
    public static function doTx(\Closure $callback)
    {

        try {
            DB::transaction($callback);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return [
                'message' => $e->getMessage(),
                'status' => 'error'
            ];
        }

        return null;
    }
}
