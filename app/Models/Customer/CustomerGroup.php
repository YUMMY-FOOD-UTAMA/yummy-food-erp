<?php

namespace App\Models\Customer;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerGroup extends Model
{
    use HasFactory, AuditTrait,SoftDeletes;

    protected $table = 'customer_groups';

    protected $guarded = ['id'];

}
