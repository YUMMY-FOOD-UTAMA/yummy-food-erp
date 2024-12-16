<?php

namespace App\Models\Region;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'areas';

    protected $guarded = ['id'];

    public function code()
    {
        $prefix = "A";
        $formattedNumber = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        return $prefix.$formattedNumber;
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
