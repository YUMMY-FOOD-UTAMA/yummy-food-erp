<?php

namespace App\Models\Customer;

use App\Models\Geographic\District;
use App\Models\Geographic\Province;
use App\Models\Geographic\SubDistrict;
use App\Models\Geographic\SubDistrictVillage;
use App\Models\Region\Area;
use App\Models\Region\Region;
use App\Models\SalesScheduleVisit;
use App\Trait\AuditTrait;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory, AuditTrait, SoftDeletes;

    protected $table = 'customers';

    protected $guarded = ['id'];

    public function nameCode()
    {
        $prefix = "";
        $formattedNumber = str_pad($this->name_code, 3, '0', STR_PAD_LEFT);
        return $prefix . $formattedNumber;
    }

    public static function codeFormater($regionCode, $areaCode, $segmentCode, $categoryCode, $nameCode)
    {
        return $regionCode . $areaCode . $segmentCode . $categoryCode . $nameCode;
    }

    public static function generateNameCode($areaID, $customerSegmentID, $customerCategoryID)
    {
        $count = self::where('area_id', $areaID)
            ->where('customer_segment_id', $customerSegmentID)
            ->where('customer_category_id', $customerCategoryID)
            ->withTrashed()
            ->count();
        $code = $count + 1;
        do {
            $isCodeExists = self::where('area_id', $areaID)
                ->where('customer_segment_id', $customerSegmentID)
                ->where('customer_category_id', $customerCategoryID)
                ->where("name_code", $code)->withTrashed()->exists();
            if ($isCodeExists) {
                $code++;
            }
        } while ($isCodeExists);
        return $code;
    }

    public function customerCategory()
    {
        return $this->belongsTo(CustomerCategory::class);
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function customerSegment()
    {
        return $this->belongsTo(CustomerSegment::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public static function availableForBooked($customerIDs, $startVisit, $endVisit): bool
    {
        return SalesScheduleVisit::whereIn('customer_id', $customerIDs)
            ->whereNotIn('status', SalesScheduleVisitStatus::statusAvailableForBooking())
            ->where(function ($query) use ($startVisit, $endVisit) {
                $query->where(function ($q) use ($startVisit, $endVisit) {
                    $q->where('start_visit', '<=', $endVisit)
                        ->where('end_visit', '>=', $startVisit);
                });
            })
            ->lockForUpdate()
            ->exists();
    }

    public function bookedBys()
    {
        return $this->hasMany(SalesScheduleVisit::class, 'customer_id', 'id')
            ->whereNotIn('status', [
                SalesScheduleVisitStatus::VISITED,
                SalesScheduleVisitStatus::CANCELLED,
                SalesScheduleVisitStatus::EXPIRED,
                SalesScheduleVisitStatus::REJECTED,
            ]);
    }

    public function statusCustomerSales(): string
    {
        return $this->is_booked_by_sales ? 'booked' : 'available';
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withTrashed();
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withTrashed();
    }

    public function subDistrict()
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_id', 'id')->withTrashed();
    }

    public function subDistrictVillage()
    {
        return $this->belongsTo(SubDistrictVillage::class)->withTrashed();
    }
}
