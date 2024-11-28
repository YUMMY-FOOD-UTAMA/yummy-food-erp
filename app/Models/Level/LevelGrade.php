<?php

namespace App\Models\Level;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LevelGrade extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'level_grades';
    protected $fillable = [
        'level_name_id', 'name', 'deleted_at', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function levelName()
    {
        return $this->belongsTo(LevelName::class, 'level_name_id', 'id');
    }
}
