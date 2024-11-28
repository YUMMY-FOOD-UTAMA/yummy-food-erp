<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdvanceFilter extends Component
{
    public $usingApplyButton;
    
    public function __construct($usingApplyButton = false)
    {
        $this->usingApplyButton = $usingApplyButton;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table.advance-filter');
    }
}