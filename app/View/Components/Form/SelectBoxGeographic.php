<?php

namespace App\View\Components\Form;

use App\Models\Geographic\District;
use App\Models\Geographic\Province;
use App\Models\Geographic\SubDistrict;
use App\Models\Geographic\SubDistrictVillage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class SelectBoxGeographic extends Component
{
    public $province_id;
    public $district_id;
    public $sub_district_id;
    public $sub_district_village_id;
    public string $type;
    public $formMethod;
    public $dropDownParentID;
    public $sizeForm;

    /**
     * Create a new component instance.
     */
    public function __construct($sizeForm = 'lg', $provinceID = null, $districtID = null, $subDistrictID = null, $subDistrictVillageID = null, $type = "inline", $formMethod = null, $dropDownParentID = "")
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
        $id = str_replace('-', '', Uuid::uuid4()->toString());;
        return view('components.form.select-box-geographic', compact(
            'province',
            'district',
            'subDistrict',
            'subDistrictVillage',
            'id',
        ));
    }
}
