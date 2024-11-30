<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagementSettingUpSertRequest;
use App\Models\GeneralSetting;
use App\Repositories\GeneralSettingRepository;

class ManagementSettingController extends Controller
{
    public function index()
    {
        return view('management_setting.index',[
            'settings' => GeneralSettingRepository::getAll()
        ]);
    }

    public function upsert(ManagementSettingUpSertRequest $request)
    {
        GeneralSetting::updateOrCreate(
            ['key' => "maximum_range_visit"],
            ['value' => $request->maximum_range_visit],
        );
        GeneralSetting::updateOrCreate(
            ['key' => "minimum_visit_per_day"],
            ['value' => $request->minimum_visit_per_day],
        );
        GeneralSetting::updateOrCreate(
            ['key' => "maximum_visit_per_day"],
            ['value' => $request->maximum_visit_per_day],
        );
        GeneralSetting::updateOrCreate(
            ['key' => "minimum_location_accuracy"],
            ['value' => $request->minimum_location_accuracy],
        );

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Update Management Setting Successfully'
        ]);
    }
}
