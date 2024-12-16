<?php

namespace App\Http\Controllers;

use App\Repositories\ScheduleVisitRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $scheduleVisitRepository = new ScheduleVisitRepository();
        $scheduleVisitRepository->setRequest($request);
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'scheduleVisit' => $scheduleVisitRepository->calculateStatisticV2(),
        ]);
    }
}
