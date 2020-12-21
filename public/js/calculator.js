//const { set } = require("lodash");

var isError = 0;
// corrects decimal point positions
function dm(amount) 
{
	string = "" + amount;
	dec = string.length - string.indexOf('.');
	if (string.indexOf('.') == -1)
		return string + '.00';
	if (dec == 1)
		return string + '00';
	if (dec == 2)
		return string + '0';
	if (dec > 3)
		return string.substring(0,string.length-dec+3);
	return string;
}
// calculate the payment/deposit
function calculate()
{	 
	// get input values from the form
	var LoanTerm = $("#rto_terms").val(),
		TotalPrice = parseFloat($("#product_cash_price").val()),
		DownPayment = $("#original_initial_payment").val(),
		TaxRate = parseFloat($("#product_sales_tax").val()),
		LDWMonthly = 0.00,
		DeliveryCharge = ($("#product_delivery_charge").val() > 0) ? parseFloat($("#product_delivery_charge").val()) : 0;
		CustmerReserveAccount = ( $("#cra").val() > 0) ?  $("#cra").val() : 0
		TotalIntialPayment = 0, // this is the final charges
		CRA = 0,
		payoff = {
			24: "70%",
			36: "60%",
			48: "50%",
			60: "40%"
		};

	if( $("input[name='ldw']:checked").val() == '1') {

		if(TotalPrice > 9999) {
			LDWMonthly = 15.00;
		}
		else if(TotalPrice > 2999) {
			LDWMonthly = 8.00;
		}
		else {
			LDWMonthly = 5.00;
		}
	}
	else {
		LDWMonthly = 0.00
	}	

	// label term length
	//$("#TermLength").html(LoanTerm);

	if (DownPayment == "") { DownPayment = 0;}
	if (TaxRate == "") { TaxRate = 0;}
	
	// correct tax rate if user enters as a percent instead of a decimal.
	TaxRate = (TaxRate >= 1) ? TaxRate / 100 : 0;
	
	// calculate FullPrice (Labeled as "Contract Initial Total")
	var FullPrice = ( !isNaN(TotalPrice) ) ? parseFloat( TotalPrice - CustmerReserveAccount ) : 0,
		FullPriceNoCRA = TotalPrice;
	
	// calculate EachPayment
	// var EachPayment = 0;
	// if (LoanTerm == 24) { 
	// 	EachPayment = Math.round((FullPrice/17.0)*100)/100;
	// } else if (LoanTerm == 36) { 
	// 	EachPayment = Math.round((FullPrice/21.6)*100)/100;
	// } else if (LoanTerm == 48) {
	// 	EachPayment = Math.round((FullPrice/24.0)*100)/100;
	// } else if (LoanTerm == 60) {
	// 	EachPayment = Math.round((FullPrice/27.0)*100)/100;
	// } else {
	// 	alert("Unable to determine contract term!");
	// 	return;
	// }
	EachPayment = RTOTerms(LoanTerm, FullPrice);
	EachPaymentNoCRA = RTOTerms(LoanTerm, FullPriceNoCRA);
	// calculate tax
	var TaxPayment = Math.round((eval(EachPayment)) * TaxRate*100)/100,
		TaxPaymentNoCRA = Math.round((eval(EachPaymentNoCRA)) * TaxRate*100)/100;
	
	Month1 = (EachPayment + TaxPayment);
	Month1NoCRA = (EachPaymentNoCRA + TaxPaymentNoCRA)
	Month1 = Month1 + LDWMonthly;
	Month1NoCRA = Month1NoCRA + LDWMonthly;
	TotalIntialPayment = Month1 * 2;
	CRA = ( $("#cra").val() < 1) ? 0 : $("#cra").val();
	TotalIntialPayment = TotalIntialPayment + DeliveryCharge + parseFloat(CRA);

	$("#total-no-cra").text(FullPriceNoCRA + " " + EachPaymentNoCRA + " " + TaxPaymentNoCRA);
	//hidden inputs
	$("#product_sales_tax_amount").val(TaxPayment);
	$("#monthly_payment").val(EachPayment);
	
	//the inputs
	$("#month1").val( Month1 * 2);
    $("#irp").val(dm(EachPayment*2));
	$("#ist").val(dm(TaxPayment * 2)); 	
	$("#ldw2").val(dm(LDWMonthly*2));
	$("#cra").val(CRA);
	$("#dc").val(dm(DeliveryCharge));
	$("#tip").val(dm(TotalIntialPayment));
	$("#initial-payment").attr("value", dm(TotalIntialPayment));
	$("#ldw_monthly").val(dm(LDWMonthly));
	$("#no-cra-payment").val(dm(EachPaymentNoCRA));
	$("#no-cra-tax").val(dm(TaxPaymentNoCRA));
	$("#no-cra-total").val(dm(Month1NoCRA));
	$("#cra-payment").val(dm(EachPayment));
	$("#cra-tax").val(dm(TaxPayment));
	$("#cra-total").val(dm(Month1));
	// end inputs

	// no cra row
	$("#payment-no-cra").text(dm(EachPaymentNoCRA)); 	
	$(".tax-cra").text(dm(TaxPaymentNoCRA));
	$(".ldw-cra").text(dm(LDWMonthly));
	$("#no-ldw-total").text(dm(Month1NoCRA));
	// end no cra row

	// yes cra row
	$("#payment-yes-cra").text(dm(EachPayment));
	$("#yes-ldw-total").text(dm(Month1));
	$("#payment-with-cra").text(dm(EachPayment)); 
	$(".tax-with-cra").text(dm(TaxPayment));	
	$(".ldw-with-cra").text(dm(LDWMonthly));
	$("#with-ldw-total").text(dm(Month1));
	// yes cra row end

	// agree to terms row
	$("#ContractTotal").text( dm(EachPayment * LoanTerm)); 	
	$("#AgreeToTerms").text(LoanTerm);
	po = (TotalPrice / (EachPayment * LoanTerm)) * 100;
	$("#PayOff").text(payoff[LoanTerm]);
	// end agree to terms row

    
}
// sets error condition
function error(selector) {
	isError = 1;
	$(selector).addClass("error");
	$("#ContractTotal").val(""); 	
	$("#Deposit").val("&#160;");
	$("#MonthlyPayment").val("&#160;"); 	
	$("#TaxPayment").val("&#160;"); 	
	$("#Month1").val("&#160;"); 	
	$("#MonthRest").val("&#160;"); 	
}
// checks to see if a value is numeric
// function IsNumeric(val) {

