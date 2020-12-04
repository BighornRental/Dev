<?php
use App\Models\Contracts;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bighorn Rental</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,900;1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" id="tracker-css" href="/css/bhr.css?version=3.9" type="text/css" media="all" />
       
    </head>
    <body class="antialiased">
            <nav id="navbar">
            
            <ul>
                <li><a href="/"><img id="logo-branding" src="/img/Bighorn-Rental-Logo.png" rel="logo" height="80px" width="auto" v-align="top" alt="Bighorn Rental Logo" /></a> {{\Auth::user()->name ?? ''}}</li>
                <li><a class="{{Request::is('/') ? 'current_page_link' : ''}}"" href="/">Home</a></li>
                @if(Auth::check()) 
                    <li><a class="{{Request::is('customers/create') ? 'current_page_link' : ''}}"" href="/customers/create">Create New Customer</a></li>
                    <li><a class="{{Request::is('customers') ? 'current_page_link' : ''}}"" href="/customers">Customers</a></li>
                    <li><a href="/home/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a></li>
                    <form id="logout-form" action="/logout" method="POST" class="d-none">
                    @csrf
                    </form>
                @else 
                    <li><a class="{{Request::is('login') ? 'current_page_link' : ''}}" href="/login">Login</a></li>
                @endif
            <ul>
            </nav>
            @yield('content')

    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/js/calculator.js?version=3.8"></script>
    <script src="/js/bhr.js?version=0.2"></script>
    @if(url()->current() == env('APP_URL'). 'contracts/create')
        <script type="text/javascript"
            src="https://jstest.authorize.net/v3/AcceptUI.js"
            charset="utf-8"></script>
        <script type="text/javascript"
            src="https://jstest.authorize.net/v3/AcceptUI.js"
            charset="utf-8">
        </script>



        <script type="text/javascript">
        function responseHandler(response) {
            console.log(response);
            if (response.messages.resultCode === "Error") {
                var i = 0;
                while (i < response.messages.message.length) {
                    console.log(
                        response.messages.message[i].code + ": " +
                        response.messages.message[i].text
                    );
                    i = i + 1;
                }
            } else {
                paymentFormUpdate(response.opaqueData);
            }
        }


        function paymentFormUpdate(opaqueData) {
            document.getElementById("dataDescriptor").value = opaqueData.dataDescriptor;
            document.getElementById("dataValue").value = opaqueData.dataValue;

            // If using your own form to collect the sensitive data from the customer,
            // blank out the fields before submitting them to your server.
            // document.getElementById("cardNumber").value = "";
            // document.getElementById("expMonth").value = "";
            // document.getElementById("expYear").value = "";
            // document.getElementById("cardCode").value = "";

            document.getElementById("paymentForm").submit();
        }
        </script>
    @endif

</html>