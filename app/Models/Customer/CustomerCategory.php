<?php

namespace App\Models\Customer;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCategory extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'customer_categories';

    protected $guarded = ['id'];

    public function code()
    {
        $prefix = "CC";
        $formattedNumber = str_pad($this->id, 2, '0', STR_PAD_LEFT);
        return $prefix.$formattedNumber;
    }
}
