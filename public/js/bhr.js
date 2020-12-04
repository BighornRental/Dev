jQuery(function($) {

    // function calc() { // this will capture the form data and return it to a function
        
    //     $.ajax({
    //         url: 'calculate',
    //         type: "POST",
    //         dataType: 'JSON',
    //         data: $("#contract-form").serialize(),
    //         success: function( response ) {
    //            console.log(response);
    //             $("#ContractTotal").text( response.FullPrice); 	
    //             $("#MonthlyPayment").val(response.EachPayment);
    //             $("#irp").val( response.IntialRentalPayment ) 	
    //             $("#ist").val(response.IntialTaxPayment); 	
    //             $("#Month1").val(response.FirstMonth); 	
    //             $("#MonthRest").val(response.MonthRest); 
    //             $("#AgreeToTerms").text(response.LoanTerm);
    //             $("#dc").val(response.DeliveryCharge);
    //             $("#ldw").val(response.LDWMonthly);	
    //             $("#tip").val(response.TotalIntialPayment);
    //             $("#payment-no-cra").text(response.EachPayment);
    //             $(".tax-cra").text(response.TaxPayment);
    //             $(".ldw-cra").text(response.LDWMonthly);
    //             $('#no-ldw-total').text(response.TotalIntialPayment);
    //         }
    //     });
    // }

    // $("#contract-form #product_cash_price").on("keyup" , function(event) {
    //     event.preventDefault();
    //     calc();
    // });

    // $("#contract-form #rto-terms").on('change', function(){
    //     calc();
    // });

    // $("#product_delivery_charge").on("keyup", function() {
    //     calc();
    // });

    // $("#product_sales_tax").on("keyup", function() {
    //     calc();
    // })

    // $("input[name='liability_damage_waver']").on("change", function(){
    //     calc();
    // })

    $("#recurring-payment").on('click', function() {

            var bodyHeight = $('body').height(),
                top = $(this).offset();

            $("#modal").css({'height': bodyHeight,'padding-top': top.top}).fadeIn();
    });

    $("#modal-close").on("click", function() {

        $("#modal").fadeOut();
    });

    $("#paymentForm").on('submit', function(event) {

        event.preventDefault();

        var authData = {};
            authData.clientKey = "3rYC8fQmrtqNws9UUXgK8jKQ468hS8uA6y3E964E95WwbtBEM5F3TZ7jtLKT8yHy";
            authData.apiLoginID = "9B6aH2dq";
    
        var cardData = {};
            cardData.cardNumber = $("#cardNumber").val();
            cardData.month = $("#expMonth").val();
            cardData.year = $("#expYear").val();
            cardData.cardCode = $("#cardCode").val();
            cardData.fullName = $("#firstName").val() + " " + $("#lastName").val();

            var secureData = {};
            secureData.authData = authData;
            secureData.cardData = cardData;
            // If using banking information instead of card information,
            // send the bankData object instead of the cardData object.
            //
            // secureData.bankData = bankData;
       
            Accept.dispatchData(secureData, responseHandler);
    });

    function responseHandler(response) {
        if (response.messages.resultCode === "Error") {
            var i = 0;
            while (i < response.messages.message.length) {
                console.log(
                    response.messages.message[i].code + ": " +
                    response.messages.message[i].text
                );
                i = i + 1;
            }
        }
        else {
            paymentFormUpdate(response.opaqueData);
        }
    }

    function paymentFormUpdate(opaqueData) {
        $("#dataDescriptor").val(opaqueData.dataDescriptor);
        $("#dataValue").val(opaqueData.dataValue);

        $("#cardNumber").val('');
        $("#expMonth").val('');
        $("#expYear").val('');
        $("#cardCode").val('');
        $("#accountNumber").val('');
        $("#routingNumber").val('');
        $("#nameOnAccount").val('');
        $("#accountType").val('');

        $("#paymentForm").submit();
    }

}(jQuery))
