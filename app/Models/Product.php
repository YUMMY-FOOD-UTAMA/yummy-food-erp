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

    public function type()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'type_id', 'id')->withTrashed();
    }

    public function packingSize()
    {
        return $this->belongsTo(MasterDataCodeValue::class, 'packing_size_id', 'id')->withTrashed();
    }

}
