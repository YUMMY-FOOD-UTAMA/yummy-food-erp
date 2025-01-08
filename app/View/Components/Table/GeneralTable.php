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

    /**
     * Create a new component instance.
     */
    public function __construct($scrollable = false, $withOutCardBody = false, $dataTable = null, $type = null)
    {
        $this->dataTable = $dataTable;
        $this->type = $type;
        $this->withOutCardBody = $withOutCardBody;
        $this->scrollable = $scrollable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.general-table');
    }
}
