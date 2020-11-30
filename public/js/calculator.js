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
		CustmerReserveAccount = ( $("#cra").val() > 0) ?  $("#cra").val() : 0;
	
	// label term length
	$("#AgreeToTerms").text(LoanTerm);
	
	//perform error checks
	// isError = 0;
	// $("#product_cash_price").removeClass("error");
	// if (IsNumeric(TotalPrice) == false) { 
	// 	error("#product_cash_price");
	// }
	// $("#product_sales_tax").removeClass("error");
	// if (IsNumeric(TaxRate) == false) { 
	// 	error("#product_sales_tax");
	// }	
	// $("#original_initial_payment").removeClass("error");
	// if (IsNumeric(DownPayment) == false) { 
	// 	console.log('original price error')
	// 	error("#original_initial_payment");
	// }
	// if (isError == 1) {
	// 	return;	
	// }
	
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

	// calculate Deposit
	// var Deposit = 0;
	// if (EachPayment < 25) { 
	// 	// min $25 deposit
	// 	Deposit = 25;
	// } else {
	// 	// Deposit is 1 full payment
	// 	Deposit = EachPayment;
	// }	
	
	// calculate tax
	//var TaxDeposit = dm(Math.round((eval(Deposit)) * TaxRate*100)/100);
	var TaxPayment = Math.round((eval(EachPayment)) * TaxRate*100)/100;
	
	// calculate total first months and total rest of the months
	//TotalDeposit = dm(Deposit + TaxDeposit);
	Month1 = (EachPayment + TaxPayment);
	Month1 = Month1 + LDWMonthly;
	//Month1 = Month1;
	TotalCharge = Month1 * 2;
	TotalCharge = TotalCharge + DeliveryCharge + parseFloat( $("#cra").val() );
	//MonthRest = dm( EachPayment + TaxPayment + LDWMonthly );
	// Set the values
	//the inputs
	$("#month1").val( (EachPayment + TaxPayment) * 2);
    $("#irp").val(dm(EachPayment*2));
	$("#ist").val(dm(TaxPayment*2)); 	
	$("#ldw").val(dm(LDWMonthly*2));
	$("#dc").val(DeliveryCharge);
	$("#tip").val(dm(TotalCharge));
	// end inputs

	// no cra row
	$("#payment-no-cra").text(dm(EachPayment)); 	
	$(".tax-cra").text(TaxPayment);
	$(".ldw-cra").text(dm(LDWMonthly));
	$("#no-ldw-total").text(dm(Month1));
	// end no cra row

	// yes cra row
	$("#payment-yes-cra").text(dm(EachPayment));
	$("#yes-ldw-total").text(dm(EachPayment));
	// yes cra row end

	// agree to terms row
	$("#ContractTotal").text( dm(EachPayment * LoanTerm)); 	
	$("#AgreeToTerms").text(LoanTerm);
	$("#PayOff").text();
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
function IsNumeric(val) {

	return !isNaN(parseFloat(val)) && isFinite(val);
	
}
    
function reCalulatePayment() {
    
    //example 1000
    var capturedExtraDownPayment = parseFloat($("#original_initial_payment").val());
	
    if(capturedExtraDownPayment > parseFloat( $("#product_cash_price").val() )) {

		alert("The down payment cannot be large than the total price.");
		
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
        $("#cra").val(dp.toFixed(2));
        
        calculate();
        
        //after calculations get values;
        
        //dps = parseFloat( $("#original_initial_payment").val() );
        
        mls = parseFloat( $("#month1").val() );
        // when we reach with a $1 we go to cents
        i = ((dp + mls) - 1  < capturedExtraDownPayment) ? .01 : 1;
        
    }
	
	while( (dp + mls) > capturedExtraDownPayment);
    //while( mls < capturedExtraDownPayment );
	
	cra = parseFloat( $("#cra").val() );

	if( (dp + mls) < capturedExtraDownPayment ) {
		 $("#cra").val((cra + .01).toFixed(2));
	} else if( (dp + mls) < capturedExtraDownPayment ) {
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
		// console.log('trying');
		// $.get('calculate',function(repsonse) {
		// 	console.log(repsonse);
		// })
		//calculate();
			
	});
	$("#product_cash_price").on("focus", function(){
		if($(this).val() == '0.00') {
			$(this).val('');
		}
	})
	$("#product_cash_price").on("blur", function(){
		if( $(this).val() < 1 ) {
			$(this).val('0.00');
		}
	})
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
	
	$("#product_delivery_charge").on("keyup", function () {

		calculate();

	});

   $("input[name='ldw']").on('change', function() {
		
		calculate();

   }); 

   $("input[name='liability_damage_waver']").on("change", calculate )

   //calculate();
    
    $("#AdjDownPayment").on('click', function(event) { 
       
		event.preventDefault();

        if($("#original_initial_payment").val() > 0 ) {
            
            reCalulatePayment(); 
        }
		else {
			alert("Please Enter An Initial Downpayment.");
		}
    } );
}(jQuery));

