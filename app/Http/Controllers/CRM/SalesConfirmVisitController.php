<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\Models\SalesScheduleVisit;
use App\Repositories\ScheduleVisitRepository;
use App\Utils\Helpers\PermissionHelper;
use App\Utils\Helpers\Transaction;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SalesConfirmVisitController extends Controller
{
    public function index(Request $request)
    {
        $scheduleVisits = new ScheduleVisitRepository;
        $scheduleVisits->setEmployeeIDs(PermissionHelper::onlySelfAccessEmployeeIDs());
        $scheduleVisits->setRequest($request);
        $scheduleVisits->setStatuses([SalesScheduleVisitStatus::APPROVED]);
        $scheduleVisits = $scheduleVisits->getAll();
        return view('crm.sales_confirm_visit.index', compact('scheduleVisits'));
    }

    public function visitConfirmation(SalesScheduleVisit $scheduleVisit, Request $request)
    {
        if ($scheduleVisit->status == SalesScheduleVisitStatus::VISITED) {
            return redirect()->back()->with([
                "status" => "warning",
                "message" => "Status Is Visit, you cannot visit again"
            ]);
        }

        $res = Transaction::doTx(function () use ($scheduleVisit, $request) {
            Customer::where("id", $scheduleVisit->customer_id)->update([
                "contact_person_name" => $request->get('contact_person_name'),
                "contact_person_phone" => $request->get('contact_person_phone'),
                "contact_person_title" => $request->get('contact_person_title'),
                "department" => $request->get('department'),
            ]);
            $scheduleVisit->update([
                "status" => SalesScheduleVisitStatus::VISITED,
                "customer_feedback" => $request->get('customer_feedback'),
                "customer_request_product_new" => $request->get('new_product_request'),
                "visit_location" => $request->get('address'),
            ]);
        });
        if ($res) {
            return Redirect::back()->withInput($request->all())->with($res);
        }

        return redirect()->back()->with([
            "status" => "success",
            "message" => "Visited Successfully"
        ]);
    }
}
