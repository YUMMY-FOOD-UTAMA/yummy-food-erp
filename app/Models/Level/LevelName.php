<?php

namespace App\Models\Level;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelName extends Model
{
    use HasFactory, AuditTrait,SoftDeletes;

    protected $table = 'level_names';
    protected $fillable = [
        'name', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by',
    ];

    public function levelGrades()
    {
        return $this->hasMany(LevelGrade::class);
    }
}
