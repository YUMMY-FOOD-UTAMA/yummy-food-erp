<?php

namespace App\View\Components\Form;

use App\Models\Customer\Customer;
use App\Models\Employee;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class SelectBoxCustomer extends Component
{
    public $customerID;
    public string $type;
    public $uuid;
    public $dropDownParentID;
    public $sizeForm;
    public $withTrashed;
    public $onlyTrashed;
    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct($required = false, $onlyTrashed = false, $withTrashed = false, string $customerID = null, $uuid = null, string $type = 'inline', string $dropDownParentID = '', $sizeForm = 'lg')
    {
        $this->customerID = $customerID;
        $this->type = $type;
        $this->withTrashed = $withTrashed;
        $this->onlyTrashed = $onlyTrashed;
        $this->dropDownParentID = $dropDownParentID;
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
        $customer = Customer::where('id', $this->customerID)->first();
        return view('components.form.select-box-customer', compact('customer'));
    }
}
