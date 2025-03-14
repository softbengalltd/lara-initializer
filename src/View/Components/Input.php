<?php

namespace Softbengalltd\Larainitializer\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $type;
    public $name;
    public $placeholder;
    public $value;
    public $error;

    public function __construct($name, $type = 'text', $placeholder = '', $value = '', $error = null, $label = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->error = $error;
    }

    public function render()
    {
        return view('larainitializer::components.input');
    }
}
