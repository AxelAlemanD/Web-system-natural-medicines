<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
        /**
     * The label for textarea
     * @var string
     */

    public $label;
    
    /**
     * The textarea name.
     * @var string
     */
    public $name;
    
    /**
     * The textarea rows.
     * @var int
     */
    public $rows;
    
    /**
     * The textarea placeholder.
     *
     * @var string
     */
    public $placeholder;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $rows, $placeholder)
    {
        $this->label = $label;
        $this->name = $name;
        $this->rows = $rows;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text-area');
    }
}
