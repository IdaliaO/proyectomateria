<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $type;
    public $name;
    public $value;

    public function __construct($label, $name, $type = 'text', $value = '')
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.input');
    }
}
