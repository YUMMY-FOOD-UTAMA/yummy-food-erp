<?php

namespace App\Console\Commands;

use App\Models\Customer\Customer;
use App\Models\SalesScheduleVisit;
use App\Primitive\SalesScheduleVisitStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SetExpiredStatusSalesCRM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-expired-status-sales-c-r-m';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set expired status sales CRM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Cron Job running at " . now());

        $now = Carbon::now('Asia/Jakarta')->startOfDay();

        try {
            SalesScheduleVisit::where('end_visit', '<', $now)
                ->where('status', \App\Utils\Primitives\Enum\SalesScheduleVisitStatus::APPROVED)
                ->update(['status' => \App\Utils\Primitives\Enum\SalesScheduleVisitStatus::EXPIRED]);

        } catch (\Exception $error) {
            info("error from cron job set-expired-status-sales-c-r-m:" . $error);
        }
    }
}
