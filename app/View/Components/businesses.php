<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DB;

class businesses extends Component
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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
       
        $businesses = DB::table('Company')->get();
        
        return view('components.businesses', ['businesses' => $businesses]);
    }
}
