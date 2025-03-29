<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public string $name;
    public string $class;
    public bool $show;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, string $class = '', bool $show = true)
    {
        $this->name = $name;
        $this->class = $class;
        $this->show = $show;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): \Illuminate\Contracts\View\View|\Closure|string
    {
        return view('components.icon');
    }
}
