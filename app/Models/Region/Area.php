<?php

namespace App\Models\Region;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, AuditTrait,SoftDeletes;

    protected $table = 'areas';

    protected $guarded = ['id'];

    public function subRegion()
    {
        return $this->belongsTo(SubRegion::class, 'sub_region_id', 'id');
    }
}
