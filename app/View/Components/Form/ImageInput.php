<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageInput extends Component
{
    public string $name;
    public $image;
    public $viewOnly;

    /**
     * Create a new component instance.
     */
    public function __construct($name = 'avatar', $image = 'assets/media/svg/avatars/blank.svg', $viewOnly = false)
    {
        $this->name = $name;
        $this->image = $image;
        $this->viewOnly = $viewOnly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.image-input');
    }
}
