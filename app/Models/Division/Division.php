<?php

namespace App\Models\Division;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'divisions';

    protected $guarded = ['id'];

    public function department()
    {
        return $this->hasMany(Department::class);
    }
}
