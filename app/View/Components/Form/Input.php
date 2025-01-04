<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class Input extends Component
{
    public $name;
    public $defaultValue;
    public $label;
    public $placeholder;
    public $type;
    public $tooltip;
    public $id;
    public $uuid;
    public bool $required;
    public bool $viewOnly;
    public $sizeForm;
    public $mustUpperCase;
    public $withClipboard;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $withClipboard = false, $mustUpperCase = false, $sizeForm = 'lg', $placeholder = '', $viewOnly = false, $uuid = null, $tooltip = null, $id = null, $type = 'text', $defaultValue = null, $required = false)
    {
        $this->sizeForm = $sizeForm;
        $this->name = $name;
        $this->defaultValue = $defaultValue;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->tooltip = $tooltip;
        $this->id = $name;
        $this->required = $required;
        $this->uuid = 'a' . Uuid::uuid4()->toString();
        $this->viewOnly = $viewOnly;
        if ($uuid) {
            $this->uuid = $uuid;
        }
        if ($id) {
            $this->id = $id;
        }
        $this->mustUpperCase = $mustUpperCase;
        $this->withClipboard = $withClipboard;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
