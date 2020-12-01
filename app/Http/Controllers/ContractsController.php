<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contracts;
use App\Models\Customers;
use Route;

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

    public function index() {

        // All contracts

        $contracts = Contracts::all();

        return view('contracts.index', ['contracts'=> $contracts]);
    }
    
    public function show() {
        
        return view('contracts.show', ['allContracts' => $this->customers->contracts()]);
    }

    public function create() {

        return view('contracts.create');
    }

    public function store() {

        //persist to DB
    }

    public function edit() {

        //opens a form with info to update
    }

    public function update() {

        //will update what comes from create
    }

    public function destory($id) {

        Contracts::where('id','=', $id)->delete();
        //delete the customer
        Route::redirect('/customers', 'customers');

    }

    public function customers($user_id) {
        
        return view('contracts.index');
    }
}
