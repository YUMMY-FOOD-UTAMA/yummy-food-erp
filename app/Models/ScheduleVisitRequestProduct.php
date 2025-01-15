<?php

namespace App\Models;

use App\Trait\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleVisitRequestProduct extends Model
{
    use HasFactory;

    protected $table = 'schedule_visit_request_products';

    protected $guarded = ['id'];

    public function scheduleVisit()
    {
        return $this->belongsTo(SalesScheduleVisit::class, 'schedule_visit_id');
    }
}
