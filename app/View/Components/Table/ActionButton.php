<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class ActionButton extends Component
{
    public $viewRoute;
    public $softDeleteRoute;
    public $hardDeleteRoute;
    public $deletePreview;
    public $restoreRoute;
    public $modalViewID;

    /**
     * Create a new component instance.
     */
    public function __construct($viewRoute = null, $softDeleteRoute = null, $deletePreview = null, $hardDeleteRoute = null, $restoreRoute = null, $modalViewID = null)
    {
        $this->viewRoute = $viewRoute;
        $this->softDeleteRoute = $softDeleteRoute;
        $this->deletePreview = $deletePreview;
        $this->hardDeleteRoute = $hardDeleteRoute;
        $this->restoreRoute = $restoreRoute;
        $this->modalViewID = $modalViewID;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $id = str_replace('-', '', Uuid::uuid4()->toString());;
        return view('components.table.action-button', compact('id'));
    }
}
