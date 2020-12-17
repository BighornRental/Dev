<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\States;

class ListStates extends Component
{
    public $name;
    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label)
    {
        //
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $states  = states::all();

        return view('components.ListStates', ['states' => $states]);
    }
}
