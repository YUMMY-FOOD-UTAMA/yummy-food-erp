<?php

namespace App\View\Components\DataDriven\Select2;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class Employee extends Component
{
    public $employeeID;
    public string $type;
    public $uuid;
    public $dropDownParentID;
    public $sizeForm;
    public $withTrashed;
    public $onlyTrashed;
    public $onlySales;
    public $required;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($label = 'Employee', $required = false, $onlySales = false, $onlyTrashed = false, $withTrashed = false, string $employeeID = null, $uuid = null, string $type = 'inline', string $dropDownParentID = '', $sizeForm = 'lg')
    {
        $this->label = $label;
        $this->employeeID = $employeeID;
        $this->type = $type;
        $this->withTrashed = $withTrashed;
        $this->onlyTrashed = $onlyTrashed;
        $this->dropDownParentID = $dropDownParentID;
        $this->onlySales = $onlySales;
        $this->uuid = "a" . Uuid::uuid4()->toString();
        if ($uuid) {
            $this->uuid = $uuid;
        }
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
        $employee = \App\Models\Employee::where('id', $this->employeeID)->first();
        return view('components.data-driven.select2.employee', compact('employee'));
    }
}
