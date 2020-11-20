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
		LDWMonthly = ($("input[name='ldw']:checked").val() == "accept") ? 8 : 0,
		DeliveryCharge = ($("#product_delivery_charge").val() > 0) ? $("#product_delivery_charge").val() : 0;
	
	
	// label term length
	//$("#TermLength").html(LoanTerm);

	if (DownPayment == "") { DownPayment = 0;}
	if (TaxRate == "") { TaxRate = 0;}
	
	// perform error checks
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
	var FullPrice = ( parseFloat(TotalPrice) + parseFloat(DeliveryCharge)) - DownPayment;
	
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
	var TaxPayment = dm(Math.round((eval(EachPayment)) * TaxRate*100)/100);
	
	// calculate total first months and total rest of the months
	//TotalDeposit = dm(Deposit + TaxDeposit);
	Month1 = dm(EachPayment + TaxPayment + DownPayment + LDWMonthly);
	MonthRest = dm( EachPayment + TaxPayment + LDWMonthly );
    
	// Set the values
	$("#ContractTotal").text( dm(FullPrice)); 	
	//$("#Deposit").val(dm(TotalDeposit));
    $("#MonthlyPayment").val(dm(EachPayment));
    $("#irp").val(dm(EachPayment*2)) 	
	$("#ist").val(dm(TaxPayment)); 	
	$("#Month1").val(dm(Month1)); 	
	$("#MonthRest").val(dm(MonthRest)); 
	$("#AgreeToTerms").text(LoanTerm);
	$("#ldw-monthly").val(LDWMonthly);	
	//document.RTO.TotalPaid.value = dm(TotalPaid);
    
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
        $("#DownPayment").val(dp.toFixed(2));
        
        calculate();
        
        //after calculations get values;
        
        dps = parseFloat( $("#DownPayment").val() );
        
        mls = parseFloat( $("#Month1").val() );
        
        // when we reach with a $1 we go to cents
        i = ((mls - 1) < capturedExtraDownPayment) ? .01 : 1;
        
    }
    
    while( mls > capturedExtraDownPayment );
    
    
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
		console.log('trying');
		$.get('calculate',function(repsonse) {
			console.log(repsonse);
		})
		//calculate();
			
    });
    $("#product_cash_price").on('keyup',function() {
		
		calculate();	
	});
	
    $("#product_sales_tax").on('change',function() {

        // correct tax rate field if user enters as a percent instead of a decimal.
        // don't do this on the keyup event.
        var TaxRate = $("#product_sales_tax").val();
        if (TaxRate >= 1) {
            TaxRate = TaxRate / 100;
            $("#product_sales_tax").val(TaxRate);
        }
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

   $("input[name='ldw']").on('change', function() {
		
		calculate();

   }); 
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

