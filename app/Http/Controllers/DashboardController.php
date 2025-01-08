<?php

namespace App\Http\Controllers;

use App\Repositories\ScheduleVisitRepository;
use App\Utils\Helpers\PermissionHelper;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $scheduleVisits = new ScheduleVisitRepository;
        $scheduleVisits->setEmployeeIDs(PermissionHelper::onlySelfAccessEmployeeIDs());
        $scheduleVisits->setRequest($request);
        $scheduleVisits->setExcludePastVisits(true);
        $scheduleVisits->setStatuses([SalesScheduleVisitStatus::APPROVED]);
        $scheduleVisits = $scheduleVisits->getAll();

        $scheduleVisitRepository = new ScheduleVisitRepository();
        $scheduleVisitRepository->setRequest($request);
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'scheduleVisitStatistic' => $scheduleVisitRepository->calculateStatisticV2(),
            'scheduleVisits' => $scheduleVisits,
        ]);
    }
}
