<?php

namespace App\Models\Division;

use App\Models\Employee;
use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubDepartment extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'sub_departments';

    protected $guarded = ['id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
