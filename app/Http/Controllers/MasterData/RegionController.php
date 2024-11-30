<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Region\Area;
use App\Models\Region\Region;
use App\Models\Region\SubRegion;
use App\Trait\ApiResponseTrait;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    use ApiResponseTrait;

    public function getSubRegions(Request $request)
    {
        $subRegions = new SubRegion;
        if ($request->ajax()) {
            if ($request->query("region_id")) {
                $subRegions = $subRegions->where('region_id', $request->query("region_id"));
            }
            $subRegions = $subRegions->get();
            return $this->successResponse($subRegions);
        }
    }

    public function getAreas(Request $request)
    {
        $areas = new Area;
        if ($request->ajax()) {
            if ($request->query("sub_region_id")) {
                $areas = $areas->where('sub_region_id', $request->query("sub_region_id"));
            }
            $areas = $areas->get();
            return $this->successResponse($areas);
        }
    }
}
