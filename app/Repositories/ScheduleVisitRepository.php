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
            'customer',
            'employee.user',
            'employee.subDepartment.department.division',
            'employee.levelGrade.levelName',
            'customer.area.subRegion.region',
            'customer.customerCategory',
            'customer.customerSegment',
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
        $scheduleVisit = $scheduleVisit->orderByDesc("created_at")->paginate($pageSize)->appends(request()->query());;

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

            $salesTrackRecord = $totalSalesMappingVisited / ($totalSalesMappingVisited + $totalSalesScheduledNotVisited) * 100;
            $salesTrackRecord = intval(ceil($salesTrackRecord));

        }
        return [
            'sales_mapping_statistic_visited' => $salesMappingStatisticVisited,
            'sales_mapping_statistic_scheduled_not_visited' => $salesMappingStatisticScheduledNotVisited,
            'sales_track_record' => $salesTrackRecord,
        ];
    }
}