// 	return !isNaN(parseFloat(val)) && isFinite(val);
	
// }

function RTOTerms(LoanTerm, FullPrice) {

	var EachPayment = 0;
	if (LoanTerm == 24) { 
		EachPayment = Math.round((FullPrice/17.0)*100)/100;
	} else if (LoanTerm == 36) { 
		EachPayment = Math.round((FullPrice/21.6)*100)/100;
	} else if (LoanTerm == 48) {
		EachPayment = Math.round((FullPrice/24.0)*100)/100;
	} else if (LoanTerm == 60) {
		EachPayment = Math.round((FullPrice/27.0)*100)/100;
	} else {
		alert("Unable to determine contract term!");
		return;
	}
	return EachPayment;
}
    
function reCalulatePayment() {

    //example 1000
	var capturedExtraDownPayment = parseFloat( $("#original_initial_payment").val() );
	
    if(capturedExtraDownPayment > $("#product_cash_price").val()) {
        
        showRecalcError("Down payment cannot be greater than cash price.",false);
        
        return false;
        
    }
    
    var dp = capturedExtraDownPayment;
    
    // initial values
    var i = 1;
    var dps = 0
    var mls = 0;
   
   //lower down payment until the Month 1 and down payment are equal;
    do {
        
        //lower by 100
        dp = dp - i;
        
        //set down payment to a new lower value
		//$("#DownPayment").val(dp.toFixed(2));
		$("#cra").val(dp.toFixed(2))
        
        calculate();
        
        //after calculations get values;
        
        dps = parseFloat( $("#cra").val() );
        
		mls = parseFloat($("#month1").val());
		        
        // when we reach with a $1 we go to cents
        i = ((dps + mls) - 1  < capturedExtraDownPayment) ? .01 : 1;
        
    }

	while( (dp + mls) > capturedExtraDownPayment );
	
	cra = parseFloat( $("#cra").val() );

	if( cra < capturedExtraDownPayment ) {
		 $("#cra").val((cra + .01).toFixed(2));
		 if($("#cra").val() < 0) {
			$("#cra").val(0);
		}
	} else if( cra > capturedExtraDownPayment ) {
		$("#cra").val((cra - .01).toFixed(2));
	}
	else {
		$("#cra").val(cra);
	}
	calculate();

	$("#original_initial_payment").val( parseFloat($("#original_initial_payment").val()).toFixed(2) );

	$("#calc_now").hide();

	if( $("#initial_down_payment").val() != ( parseFloat($("#tip").val()) - $("#dc").val() ) ) {
		alert('Please adjust the "Down Payment" (CRA). The "Down Payment" (CRA) may be less than the initial payment. Try using the plus and minus until the "Total Initial Payment" = the "Down Payment" (CRA) amount.')
	}
    //making sure the down payment is great than the initial payment
    if(dps < 0) {
        
        showRecalcError("Down payment must be greater than inital first month's payment.",true);
    }
    
}
    
function showRecalcError(message,shouldDo) {
    
    alert(message);
        
    $("#DownPayment").val(0);

    if(shouldDo) {
        
        calculate();
        
    }
    
}

jQuery(function($) {
    
    $("#rto_terms").on('change',function() {
    	
        calculate();	
    });
    $("#product_cash_price").on('keyup',function() {
		
		calculate();
			
    });
    $("#product_cash_price").on('keyup',function() {
		
		calculate();	
	});
	
    $("#product_sales_tax").on('change',function() {

        // correct tax rate field if user enters as a percent instead of a decimal.
        // don't do this on the keyup event.
        // var TaxRate = $("#product_sales_tax").val();
        // if (TaxRate >= 1) {
        //     TaxRate = TaxRate / 100;
        //     $("#product_sales_tax").val(TaxRate);
        // }
        calculate();
    });
	$("#product_sales_tax").on('keyup',function() {

    	calculate();
    });
    $("#original_initial_payment").on('click',function() {

		calculate();	
    });
    $("#original_initial_payment").on('keyup',function() {
	
		calculate();	
	});
	
	$("#product_delivery_charge").on("keyup", function () {

		calculate();

	});

   $("input[name='ldw']").on('change', function() {

		calculate();

   }); 
   $("#initial_down_payment").on("keyup", function() {

		$("#original_initial_payment").val($(this).val() );

   }); 
	
   $("#adjust_dp span").on('click', function() {

		var adjusted = ( $(this).attr('rel') == "down" ) ? parseFloat($("#original_initial_payment").val()) - .01 : parseFloat( $("#original_initial_payment").val()) + .01;

		$("#original_initial_payment").val(adjusted.toFixed(2));
   });
   //calculate();
    
    $("#AdjDownPayment").on('click', function(event) { 

		event.preventDefault();

		$("#calc_now").show( 100, function() {
			
			var oip = ( $("#original_initial_payment").val() < 1 )  ? 0 : $("#original_initial_payment").val();
			
			$("#original_initial_payment").val(oip);
			
			reCalulatePayment(); 

		});
        
    } );
}(jQuery));

