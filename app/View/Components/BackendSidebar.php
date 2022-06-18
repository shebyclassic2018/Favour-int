<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class BackendSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        // $items = menu('backend-sidebar');
        $items = menu(Auth::user()->role->slug);


        // dd($items);


        return view('components.backend-sidebar', compact('items'));
    }
}
