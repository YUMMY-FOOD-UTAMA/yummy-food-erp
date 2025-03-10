<?php

namespace App\View\Components\Table;

use App\Utils\Primitives\ListPageSize;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicFilterAndExport extends Component
{
    public string $name;
    public $exportRoute;
    public $withFilters;
    public $exportModalID;

    /**
     * Create a new component instance.
     */
    public function __construct($exportModalID = null, $exportRoute = null, $withFilters = false, $name = null)
    {
        $this->exportRoute = $exportRoute;
        $this->name = $name;
        $this->withFilters = $withFilters;
        $this->exportModalID = $exportModalID;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $pageSizes = ListPageSize::pageSizes();
        return view('components.table.basic-filter-and-export', compact('pageSizes'));
    }
}
