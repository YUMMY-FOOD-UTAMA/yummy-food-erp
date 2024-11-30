<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\SalesScheduleVisit;
use App\Repositories\ScheduleVisitRepository;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Illuminate\Http\Request;

class SalesApprovalController extends Controller
{
    public function index(Request $request)
    {
        $scheduleVisits = new ScheduleVisitRepository;
        $scheduleVisits->setRequest($request);
        $scheduleVisits = $scheduleVisits->getAll();
        return view('crm.sales_approval.index', compact('scheduleVisits'));
    }

    public function approval(Request $request)
    {
        $decision = $request->get('decision');
        $scheduleVisitIDs = $request->get('schedule_visit_ids');
        if (empty($scheduleVisitIDs)) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'invalid sales schedule visit'
            ]);
        }

        $validStatuses = [
            SalesScheduleVisitStatus::APPROVED,
            SalesScheduleVisitStatus::REJECTED
        ];

        if (!in_array($decision, $validStatuses)) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Invalid decision'
            ]);
        }

        SalesScheduleVisit::whereIn('id', explode(',', $scheduleVisitIDs))
            ->where('status', SalesScheduleVisitStatus::WAITING_APPROVAL)
            ->update([
                'status' => $decision
            ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'sales mappings updated successfully'
        ]);
    }
}

