<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Repositories\ScheduleVisitRepository;
use App\Utils\Helpers\PermissionHelper;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Illuminate\Http\Request;

class SalesVisitReportController extends Controller
{
    public function index(Request $request)
    {
        $scheduleVisits = new ScheduleVisitRepository;
        $scheduleVisits->setRequest($request);
        $scheduleVisits->setEmployeeIDs(PermissionHelper::onlySelfAccessEmployeeIDs());
        $scheduleVisits->setStatuses([SalesScheduleVisitStatus::VISITED]);
        $scheduleVisitData = $scheduleVisits->getAll();
        $calculateScheduleVisit = $scheduleVisits->calculateStatistic();
        return view('crm.sales_visit_report.index', [
            'scheduleVisits' => $scheduleVisitData,
            'salesMappingStatisticScheduledNotVisited' => $calculateScheduleVisit['sales_mapping_statistic_scheduled_not_visited'],
            'salesMappingStatisticVisited' => $calculateScheduleVisit['sales_mapping_statistic_visited'],
            'salesTrackRecord' => $calculateScheduleVisit['sales_track_record'],
        ]);
    }
}
