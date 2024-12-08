<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRM\ScheduleVisitStoreRequest;
use App\Models\Customer\Customer;
use App\Models\GeneralSetting;
use App\Models\SalesScheduleVisit;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\ScheduleVisitRepository;
use App\Utils\Helpers\PermissionHelper;
use App\Utils\Helpers\Transaction;
use App\Utils\Primitives\Enum\SalesScheduleVisitStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class ScheduleVisitController extends Controller
{
    public function index(Request $request)
    {
        $scheduleVisits = new ScheduleVisitRepository;
        $scheduleVisits->setRequest($request);
        $scheduleVisits->setEmployeeIDs(PermissionHelper::onlySelfAccessEmployeeIDs());
        $scheduleVisits = $scheduleVisits->getAll();
        return view('crm.schedule_visit.index', compact('scheduleVisits'));
    }

    public function create()
    {
        $generalSettings = GeneralSettingRepository::getAll();
        return view('crm.schedule_visit.create', compact('generalSettings'));
    }

    public function store(ScheduleVisitStoreRequest $request)
    {
        if (!$request->customer_ids) {
            return redirect()->route('receivable.crm.schedule-visit.create')->withInput()->with([
                'status' => 'warning',
                'message' => "You haven't chosen a customer yet"
            ]);
        }
        $customerIDs = explode(',', $request->customer_ids);
        if (count($customerIDs) < 1) {
            return redirect()->route('receivable.crm.schedule-visit.create')->withInput()->with([
                'status' => 'warning',
                'message' => "You haven't chosen a customer yet"
            ]);
        }

        if (Customer::availableForBooked($customerIDs, $request->start_date, $request->end_date)) {
            return redirect()->route('receivable.crm.schedule-visit.create')->withInput()->with([
                'status' => 'warning',
                'message' => 'One of the customers you choose has already made a booking'
            ]);
        }

        $res = Transaction::doTx(function () use ($request, $customerIDs) {
            foreach ($customerIDs as $customerId) {
                SalesScheduleVisit::create([
                    'customer_id' => $customerId,
                    'sales_id' => $request->sales_id,
                    'status' => SalesScheduleVisitStatus::WAITING_APPROVAL,
                    'employee_id' => $request->employee_id,
                    'start_visit' => $request->start_date,
                    'end_visit' => $request->end_date,
                    'category' => $request->visit_category,
                ]);

                Customer::where('id', $customerId)->update([
                    'is_booked_by_sales' => true
                ]);
            }
        });

        if ($res) {
            return Redirect::back()->withInput($request->all())->with($res);
        }

        return redirect()->route('receivable.crm.schedule-visit.create')->with([
            'status' => 'success',
            'message' => 'Booking created successfully'
        ]);
    }

    public function cancel($id)
    {
        SalesScheduleVisit::where('id', $id)
            ->where('status', SalesScheduleVisitStatus::WAITING_APPROVAL)
            ->update([
                'status' => SalesScheduleVisitStatus::CANCELLED
            ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Booking has been cancelled'
        ]);
    }
}
