<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class propertyForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $purposes;
    public function __construct($purposes=null)
    {
        //
        $this->$purposes= $purposes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.property-form');
    }
}
