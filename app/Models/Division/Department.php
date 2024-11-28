<?php

namespace App\Models\Division;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'departments';

    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function subDepartments()
    {
        return $this->hasMany(SubDepartment::class);
    }

}
