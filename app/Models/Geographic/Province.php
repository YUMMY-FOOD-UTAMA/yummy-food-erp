<?php

namespace App\Models\Geographic;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Province extends Model
{
    use HasFactory, HasRoles, AuditTrait, SoftDeletes;

    protected $table = 'provinces';
    protected $guarded = ['id'];

    public function districts()
    {
        return $this->hasMany(District::class)->withTrashed();
    }

    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class)->withTrashed();
    }

    public function subDistrictvillages()
    {
        return $this->hasMany(SubDistrictVillage::class)->withTrashed();
    }
}
