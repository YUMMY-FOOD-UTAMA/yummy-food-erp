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

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id')->withTrashed();
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id')->withTrashed();
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id')->withTrashed();
    }
}
