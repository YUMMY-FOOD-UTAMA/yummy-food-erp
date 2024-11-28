<?php

namespace App\Models\Region;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use HasFactory, AuditTrait,SoftDeletes;

    protected $table = 'regions';

    protected $guarded = ['id'];

    public function subRegions()
    {
        return $this->hasMany(SubRegion::class);
    }
}
