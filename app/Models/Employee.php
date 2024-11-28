<?php

namespace App\Models;

use App\Models\Division\SubDepartment;
use App\Models\Level\LevelGrade;
use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'employees';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subDepartment()
    {
        return $this->belongsTo(SubDepartment::class);
    }

    public function levelGrade()
    {
        return $this->belongsTo(LevelGrade::class);
    }
}
