<?php

namespace App\Models\Invoice;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInvoice extends Model
{
    use HasFactory;

    protected $table = 'product_invoices';

    protected $guarded = ['id'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function calculate()
    {
        $subTotal = $this->rate * $this->quantity;
        $discountTotal = $subTotal - ($this->net_rate * $this->quantity);
        $dpp = $subTotal - $discountTotal;
        $dppEtcValue = round($dpp * 11 / 12, 2);
        $ppn12 = round($dppEtcValue * 12 / 100, 2);
        $grandTotal = round($dpp + $ppn12, 2);
        return [
            'sub_total' => round($subTotal, 2),
            'dpp_etc_value' => $dppEtcValue,
            'ppn12' => $ppn12,
            'dpp' => $dpp,
            'grand_total' => $grandTotal,
            'discount_total' => round($discountTotal, 2),
        ];
    }
}
