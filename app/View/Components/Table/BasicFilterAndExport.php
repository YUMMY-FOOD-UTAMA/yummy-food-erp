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

    /**
     * Create a new component instance.
     */
    public function __construct($exportRoute = null, $name = null)
    {
        $this->exportRoute = $exportRoute;
        $this->name = $name;
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
