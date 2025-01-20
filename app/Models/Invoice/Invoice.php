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

    public function calculate()
    {
        $subTotal = $this->product_total_amount;
        $discountTotal = $this->product_total_discount;
        $dppEtcValue = round($subTotal - $discountTotal * 11 / 12, 2);
        $ppn12 = round($dppEtcValue * 12 / 100, 2);
        $grandTotal = round($subTotal + $ppn12, 2);
        $dpp = $subTotal - $discountTotal;
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
