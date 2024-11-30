<?php

namespace App\View\Components\Form;

use App\Models\Region\Area;
use App\Models\Region\Region;
use App\Models\Region\SubRegion;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class SelectBoxRegion extends Component
{
    public $regionID;
    public $subRegionID;
    public $areaID;
    public string $type;
    public $formMethod;
    public $dropDownParentID;
    public $sizeForm;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $regionID = null, $subRegionID = null, $areaID = null, $formMethod = "GET", $dropDownParentID = null, $sizeForm = 'lg')
    {
        $this->regionID = $regionID;
        $this->subRegionID = $subRegionID;
        $this->areaID = $areaID;
        $this->formMethod = $formMethod;
        if ($dropDownParentID) {
            $this->dropDownParentID = '#' . $dropDownParentID;
        }
        $this->sizeForm = $sizeForm;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $regions = Region::all();
        $subRegions = null;
        $areas = null;
        if ($this->regionID) {
            $subRegions = SubRegion::where('region_id', $this->regionID)->get();
        }
        if ($this->subRegionID) {
            $areas = Area::where('sub_region_id', $this->subRegionID)->get();
        }
        $id = 'a' . str_replace('-', '', Uuid::uuid4()->toString());;
        return view('components.form.select-box-region', compact(
            'regions',
            'subRegions',
            'areas',
            'id'
        ));
    }
}
