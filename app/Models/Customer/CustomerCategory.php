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

    protected $fillable = [
        'name', 'code',
    ];
}
