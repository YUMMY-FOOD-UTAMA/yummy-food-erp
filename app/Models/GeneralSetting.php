<?php

namespace App\Models;

use App\Models\Division\SubDepartment;
use App\Models\Level\LevelGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_settings';

    protected $guarded = ['id'];
}
