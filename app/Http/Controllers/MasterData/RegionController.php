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

    public function getAreas(Request $request)
    {
        $areas = new Area;
        if ($request->ajax()) {
            if ($request->query("region_id")) {
                $areas = $areas->where('region_id', $request->query("region_id"));
            }
            $areas = $areas->get();
            return $this->successResponse($areas);
        }
    }
}
