<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MasterCrud extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;
    public $items;
    public $routePrefix;
    public $categories;
    public $purposes;
    public function __construct($title, $data, $routePrefix, $categories = null, $purposes = null)
    {
        //


        $this->title = $title;
        $this->items = $data;
        $this->routePrefix = $routePrefix;
        $this->categories = $categories;
        $this->purposes = $purposes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.master-crud');
    }
}
