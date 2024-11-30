<?php

namespace App\View\Components\Form;

use App\Utils\Primitives\Timezone;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Ramsey\Uuid\Uuid;

class SelectBoxTimezones extends Component
{
    public string $timezone;
    public string $type;
    public $uuid;
    public $dropDownParentID;
    public $sizeForm;

    public function __construct(string $timezone = '', $uuid = null, string $type = 'inline', string $dropDownParentID = '', $sizeForm = 'lg')
    {
        $this->timezone = $timezone;
        $this->type = $type;
        $this->dropDownParentID = $dropDownParentID;
        $this->uuid = "a".Uuid::uuid4()->toString();
        if ($uuid) {
            $this->uuid = $uuid;
        }
        if ($this->dropDownParentID != '') {
            $this->dropDownParentID = "#" . $this->dropDownParentID;
        }
        $this->sizeForm = $sizeForm;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $timezones = Timezone::getTimezones();
        return view('components.form.select-box-timezones', compact(
            'timezones'
        ));
    }
}
