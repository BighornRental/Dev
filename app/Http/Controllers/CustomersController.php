<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Contracts;

class CustomersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index() {

        //show a list of customers
        
        $customers = Customers::all();

        return view('customers.index', ['customers'=> $customers]);

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

        $validatedAttr = request()->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'county' => 'required',
            'country' => 'required',
            'county' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:customers'
        ]);
        //$validatedAttr['secondary_phone'] = request('secondary_phone');
       
        //persist a customer
        Customers::create( $validatedAttr );
        // $customer = new Customers();

        // $customer->first_name = request('first_name');
        // $customer->last_name = request('last_name');
        // $customer->address = request('address');
        // $customer->city = request('city');
        // $customer->state = request('state');
        // $customer->postal_code = request('postal_code');
        // $customer->county = request('county');
        // $customer->country = request('country');
        // $customer->county = request('county');
        // $customer->phone = request('phone');
        // $customer->secondary_phone = request('secondary_phone');
        // $customer->email = request('email');


        return redirect('/customers');
    }
    
    public function edit(customers $customer) {

        //show the customer to edit

        return view('customers.edit', ['customer' => $customer]);

    }

    public function update(customers $customer) {

        request()->validate([

            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'county' => 'required',
            'country' => 'required',
            'county' => 'required',
            'phone' => 'required',
            'email' => 'required'
        ]);

        //update the edited customer

        $customer->first_name = request('first_name');
        $customer->last_name = request('last_name');
        $customer->address = request('address');
        $customer->city = request('city');
        $customer->state = request('state');
        $customer->postal_code = request('postal_code');
        $customer->county = request('county');
        $customer->country = request('country');
        $customer->county = request('county');
        $customer->phone = request('phone');
        $customer->secondary_phone = request('secondary_phone');
        $customer->email = request('email');

        $customer->save();

        return redirect('/customers');

    }

    public function destroy() {

        //delete the customer

    }

    public function contracts($customer) {

        $customer = Customers::find($customer);
    
        $contracts = $customer->contracts; // hasMany contracts
        
        return view('contracts.index', ['contracts' => $contracts, 'customer' => $customer]);
    }
}
