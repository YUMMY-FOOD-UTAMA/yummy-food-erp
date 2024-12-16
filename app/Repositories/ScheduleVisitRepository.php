<?php

namespace App\Repositories;

use App\Models\SalesScheduleVisit;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleVisitRepository
{
    private Request $request;
    private array $statuses = [];
    private array $employeeIDs = [];

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setStatuses(array $statuses): void
    {
        $this->statuses = $statuses;
    }

    public function setEmployeeIDs(array $employeeIDs): void
    {
        $this->employeeIDs = $employeeIDs;
    }

    public function getAll()
    {
        $startDate = $this->request->query("start_date");
        $endDate = $this->request->query("end_date");
        $customerID = $this->request->query("customer_id");
        $employeeID = $this->request->query("employee_id");
        $visitStatus = $this->request->query("visit_status");
        $customerStatus = $this->request->query("customer_status");
        $pageSize = $this->request->query("page_size");
        $search = $this->request->query("search");

        $scheduleVisit = SalesScheduleVisit::with([
            'customer' => function ($query) {
                $query->with([
                    'area.region',
                    'customerCategory',
                    'customerSegment',
                ]);
            },
            'employee.user',
            'employee.subDepartment.department.division',
            'employee.levelGrade.levelName',
        ]);
        if ($startDate && $endDate) {
            $scheduleVisit = $scheduleVisit->where('start_visit', '>=', $startDate)
                ->where('end_visit', '<=', $endDate);
        }
        if ($customerID) {
            $scheduleVisit = $scheduleVisit->where('customer_id', $customerID);
        }
        if ($employeeID) {
            $scheduleVisit = $scheduleVisit->where('employee_id', $employeeID);
        }
        if ($visitStatus) {
            $scheduleVisit = $scheduleVisit->where('status', $visitStatus);
        }
        if ($search) {
            $scheduleVisit = $scheduleVisit->where(function ($query) use ($search) {
                $query->whereHas('customer', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('contact_person_phone', 'like', '%' . $search . '%')
                        ->orWhere('contact_person_name', 'like', '%' . $search . '%')
                        ->orWhere('contact_person_title', 'like', '%' . $search . '%');
                });
            });
        }
        if ($this->statuses) {
            $scheduleVisit = $scheduleVisit->whereIn('status', $this->statuses);
        }
        if ($this->employeeIDs) {
            $scheduleVisit = $scheduleVisit->whereIn('employee_id', $this->employeeIDs);
        }
        if ($customerStatus) {
            $scheduleVisit = $scheduleVisit->whereHas('customer', function ($query) use ($customerStatus) {
                $query->where('status', $customerStatus);
            });
        }
        $scheduleVisit = $scheduleVisit->orderByDesc("created_at")->paginate($pageSize)->appends(request()->query())
            ->through(function ($visit) {
                $customer = $visit->customer;

                $areaCode = $customer?->area?->code() ?? '';
                $regionCode = $customer?->area?->region?->code() ?? '';
                $segmentCode = $customer?->customerSegment?->code() ?? '';
                $categoryCode = $customer?->customerCategory?->code() ?? '';

                $customerCode = $regionCode . $areaCode . $segmentCode . $categoryCode . ($customer?->nameCode() ?? '');
                $visit->customer->code = $customerCode;

                return $visit;
            });

        return $scheduleVisit;
    }

    public function calculateStatistic()
    {
        $startDate = $this->request->query("start_date");
        $endDate = $this->request->query("end_date");
        $customerID = $this->request->query("customer_id");
        $employeeID = $this->request->query("employee_id");

        $salesMappingStatisticVisited = null;
        $salesMappingStatisticScheduledNotVisited = null;
        $salesTrackRecord = null;

        if ($startDate && $endDate) {
            $salesMappingStatisticVisited = SalesScheduleVisit::selectRaw('DATE(start_visit) as visit_date, COUNT(*) as total')
                ->where('status', SalesScheduleVisitStatus::VISITED)
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween('start_visit', [$startDate, $endDate]);
                })
                ->groupBy('visit_date')
                ->orderBy('visit_date');
            $salesMappingStatisticScheduledNotVisited = SalesScheduleVisit::selectRaw('DATE(start_visit) as visit_date, COUNT(*) as total')
                ->where('status', SalesScheduleVisitStatus::APPROVED)
                ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                    return $query->whereBetween('start_visit', [$startDate, $endDate]);
                })
                ->groupBy('visit_date')
                ->orderBy('visit_date');
            if ($customerID) {
                $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->where('customer_id', $customerID);
                $salesMappingStatisticVisited = $salesMappingStatisticVisited->where('customer_id', $customerID);
            }
            if ($employeeID) {
                $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->where('employee_id', $employeeID);
                $salesMappingStatisticVisited = $salesMappingStatisticVisited->where('employee_id', $employeeID);
            }


            $salesMappingStatisticVisited = $salesMappingStatisticVisited->get();
            $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->get();

            $totalSalesMappingVisited = 0;
            $totalSalesScheduledNotVisited = 0;
            foreach ($salesMappingStatisticVisited as $s) {
                $totalSalesMappingVisited += $s->total;
            }
            foreach ($salesMappingStatisticScheduledNotVisited as $s) {
                $totalSalesScheduledNotVisited += $s->total;
            }

            if (($totalSalesMappingVisited + $totalSalesScheduledNotVisited) == 0) {
                $salesTrackRecord = 0;
            } else {
                $salesTrackRecord = $totalSalesMappingVisited / ($totalSalesMappingVisited + $totalSalesScheduledNotVisited) * 100;
                $salesTrackRecord = intval(ceil($salesTrackRecord));
            }

        }
        return [
            'sales_mapping_statistic_visited' => $salesMappingStatisticVisited,
            'sales_mapping_statistic_scheduled_not_visited' => $salesMappingStatisticScheduledNotVisited,
            'sales_track_record' => $salesTrackRecord,
        ];
    }

    public function calculateStatisticV2()
    {
        $startDate = $this->request->query("start_date", Carbon::now()->format('Y-m-d'));
        $endDate = $this->request->query("end_date", Carbon::now()->format('Y-m-d'));
        $customerID = $this->request->query("customer_id");
        $employeeID = $this->request->query("employee_id");

        $salesMappingStatisticVisited = SalesScheduleVisit::selectRaw('DATE(start_visit) as visit_date, COUNT(*) as total')
            ->where('status', SalesScheduleVisitStatus::VISITED)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('start_visit', [$startDate, $endDate]);
            })
            ->groupBy('visit_date')
            ->orderBy('visit_date');

        $salesMappingStatisticScheduledNotVisited = SalesScheduleVisit::selectRaw('DATE(start_visit) as visit_date, COUNT(*) as total')
            ->where('status', SalesScheduleVisitStatus::APPROVED)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('start_visit', [$startDate, $endDate]);
            })
            ->groupBy('visit_date')
            ->orderBy('visit_date');
        if ($customerID) {
            $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->where('customer_id', $customerID);
            $salesMappingStatisticVisited = $salesMappingStatisticVisited->where('customer_id', $customerID);
        }
        if ($employeeID) {
            $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->where('employee_id', $employeeID);
            $salesMappingStatisticVisited = $salesMappingStatisticVisited->where('employee_id', $employeeID);
        }
        $salesMappingStatisticVisited = $salesMappingStatisticVisited->get();
        $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->get();
        $dates = [];
        $totalSalesMappingVisited = 0;
        $totalSalesScheduledNotVisited = 0;

        foreach ($salesMappingStatisticVisited as $s) {
            if (!in_array($s->visit_date, $dates)) {
                $dates[] = $s->visit_date;
            }
            $totalSalesMappingVisited += $s->total;
        }

        foreach ($salesMappingStatisticScheduledNotVisited as $s) {
            if (!in_array($s->visit_date, $dates)) {
                $dates[] = $s->visit_date;
            }
            $totalSalesScheduledNotVisited += $s->total;
        }

        if (($totalSalesMappingVisited + $totalSalesScheduledNotVisited) == 0) {
            $salesTrackRecord = 0;
        } else {
            $salesTrackRecord = $totalSalesMappingVisited / ($totalSalesMappingVisited + $totalSalesScheduledNotVisited) * 100;
            $salesTrackRecord = intval(ceil($salesTrackRecord));
        }

        $minValue = 0;
        $maxValue = 0;
        $finalDates = [];
        $finalVisitData = [];
        $finalNotVisitData = [];
        $salesMappingStatisticVisited = $salesMappingStatisticVisited->toArray();
        $salesMappingStatisticScheduledNotVisited = $salesMappingStatisticScheduledNotVisited->toArray();
        foreach ($dates as $i => $date) {
            $finalDates[] = Carbon::parse($date)->format('d/m/y');
            $visitIndex = array_search($date, array_column($salesMappingStatisticVisited, 'visit_date'));
            $visitTotal = ($visitIndex !== false) ? $salesMappingStatisticVisited[$visitIndex]['total'] : 0;
            if ($maxValue < $visitTotal) {
                $maxValue = $visitTotal;
            }
            if ($minValue > $visitTotal) {
                $minValue = $visitTotal;
            }
            $finalVisitData[] = $visitTotal;

            $notVisitIndex = array_search($date, array_column($salesMappingStatisticScheduledNotVisited, 'visit_date'));
            $notVisitTotal = ($notVisitIndex !== false) ? $salesMappingStatisticScheduledNotVisited[$notVisitIndex]['total'] : 0;
            $finalNotVisitData[] = $notVisitTotal;
            if ($maxValue < $notVisitTotal) {
                $maxValue = $notVisitTotal;
            }
            if ($minValue > $notVisitTotal) {
                $minValue = $notVisitTotal;
            }
        }

        return [
            'sales_track_record' => $salesTrackRecord,
            'dates' => $finalDates,
            'visitData' => $finalVisitData,
            'notVisitData' => $finalNotVisitData,
            'minValue' => $minValue,
            'maxValue' => $maxValue,
        ];
    }
}
