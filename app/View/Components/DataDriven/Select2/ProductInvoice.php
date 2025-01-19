<?php

namespace App\View\Components\DataDriven\Select2;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class ProductInvoice extends Component
{
    public $productInvoiceID;
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
    public function __construct($label = 'Product Invoice Number', $required = false, $onlyTrashed = false, $withTrashed = false, string $productInvoiceID = null, $uuid = null, string $type = 'inline', string $dropDownParentID = '', $sizeForm = 'lg')
    {
        $this->label = $label;
        $this->productInvoiceID = $productInvoiceID;
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
        $productInvoice = \App\Models\Invoice\ProductInvoice::where('id', $this->productInvoiceID)->first();
        return view('components.data-driven.select2.product-invoice', [
            'productInvoice' => $productInvoice,
        ]);
    }
}
