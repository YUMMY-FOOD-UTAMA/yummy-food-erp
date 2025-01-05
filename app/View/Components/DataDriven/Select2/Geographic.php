<?php

namespace App\View\Components\DataDriven\Select2;

use App\Models\Geographic\District;
use App\Models\Geographic\Province;
use App\Models\Geographic\SubDistrict;
use App\Models\Geographic\SubDistrictVillage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class Geographic extends Component
{
    public $province_id;
    public $district_id;
    public $sub_district_id;
    public $sub_district_village_id;
    public string $type;
    public $formMethod;
    public $dropDownParentID;
    public $sizeForm;
    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct($required = false, $sizeForm = 'lg', $provinceID = null, $districtID = null, $subDistrictID = null, $subDistrictVillageID = null, $type = "inline", $formMethod = null, $dropDownParentID = "")
    {
        $this->province_id = $provinceID;
        $this->district_id = $districtID;
        $this->sub_district_id = $subDistrictID;
        $this->sub_district_village_id = $subDistrictVillageID;
        $this->type = $type;
        $this->formMethod = $formMethod;
        $this->dropDownParentID = $dropDownParentID;
        if ($this->dropDownParentID != '') {
            $this->dropDownParentID = "#" . $this->dropDownParentID;
        }
        $this->sizeForm = $sizeForm;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $province = Province::all();
        $district = null;
        $subDistrict = null;
        $subDistrictVillage = null;
        if ($this->district_id) {
            $district = District::where('province_id', $this->province_id)->get();
        }
        if ($this->sub_district_id) {
            $subDistrict = SubDistrict::where('district_id', $this->district_id)->get();
        }
        if ($this->sub_district_village_id) {
            $subDistrictVillage = SubDistrictVillage::where('sub_district_id', $this->sub_district_id)->get();
        }
        $id = 'a' . str_replace('-', '', Uuid::uuid4()->toString());;
        return view('components.data-driven.select2.geographic', compact(
            'province',
            'district',
            'subDistrict',
            'subDistrictVillage',
            'id',
        ));
    }
}
