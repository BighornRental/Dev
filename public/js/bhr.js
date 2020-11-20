jQuery(function($) {

    function calc() { // this will capture the form data and return it to a function
        
        $.ajax({
            url: 'calculate',
            type: "POST",
            dataType: 'JSON',
            data: $("#contract-form").serialize(),
            success: function( response ) {
               console.log(response);
                $("#ContractTotal").text( response.FullPrice); 	
                $("#MonthlyPayment").val(response.EachPayment);
                $("#irp").val( response.IntialRentalPayment ) 	
                $("#ist").val(response.IntialTaxPayment); 	
                $("#Month1").val(response.FirstMonth); 	
                $("#MonthRest").val(response.MonthRest); 
                $("#AgreeToTerms").text(response.LoanTerm);
                $("#dc").val(response.DeliveryCharge);
                $("#ldw").val(response.LDWMonthly);	
                $("#tip").val(response.TotalIntialPayment);
                $("#payment-no-cra").text(response.EachPayment);
                $(".tax-cra").text(response.TaxPayment);
                $(".ldw-cra").text(response.LDWMonthly);
                $('#no-ldw-total').text(response.TotalIntialPayment);
            }
        });
    }

    $("#contract-form #product_cash_price").on("keyup" , function(event) {
        event.preventDefault();
        calc();
    });

    $("#contract-form #rto-terms").on('change', function(){
        calc();
    });

    $("#product_delivery_charge").on("keyup", function() {
        calc();
    });

    $("#product_sales_tax").on("keyup", function() {
        calc();
    })

    $("input[name='liability_damage_waver']").on("change", function(){
        calc();
    })

}(jQuery))