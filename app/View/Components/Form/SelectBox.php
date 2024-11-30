<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class SelectBox extends Component
{
    public $name;
    public $defaultValue;
    public $valueKey;
    public $items;
    public $nameKey;
    public $label;
    public $placeholder;
    public $type;
    public $tooltip;
    public $id;
    public $uuid;
    public bool $required;
    public $dropDownParentID;
    public $customNameKey;
    public $sizeForm;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $label, $items, $sizeForm = 'lg', $customNameKey = null, $valueKey = 'id', $nameKey = 'name', $dropDownParentID = '', $placeholder = '', $uuid = null, $tooltip = null, $id = null, $type = 'inline', $defaultValue = null, $required = false)
    {
        $this->sizeForm = $sizeForm;
        if ($dropDownParentID != '') {
            $this->dropDownParentID = "#" . $dropDownParentID;
        }
        $this->customNameKey = $customNameKey;
        $this->defaultValue = $defaultValue;
        $this->items = $items;
        $this->valueKey = $valueKey;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->tooltip = $tooltip;
        $this->id = $name;
        $this->required = $required;
        $this->nameKey = $nameKey;
        $this->uuid = 'a'.Uuid::uuid4()->toString();
        if ($uuid) {
            $this->uuid = $uuid;
        }

        if ($id) {
            $this->id = $id;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select-box');
    }
}
