<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Customers;
use App\Models\Companies;
use Route;
use Auth;

class ContractsController extends Controller
{
    //
    public $customers;
    public $user;

    public function __construct()
    {
        $this->middleware('auth');

        $this->customers = new Customers;

    }

    public function index($id) {

        // All contracts

        $customer = Customers::find($id);

        $contracts = Customers::find($id)->contracts();

        return view('contracts.index', ['contracts'=> $contracts->get(), 'customer' => $customer]);
    }
    
    public function show() {
        
        return view('contracts.show', ['allContracts' => $this->customers->contracts()]);
    }

    public function create($id) {

        Contracts::where('dealer','=', 'dealer null')->where('customers_id','=',$id)->delete();

        $contract = new Contracts;

        $contract->customers_id = $id;
        $contract->contract_number = 'BHR-NOT CREATED';
        $contract->dealer = 'dealer null';
        $contract->sales_person = ' ';
        $contract->customer_name = ' ';
        $contract->email = ' ';
        $contract->phone = ' ';
        $contract->secondary_phone = '';
        $contract->contract_state = ' ';
        $contract->shipping_address = ' ';
        $contract->shipping_city = ' ';
        $contract->shipping_state = ' ';
        $contract->shipping_county = ' ';
        $contract->shipping_country = ' ';
        $contract->shipping_postal_code = ' ';
        $contract->reference_name = ' ';
        $contract->reference_phone = ' ';
        $contract->product_size = ' ';
        $contract->product_style = ' ';
        $contract->product_material = ' ';
        $contract->product_roof_material = ' ';
        $contract->product_serial_number = ' ';
        $contract->product_cash_price = 0.00;
        $contract->product_sales_tax = 0.00;
        $contract->product_sales_tax_amount = 0.00;
        $contract->product_delivery_charge = 0.00;
        $contract->product_side_color = ' ';
        $contract->product_trim_color = ' ';
        $contract->product_roof_color = ' ';
        $contract->product_condition = ' ';
        $contract->monthly_payment = 0.00;
        $contract->rto_terms = '36';
        $contract->delivery_date = '2020-12-12';
        $contract->ldw = 0;
        $contract->ldw_monthly = 0.00;
        $contract->initial_down_payment = 0.00;
        $contract->original_initial_payment = 0.00;
        $contract->cra = 0.00;
        $contract->initial_payment = 0.00;
        $contract->initial_payment_type = '';
        $contract->recurring_payment = 0;
        $contract->papperless_billing = 0;
        $contract->signed = 0;
        $contract->initial_payment_made = 0;

        $contract->save();
    
        return view('contracts.edit', ['contract' => $contract, 'company' => $this->userCompany(), 'customer' => Customers::find($id) ]);
    }

    public function store() {

        //persist to DB
    }

    public function edit($contract_id) {

        //opens a form with info to update
        $contract = Contracts::find($contract_id);
        return view('contracts.edit', ['contract' => $contract, 'company' => $this->userCompany(), 'customer' => Customers::find($contract->customers_id) ]);
    }

    public function update($contract_id) {
        //will update what comes from create
        
        $validated_data = request()->validate([
            'dealer' => 'required | string',
            'contract_number' => 'required | string',
            'customers_id' => 'required | numeric',
            'sales_person' =>   'required | string',
            'customer_name' => 'required | string',
            'email' => 'required | email',
            'phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10',
            'secondary_phone' => 'nullable | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10',
            'contract_state' => 'required | max:2',
            'shipping_address' => 'required | string',
            'shipping_city' => 'required | string',
            'shipping_state' => 'required | min:2 | max:2',
            'shipping_county' => 'required | string',
            'shipping_country' => 'required | min:3 | max:3',
            'shipping_postal_code' => 'required | min:5 | max:5',
            'reference_name' => 'required | string',
            'reference_phone' => 'required | regex:/^([0-9\s\-\+\(\)]*)$/ | min:10',
            'product_size' => 'required | regex:/^[0-9]{2}x[0-9]{2}/',
            'product_style' => 'required | string',
            'product_material' => 'required | string',
            'product_side_color' => 'required | string',
            'product_trim_color' => 'required | string',
            'product_roof_color' => 'required | string',
            'product_roof_material' => 'required | string',
            'rto_terms' => 'required | numeric',
            'product_serial_number' => 'required | string',
            'product_condition'  => 'required | string',
            'product_condition_description' => 'exclude_unless:product_condtion,used | string',
            'product_cash_price' => 'required | numeric',
            'product_sales_tax' => 'required | numeric',
            'product_delivery_charge' => 'nullable | numeric',
            'delivery_date' => 'required | date',
            'ldw' => 'required | boolean',
            'ldw_monthly' => 'required_if:ldw_radio,1',
            'initial_down_payment' => 'nullable | numeric',
            'original_initial_payment' => 'nullable | numeric',
            'cra' => 'required',
            'initial_payment' => 'required | numeric',
            'initial_payment_type' => 'required | string',
            'recurring_payment' => 'boolean',
            'recurring_payment_type' => 'exclude_unless:recurring_payment,1 | string',
            'recurring_payment_date' => 'exclude_unless:recurring_payment,1 | numeric',
            'papperless_billing' => 'nullable | boolean',
            'signed' => 'nullable | boolean',
            'initial_payment_made' => 'nullable | boolean'
        ]);
        
        $contract = Contracts::find( $contract_id );

        $contract->update($validated_data);
        
        return redirect()->route('customers');
        //return redirect()->route('all_contracts');

    }

    public function destory($id) {

        //delete the customer
        Contracts::where('id','=', $id)->delete();
        return redirect()->route('customers');

    }

    public function customers($user_id) {
        
        return view('contracts.index');
    }

    public function userCompany() {

        return $userCompany = Companies::find(Auth::id());

    }
}
