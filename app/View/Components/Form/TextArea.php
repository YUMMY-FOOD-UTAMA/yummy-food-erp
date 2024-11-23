<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    public $row;
    public $autoResize;
    public $name;
    public $defaultValue;
    public $label;
    public $tooltip;
    public $id;
    public bool $required;
    public $viewOnly;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $tooltip = null, $viewOnly = false, $id = null, $defaultValue = null, $required = false, $autoResize = false, $row = 3)
    {
        $this->autoResize = $autoResize;
        $this->row = $row;
        $this->name = $name;
        $this->defaultValue = $defaultValue;
        $this->label = $label;
        $this->tooltip = $tooltip;
        $this->id = $name;
        $this->required = $required;
        if ($id) {
            $this->id = $id;
        }
        $this->viewOnly = $viewOnly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.text-area');
    }
}
