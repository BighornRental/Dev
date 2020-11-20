<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\payment_types;

class paymentType extends Component
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
        $paymentType = payment_types::all();
        
        return view('components.payment-type', compact('paymentType') );
    }
}
