<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DB;

class material extends Component
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
        $material = DB::table('material')->get();

        return view('components.material',['materials' => $material]);
    }
}
