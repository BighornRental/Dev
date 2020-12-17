jQuery(function($) {

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

    $("#delete-customer").on("click", function(event) {

        var customer = $(this).attr("rel"),
            response = window.confirm("Are you sure you want to delete customer "+customer+"?");
        
        if(response) {

            return true;
        }
        else {
            return false;
        }
    })

    $(".delete-contract").on("click", function(event) {

        var response = window.confirm("Are you sure you want to delete this contract?");
        
        if(response) {

            return true;
        }
        else {
            return false;
        }
    })
    

}(jQuery))
