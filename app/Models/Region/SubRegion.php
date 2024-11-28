<?php

namespace App\Models\Region;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubRegion extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'sub_regions';

    protected $guarded = ['id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function areas()
    {
        return $this->hasMany(Area::class);
    }
}
