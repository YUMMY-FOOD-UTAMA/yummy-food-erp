<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public string $size;
    public string $title;
    public $description;
    public $routeViewData;
    public string $id;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $description = null, $size = "", $title = "", $routeViewData = null)
    {
        $this->size = $size;
        $this->title = $title;
        $this->description = $description;
        $this->routeViewData = $routeViewData;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
