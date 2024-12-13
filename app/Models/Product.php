<?php

namespace App\Models;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id'];

    public function brand()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'brand_id', 'id')->withTrashed();
    }

    public function division()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'division_id', 'id')->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'category_id', 'id')->withTrashed();
    }

    public function group()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'group_id', 'id')->withTrashed();
    }

    public function type()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'type_id', 'id')->withTrashed();
    }

    public function manufacture()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'manufacture_id', 'id')->withTrashed();
    }

    public function smallUnit()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'small_unit_id', 'id')->withTrashed();
    }

    public function bigUnit()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'big_unit_id', 'id')->withTrashed();
    }
}
