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
        return $this->belongsTo(CustomerInvoice::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
