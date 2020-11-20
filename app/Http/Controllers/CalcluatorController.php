<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\terms;

class CalcluatorController extends Controller
{
    private $LoanTerm;
    private $TotalPrice;
    private $DownPayment;
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

    public function calculate(Request $request) {

        $this->LoanTerm = $request->input('rto-terms');
		$this->TotalPrice = $request->input('product_cash_price');
		$this->DownPayment = ( empty( $request->input('original_initial_payment') ) ) ? 0 : $request->input('original_initial_payment');
		$this->TaxRate = ( empty( $request->input('product_sales_tax') ) ) ? 0 : $request->input('product_sales_tax');
		$this->LDWMonthly = ($request->input('liability_damage_waver') == 'accept') ? 8 : 0;
        $this->DeliveryCharge = ( $request->input('product_delivery_charge') > 0) ? $request->input('product_delivery_charge') : 0;
        
        $this->DownPayment = ($this->DownPayment == "") ? 0  : $this->DownPayment;
        // correct tax rate if user enters as a percent instead of a decimal.
        $this->TaxRate = ($this->TaxRate >= 1) ? $this->TaxRate / 100 : 0;
        
        // calculate FullPrice (Labeled as "Contract Initial Total")
        $this->FullPrice = ( floatval($this->TotalPrice) + floatval($this->DeliveryCharge) ) - $this->DownPayment;

        $terms = terms::where('term_limits','=',$this->LoanTerm)->first();
        $this->EachPayment = round(( $this->FullPrice / $terms->term_factor ) * 100 ) / 100;
        $this->TaxPayment = round($this->EachPayment * $this->TaxRate * 100) / 100;

        $this->FirstMonth = $this->EachPayment + $this->TaxPayment + $this->DownPayment + $this->LDWMonthly;
        $this->MonthRest = $this->EachPayment + $this->TaxPayment + $this->LDWMonthly;
        $this->IntialRentalPayment = $this->EachPayment * 2;
        $this->IntialTaxPayment = $this->TaxPayment * 2;
        $this->TotalIntialPayment = $this->IntialRentalPayment + $this->IntialTaxPayment + ($this->LDWMonthly*2) + $this->DeliveryCharge;

        if($this->DownPayment > 0 ) {
            $this->reCalulatePayment($DownPayment,$TotalPrice);
        }

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
                            'TotalIntialPayment'=>number_format($this->TotalIntialPayment,'2','.',',')
                        ); 	
    
       echo json_encode($response);
    }

    // private function reCalulatePayment($DownPayment,$TotalPrice) {
    
    //     //example 1000
    //     $capturedExtraDownPayment = $DownPayment;
        
    //     if( $capturedExtraDownPayment > $TotalPrice ) {
            
    //         return false;
            
    //     }
        
    //     $dp = capturedExtraDownPayment;
        
    //     // initial values
    //     $i = 1;
    //     $dps = 0;
    //     $mls = 0;
       
    //    //lower down payment until the Month 1 and down payment are equal;
    //     do {
            
    //         //lower by 100
    //         $dp = $dp - $i;
            
    //         //set down payment to a new lower value
    //         $DownPayment = $dp;
            
    //         $this->calculate();
            
    //         //after calculations get values;
            
    //         dps = parseFloat( $("#DownPayment").val() );
            
    //         mls = parseFloat( $("#Month1").val() );
            
    //         // when we reach with a $1 we go to cents
    //         i = ((mls - 1) < capturedExtraDownPayment) ? .01 : 1;
            
    //     }
        
    //     while( mls > capturedExtraDownPayment );
        
        
    //     //making sure the down payment is great than the initial payment
    //     if(dps < 0) {
            
    //         showRecalcError("Down payment must be greater than inital first month's payment.",true);
    //     }
        
    // }
        
}
