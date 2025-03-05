<?php

namespace App\Models\Invoice;

use App\Models\Product;
use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'invoices';

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(CustomerInvoice::class, 'customer_invoice_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(ProductInvoice::class);
    }

    public function calculate($ppn)
    {
        $subTotal = $this->product_total_amount;
        $discountTotal = $this->product_total_discount;
        $dpp = $subTotal - $discountTotal;

        if ($ppn == 0) {
            $dppEtcValue = 0;
            $ppn12 = 0;
        } else {
            $dppEtcValue = round($dpp * 11 / $ppn, 2);
            $ppn12 = round($dppEtcValue * $ppn / 100, 2);
        }

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
