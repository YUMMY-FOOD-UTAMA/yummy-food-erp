<?php

namespace App\Models\Geographic;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class District extends Model
{
    use HasFactory, HasRoles, AuditTrait, SoftDeletes;

    protected $table = 'districts';
    protected $guarded = ['id'];

    public function province()
    {
        return $this->belongsTo(Province::class)->withTrashed();
    }

    public function format()
    {
        return $this->type . " " . $this->name;
    }

    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class)->withTrashed();
    }

    public function subDistrictVillages()
    {
        return $this->hasMany(SubDistrictVillage::class)->withTrashed();
    }
}
