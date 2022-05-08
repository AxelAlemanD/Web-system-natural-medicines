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
     * The textarea content.
     * @var string
     */
    public $content;
    
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
     * The textarea events attributes.
     *
     * @var string
     */
    public $other;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $content, $rows, $placeholder, $other = null)
    {
        $this->label        = $label;
        $this->name         = $name;
        $this->content      = $content;
        $this->rows         = $rows;
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
        return view('components.text-area');
    }
}
