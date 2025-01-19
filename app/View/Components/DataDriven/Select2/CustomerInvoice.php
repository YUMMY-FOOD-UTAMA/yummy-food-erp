<?php

namespace App\View\Components\DataDriven\Select2;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class CustomerInvoice extends Component
{
    public $customerInvoiceID;
    public string $type;
    public $uuid;
    public $dropDownParentID;
    public $sizeForm;
    public $withTrashed;
    public $onlyTrashed;
    public $required;
    public $label;

    /**
     * Create a new component instance.
     */
    public function __construct($label = 'Customer Name', $required = false, $onlyTrashed = false, $withTrashed = false, string $customerInvoiceID = null, $uuid = null, string $type = 'inline', string $dropDownParentID = '', $sizeForm = 'lg')
    {
        $this->label = $label;
        $this->customerInvoiceID = $customerInvoiceID;
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
        $customerInvoice = \App\Models\Invoice\CustomerInvoice::where('id', $this->customerInvoiceID)->first();
        return view('components.data-driven.select2.customer-invoice', [
            'customerInvoice' => $customerInvoice,
        ]);
    }
}
