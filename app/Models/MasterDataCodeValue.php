<?php

namespace App\Models;

use App\Models\Division\SubDepartment;
use App\Models\Level\LevelGrade;
use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterDataCodeValue extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'master_data_code_values';

    protected $guarded = ['id'];
}