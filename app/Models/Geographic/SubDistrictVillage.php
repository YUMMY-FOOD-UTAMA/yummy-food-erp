<?php

namespace App\Models\Geographic;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class SubDistrictVillage extends Model
{
    use HasFactory, HasRoles, AuditTrait, SoftDeletes;

    protected $table = 'sub_district_villages';
    protected $guarded = ['id'];


    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id')->withTrashed();
    }
}
