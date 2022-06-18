<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuBuilder extends Component
{
    /**
     * The Menu Items.
     *
     * @var string
     */
    public $menuItems;

    /**
     * Create a new component instance.
     *
     * @param $menuItems
     */
    public function __construct($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-builder');
    }
}
