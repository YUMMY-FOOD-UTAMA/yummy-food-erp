<?php

namespace App\Models\Region;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class Region extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'regions';

    protected $guarded = ['id'];

    public function code()
    {
        $prefix = "R";
        $formattedNumber = str_pad($this->id, 2, '0', STR_PAD_LEFT);
        return $prefix.$formattedNumber;
    }

    public function subRegions()
    {
        return $this->hasMany(SubRegion::class);
    }
}
