<?php

namespace App\Models\Geographic;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class SubDistrict extends Model
{
    use HasFactory, HasRoles, AuditTrait, SoftDeletes;

    protected $table = 'sub_districts';
    protected $guarded = ['id'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id')->withTrashed();
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id')->withTrashed();
    }

    public function subDistrictvillages()
    {
        return $this->hasMany(SubDistrictVillage::class)->withTrashed();
    }
}
