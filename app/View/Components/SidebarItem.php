<?php
// app/View/Components/SidebarItem.php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarItem extends Component
{
    public $route;
    public $icon;
    public $label;
    public $active;

    public function __construct($route, $icon, $label)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->label = $label;
        $this->active = request()->routeIs($route);
    }

    public function render()
    {
        return view('components.sidebar-item');
    }
}
