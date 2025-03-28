<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    
    public $name;
    public $class;
    public $show;
    public function __construct($name, $class, $show)
    {
        $this->name = $name;
        $this->class = $class;
        $this->show = $show;
    }

    public function render(): View|Closure|string
    {
        return view('components.icon');
    }
}
