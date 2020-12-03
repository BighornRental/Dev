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
	var LoanTerm = $("#rto-terms").val(),
		TotalPrice = parseFloat($("#product_cash_price").val()),
		DownPayment = $("#original_initial_payment").val(),
		TaxRate = parseFloat($("#product_sales_tax").val()),
		LDWMonthly = ($("input[name='liability_damage_waver']:checked").val() == "accept") ? 5.00 : 0.00,
		DeliveryCharge = ($("#product_delivery_charge").val() > 0) ? parseFloat($("#product_delivery_charge").val()) : 0;
		CustmerReserveAccount = ( $("#cra").val() > 0) ?  $("#cra").val() : 0
		TotalIntialPayment = 0, // this is the final charges
		CRA = 0;
	
	// label term length
	//$("#TermLength").html(LoanTerm);

	if (DownPayment == "") { DownPayment = 0;}
	if (TaxRate == "") { TaxRate = 0;}
	
	// correct tax rate if user enters as a percent instead of a decimal.
	TaxRate = (TaxRate >= 1) ? TaxRate / 100 : 0;
	
	// calculate FullPrice (Labeled as "Contract Initial Total")
	var FullPrice = ( !isNaN(TotalPrice) ) ? parseFloat( TotalPrice - CustmerReserveAccount ) : 0;
	
	// calculate EachPayment
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
	
	// calculate tax
	var TaxPayment = Math.round((eval(EachPayment)) * TaxRate*100)/100;
	
	Month1 = (EachPayment + TaxPayment);
	Month1 = Month1 + LDWMonthly;
	TotalIntialPayment = Month1 * 2;
	CRA = ( $("#cra").val() < 1) ? 0 : $("#cra").val();
	TotalIntialPayment = TotalIntialPayment + DeliveryCharge + parseFloat(CRA);
	
	//the inputs
	$("#month1").val( Month1 * 2);
    $("#irp").val(dm(EachPayment*2));
	$("#ist").val(TaxPayment * 2); 	
	$("#ldw").val(dm(LDWMonthly*2));
	$("#cra").val(CRA);
	$("#dc").val(DeliveryCharge);
	$("#tip").val(TotalIntialPayment);
	$("#initial-pay-athorization").val(TotalIntialPayment);
	// end inputs

	// no cra row
	$("#payment-no-cra").text(dm(EachPayment)); 	
	$(".tax-cra").text(TaxPayment);
	$(".ldw-cra").text(dm(LDWMonthly));
	$("#no-ldw-total").text(dm(Month1));
	// end no cra row

	// yes cra row
	$("#payment-yes-cra").text(dm(EachPayment));
	$("#yes-ldw-total").text(dm(Month1));
	// yes cra row end

	// agree to terms row
	$("#ContractTotal").text( dm(EachPayment * LoanTerm)); 	
	$("#AgreeToTerms").text(LoanTerm);
	po = (TotalPrice / (EachPayment * LoanTerm)) * 100;
	$("#PayOff").text("%"+ Math.ceil(po));
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
    
function reCalulatePayment() {
    
    //example 1000
    var capturedExtraDownPayment = $("#original_initial_payment").val();
    
    if(capturedExtraDownPayment > $("#product_cash_price").val()) {
        
        showRecalcError("Down payment cannot be greater than cash price.",false);
        
        location.reload();
        
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
   // while( dp > 998 );
	
	cra = parseFloat( $("#cra").val() );

	if( (dp + mls) < capturedExtraDownPayment ) {
		 $("#cra").val((cra + .01).toFixed(2));
		 if($("#cra").val() < 0) {
			$("#cra").val(0);
		}
	} else if( (dp + mls) > capturedExtraDownPayment ) {
		$("#cra").val((cra - .01).toFixed(2));
	}
	else {
		$("#cra").val(cra);
	}
	calculate();
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
    
    $("#rto-terms").on('change',function() {
    	
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
    $("#original_initial_payment").on('change',function() {

        calculate();	
    });
    $("#original_initial_payment").on('keyup',function() {
		
		calculate();	
	});
	
	$("#product_delivery_charge").on("keyup", function () {

		calculate();

	});

   $("input[name='liability_damage_waver']").on('change', function() {
		
		calculate();

   }); 
   //calculate();
    
    $("#AdjDownPayment").on('click', function(event) { 
       
		event.preventDefault();

		var oip = ( $("#original_initial_payment").val() < 1 )  ? 0 : $("#original_initial_payment").val();
		
		$("#original_initial_payment").val(oip);
		
		reCalulatePayment(); 
        
    } );
}(jQuery));

