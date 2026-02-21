<?php

namespace App\View\Components;

use App\Models\SiteLogo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
     public $logo;
    public function __construct()
    {
        //
         $this->logo = SiteLogo::where('is_active', true)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
