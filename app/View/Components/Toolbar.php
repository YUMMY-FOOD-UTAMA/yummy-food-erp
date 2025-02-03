<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Toolbar extends Component
{
    public string $name;
    public $headingName;
    public $routeCreateName;
    public $routeTrashName;
    public $routeListName;
    public $usingCreateModal;
    public $createLabelName;
    public string $modalSize;
    public $withOutHeading;

    /**
     * Create a new component instance.
     */
    public function __construct($createLabelName = "create",$withOutHeading = false,$modalSize = "1000", $name = 'data', $routeCreateName = null, $routeTrashName = null, $routeListName = null, $headingName = null, $usingCreateModal = false)
    {
        $this->name = $name;
        $this->routeCreateName = $routeCreateName;
        $this->routeTrashName = $routeTrashName;
        $this->routeListName = $routeListName;
        $this->headingName = $headingName;
        $this->usingCreateModal = $usingCreateModal;
        $this->modalSize = $modalSize;
        $this->withOutHeading = $withOutHeading;
        $this->createLabelName = $createLabelName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.toolbar');
    }
}
