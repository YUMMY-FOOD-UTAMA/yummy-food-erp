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
    public $editRoute;

    public $restoreRouteName;
    public $softDeleteRouteName;
    public $hardDeleteRouteName;
    public $editRouteName;

    /**
     * Create a new component instance.
     */
    public function __construct($editRoute = null, $hardDeleteRouteName = null, $softDeleteRouteName = null, $restoreRouteName = null, $editRouteName = null, $viewRoute = null, $softDeleteRoute = null, $deletePreview = null, $hardDeleteRoute = null, $restoreRoute = null, $modalViewID = null)
    {
        $this->viewRoute = $viewRoute;
        $this->softDeleteRoute = $softDeleteRoute;
        $this->deletePreview = $deletePreview;
        $this->hardDeleteRoute = $hardDeleteRoute;
        $this->restoreRoute = $restoreRoute;
        $this->modalViewID = $modalViewID;
        $this->restoreRouteName = $restoreRouteName;
        $this->softDeleteRouteName = $softDeleteRouteName;
        $this->hardDeleteRouteName = $hardDeleteRouteName;
        $this->editRouteName = $editRouteName;
        $this->editRoute = $editRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $id = 'a' . str_replace('-', '', Uuid::uuid4()->toString());;
        return view('components.table.action-button', compact('id'));
    }
}
