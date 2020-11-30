<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\terms;

class CalcluatorController extends Controller
{
    private $LoanTerm;
    private $TotalPrice;
    private $CRA;
    private $TaxRate;
    private $LDWMonthly;
    private $DeliveryCharge;
    private $FullPrice;
    private $EachPayment;
    private $TaxPayment;
    private $FirstMonth;
    private $MonthRest;
    private $IntialRentalPayment;
    private $IntialTaxPayment;
    private $TotalIntialPayment;
    private $error;
    private $terms;
    private $doCal = true;

    public function calculate(Request $request) {

        $this->LoanTerm = $request->input('rto-terms');
		$this->TotalPrice = $request->input('product_cash_price');
        $this->CRA = ( empty( $request->input('original_initial_payment') ) ) ? 0 : $request->input('original_initial_payment');
        $this->CRA = ($this->CRA <1) ? 0  : $this->CRA;
		$this->TaxRate = ( empty( $request->input('product_sales_tax') ) ) ? 0 : $request->input('product_sales_tax');
		$this->LDWMonthly = ($request->input('liability_damage_waver') == 'accept') ? 8 : 0;
        $this->DeliveryCharge = ( $request->input('product_delivery_charge') > 0) ? $request->input('product_delivery_charge') : 0;
        $this->doCal = ($this->CRA > 0) ? true : false;
        // $this->doCalcuate();
        // while($this->doCal) {
        //     $this->reCalulatePayment();
        // }
        echo $this->doCalcuate();
    }

    private function doCalcuate() {

        // correct tax rate if user enters as a percent instead of a decimal.
        $this->TaxRate = ($this->TaxRate >= 1) ? $this->TaxRate / 100 : 0;
        
        // calculate FullPrice (Labeled as "Contract Initial Total")
        $this->FullPrice = floatval($this->TotalPrice);

        $this->terms = terms::where('term_limits','=',$this->LoanTerm)->first();
        $this->EachPayment = round(( $this->FullPrice / $this->terms->term_factor ) * 100 ) / 100;
        $this->TaxPayment = round($this->EachPayment * $this->TaxRate * 100) / 100;

        $this->FirstMonth = $this->EachPayment + $this->TaxPayment + $this->CRA + $this->LDWMonthly;
        $this->MonthRest = $this->EachPayment + $this->TaxPayment + $this->LDWMonthly;
        $this->IntialRentalPayment = $this->EachPayment * 2;
        $this->IntialTaxPayment = $this->TaxPayment * 2;
        $this->TotalIntialPayment = $this->IntialRentalPayment + $this->IntialTaxPayment + ($this->LDWMonthly*2) + $this->DeliveryCharge;
        $totalCost = $this->EachPayment * $this->terms->term_limits;

        if(!$this->doCal) {
            $response = array(  'FullPrice'=>number_format($this->FullPrice,'2','.',','), 
                                'EachPayment'=>number_format($this->EachPayment,'2','.',','),
                                'IntialRentalPayment'=>number_format($this->IntialRentalPayment,'2','.',','),
                                'IntialTaxPayment'=>number_format($this->IntialTaxPayment,'2','.',','),
                                'TaxPayment'=>number_format($this->TaxPayment,'2','.',','),
                                'FirstMonth'=>number_format($this->FirstMonth,'2','.',','),
                                'MonthRest'=>number_format($this->MonthRest,'2','.',','),
                                'LoanTerm'=>$this->LoanTerm,
                                'LDWMonthly'=>number_format($this->LDWMonthly,'2','.',','),
                                'DeliveryCharge'=>number_format($this->DeliveryCharge,'2','.',','),
                                'TotalIntialPayment'=>number_format($this->TotalIntialPayment,'2','.',','),
                                'TotalCost'=> number_format($totalCost,'2','.',','),
                                'CRAccount'=> number_format($this->CRA,'2','.',',')
                            ); 	
        
        return json_encode($response);
    }
}

    private function reCalulatePayment() {
    
        //example 1000
        $capturedExtraDownPayment = $this->CRA;
        
        if( $capturedExtraDownPayment > $this->FullPrice ) {
            
            $this->error = array('error','The down payment cannot be larger than the total price.');

            return $this->error;
            
        }
        
        $DownPayment = $capturedExtraDownPayment;
        
        // initial values
        $i = 1;
        $dps = 0;
        $mls = 0;
        
       //lower down payment until the Month 1 and down payment are equal;
        do {
            
            $DownPayment = $DownPayment - $i;

            $this->CRA = $DownPayment;

            $this->doCalcuate();

            $dps = $this->CRA;

            $mls = $this->FirstMonth;

            $i = (($mls - 1) < $capturedExtraDownPayment) ? .01 : 1;
            
        }
        
        //while( $mls > $capturedExtraDownPayment );
        while($i < 10);
        $this->doCal = false;
        
        //making sure the down payment is great than the initial payment
        if($extraDownPaymentSaved < 0) {
            
            //showRecalcError("Down payment must be greater than inital first month's payment.",true);
        }
        
    }
        
}
