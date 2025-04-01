<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
  
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.icon');
    }
}
