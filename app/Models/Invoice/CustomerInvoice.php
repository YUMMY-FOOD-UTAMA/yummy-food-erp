<?php

namespace App\Models\Invoice;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerInvoice extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'customer_invoices';

    protected $guarded = ['id'];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
