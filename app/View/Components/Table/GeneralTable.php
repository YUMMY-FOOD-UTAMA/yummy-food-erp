<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GeneralTable extends Component
{
    public $dataTable;
    public $type;
    public $withOutCardBody;
    public $scrollable;
    public $nameSlotTh;
    public $nameSlotTr;

    /**
     * Create a new component instance.
     */
    public function __construct($nameSlotTh = "slotTheadTh", $nameSlotTr = "slotTbodyTr", $scrollable = false, $withOutCardBody = false, $dataTable = null, $type = null)
    {
        $this->dataTable = $dataTable;
        $this->type = $type;
        $this->withOutCardBody = $withOutCardBody;
        $this->scrollable = $scrollable;
        $this->nameSlotTh = $nameSlotTh;
        $this->nameSlotTr = $nameSlotTr;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.general-table');
    }
}
