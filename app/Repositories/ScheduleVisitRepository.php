<?php

namespace App\Repositories;

use App\Models\SalesScheduleVisit;
use Illuminate\Http\Request;

class ScheduleVisitRepository
{
    private Request $request;

    public function setRequest(Request $request): void
    {
        $this->request = $request;
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
        if ($customerStatus) {
            $scheduleVisit = $scheduleVisit->whereHas('customer', function ($query) use ($customerStatus) {
                $query->where('status', $customerStatus);
            });
        }
        $scheduleVisit = $scheduleVisit->orderByDesc("created_at")->paginate($pageSize)->appends(request()->query());;

        return $scheduleVisit;
    }
}
