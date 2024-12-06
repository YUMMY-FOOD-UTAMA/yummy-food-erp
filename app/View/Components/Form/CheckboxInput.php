<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckboxInput extends Component
{
    public $id;
    public $checked;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct($id = '', $value = '', $checked = false)
    {
        $this->id = $id;
        $this->value = $value;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.checkbox-input');
    }
}