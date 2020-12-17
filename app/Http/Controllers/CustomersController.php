<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Contracts;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index() {

        //show a list of customers
        $customers = User::find(\Auth::user()->id)->customers();

        return view('customers.index', ['customers'=> $customers->simplePaginate(4)]);

    }
    public function show( customers $customer ) {

            // show a single customer

            return view('customers.show', ['customer' => $customer]);

    }

    public function create() {

        // create a new customer

        return view('customers.create');
    }

    public function store() {

        
        //persist a customer
        Customers::create( $this->validateCustomer() );

        return redirect('/customers');
    }
    
    public function edit(Customers $customer) {

        //show the customer to edit
        
        return view('customers.edit', ['customer' => $customer]);

    }

    public function update(Customers $customer) {

        $customer->update($this->validateCustomer());
        return redirect()->route('customers');

    }

    public function destroy(Customers $customer) {

        //delete the customer
        $customer->delete();
        return redirect()->route('customers');

    }

    public function contracts($id) {
    
        $contracts = Contracts::find($id)->contracts(); // hasMany contracts
     
        return view('contracts.index', ['contracts' => $contracts, 'customer' => $customer]);
    }

    protected function validateCustomer() {

        return request()->validate([
            'user_id' => 'required',
            'first_name' => 'required | string',
            'last_name' => 'required | string',
            'address' => 'required | string',
            'city' => 'required | string',
            'state' => 'required | max:2',
            'postal_code' => 'required | digits:5',
            'county' => 'required | string',
            'country' => 'required | string',
            'county' => 'required | string',
            'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10',
            'email' => 'required',
            'secondary_phone' => 'nullable | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10',
        ]);

    }
}
