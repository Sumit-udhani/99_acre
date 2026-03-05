<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Banner extends Component
{
    /**
     * Create a new component instance.
     */
      public $banner;
    public $purposes;
    public $categories;
       public $types;

    public function __construct($banner,$purposes,$categories,$types)
    {
        //

        $this->banner = $banner;
        $this->purposes = $purposes;
        $this->categories = $categories;
        $this->types = $types;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.banner');
    }
}
