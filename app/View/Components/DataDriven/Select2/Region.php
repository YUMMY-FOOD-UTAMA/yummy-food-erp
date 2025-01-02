<?php

namespace App\View\Components\DataDriven\Select2;

use App\Models\Region\Area;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class Region extends Component
{
    public $regionID;
    public $areaID;
    public string $type;
    public $formMethod;
    public $dropDownParentID;
    public $sizeForm;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $regionID = null, $areaID = null, $formMethod = "GET", $dropDownParentID = null, $sizeForm = 'lg')
    {
        $this->regionID = $regionID;
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
        $regions = \App\Models\Region\Region::all();
        $areas = null;
        if ($this->regionID) {
            $areas = Area::where('region_id', $this->regionID)->get();
        }
        $id = 'a' . str_replace('-', '', Uuid::uuid4()->toString());;
        return view('components.data-driven.select2.region', compact(
            'regions',
            'areas',
            'id'
        ));
    }
}
