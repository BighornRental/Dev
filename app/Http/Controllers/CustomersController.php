<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Contracts;
use App\Modles\User;
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
        
        $customers = Customers::simplePaginate(4)->user;

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

        // $validatedAttr = request()->validate([

        //     'first_name' => 'required | string',
        //     'last_name' => 'required | string',
        //     'address' => 'required | string',
        //     'city' => 'required | string',
        //     'state' => 'required | max:2',
        //     'postal_code' => 'required | digits:5',
        //     'county' => 'required | string',
        //     'country' => 'required | string',
        //     'county' => 'required | string',
        //     'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10',
        //     'email' => 'required| unique:customers',
        //     'secondary_phone' => 'nullable | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10'
        // ]);
       
        //persist a customer
        Customers::create( $this->validateCustomer() );
    


        return redirect('/customers');
    }
    
    public function edit(customers $customer) {

        //show the customer to edit

        return view('customers.edit', ['customer' => $customer]);

    }

    public function update($id) {

        $customer = Customers::find($id);
        $customer->update( $this->validateCustomer() );

        return redirect('/customers');

    }

    public function destroy() {

        //delete the customer

    }

    public function contracts() {

        $customer = Customers::find($customer);
    
        $contracts = $customer->contracts; // hasMany contracts
        
        return view('contracts.index', ['contracts' => $contracts, 'customer' => $customer]);
    }

    protected function validateCustomer() {

        
        // Validator::make(request()->validate([
        //     'email' => [
        //         'required',
        //         Rule::unique('customers')->ignore($customer->id),
        //     ],
        // ]));
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
