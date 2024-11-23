<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Geographic\District;
use App\Models\Geographic\Province;
use App\Models\Geographic\SubDistrict;
use App\Models\Geographic\SubDistrictVillage;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\Request;

class GeographicController extends Controller
{
    use ApiResponseTrait;

    public function getProvince(Request $request)
    {
        $provinces = new Province;
        if ($request->query('province_id')) {
            $provinces = Province::where('id', $request->query('province_id'))->first();
        }
        $provinces = $provinces->get();
        if ($request->ajax()) {
            return $this->successResponse($provinces);
        }
    }

    public function getDistrict(Request $request)
    {
        $districts = District::where('province_id', $request->query('province_id'))->get();
        if ($request->ajax()) {
            return $this->successResponse($districts);
        }
    }

    public function getSubDistrict(Request $request)
    {
        $subDistrict = SubDistrict::where('district_id', $request->query('district_id'))->get();
        if ($request->ajax()) {
            return $this->successResponse($subDistrict);
        }
    }

    public function getVillage(Request $request)
    {
        $village = SubDistrictVillage::where('sub_district_id', $request->query('sub_district_id'))->get();
        if ($request->ajax()) {
            return $this->successResponse($village);
        }
    }
}
