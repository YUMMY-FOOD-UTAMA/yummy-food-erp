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

    /**
     * Create a new component instance.
     */
    public function __construct($withOutCardBody = false, $dataTable = null, $type = null)
    {
        $this->dataTable = $dataTable;
        $this->type = $type;
        $this->withOutCardBody = $withOutCardBody;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.general-table');
    }
}
