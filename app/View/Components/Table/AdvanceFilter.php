<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class AdvanceFilter extends Component
{
    public $usingApplyButton;
    public $id;

    public function __construct($usingApplyButton = false)
    {
        $this->id = Uuid::uuid4()->toString();
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
