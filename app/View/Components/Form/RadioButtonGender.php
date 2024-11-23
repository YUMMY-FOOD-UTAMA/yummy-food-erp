<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioButtonGender extends Component
{
    public $defaultValue;

    /**
     * Create a new component instance.
     */
    public function __construct($defaultValue = null)
    {
        $this->defaultValue = $defaultValue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.radio-button-gender');
    }
}
