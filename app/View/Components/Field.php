<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Field extends Component
{
    /**
     * The label for input
     * @var string
     */

    public $label;
    
    /**
     * The input name.
     * @var string
     */
    public $name;
    
    /**
     * The input type.
     * @var string
     */
    public $type;

    /**
     * The input value.
     * @var string
     */
    public $value;
    
    /**
     * The input placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The input events attributes.
     *
     * @var string
     */
    public $other;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $type, $value, $placeholder, $other = null)
    {
        $this->label        = $label;
        $this->name         = $name;
        $this->type         = $type;
        $this->value        = $value;
        $this->placeholder  = $placeholder;
        $this->other        = $other;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.field');
    }
}
