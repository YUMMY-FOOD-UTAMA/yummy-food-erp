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
    public $name;

    /**
     * Create a new component instance.
     */
    public function __construct($name = '', $id = '', $value = '', $checked = false)
    {
        $this->id = $id;
        $this->value = $value;
        $this->checked = $checked;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.checkbox-input');
    }
}
