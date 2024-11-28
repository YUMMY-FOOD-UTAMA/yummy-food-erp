<?php

namespace App\Models;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'companies';

    protected $guarded = ['id'];
}
