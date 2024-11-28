<?php

namespace App\Models;

use App\Models\Customer\Customer;
use App\Trait\AuditTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesScheduleVisit extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'sales_schedule_visits';

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id','id')->withTrashed();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class)->withTrashed();
    }

    public function expiredAtTheDay()
    {
        $today = Carbon::now()->startOfDay();
        $end = Carbon::parse($this->end_visit)->startOfDay();

        $diff = $today->diffInDays($end, false);

        if ($diff < 0) {
            return 'expired';
        } elseif ($diff == 0) {
            return 'last day';
        } else {
            return $diff . ' Days';
        }
    }

    public function rangeDate()
    {
        return Carbon::parse($this->start_visit)
                ->setTimezone('Asia/Jakarta')
                ->format('Y-m-d')
            . ' - ' .
            Carbon::parse($this->end_visit)
                ->setTimezone('Asia/Jakarta')
                ->format('Y-m-d');
    }
}
