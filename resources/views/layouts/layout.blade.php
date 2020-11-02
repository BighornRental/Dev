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
        <link rel="stylesheet" id="tracker-css" href="/css/bhr.css?version=2.9" type="text/css" media="all" />
       
    </head>
    <body class="antialiased">
            <nav id="navbar">
            <ul>
                <li><a href="/"><img id="logo-branding" src="/img/Bighorn-Rental-Logo.png" rel="logo" height="80px" width="auto" alt="Bighorn Rental Logo" /></a></li>
                <li><a class="{{Request::is('/') ? 'current_page_link' : ''}}"" href="/">Home</a></li>
                @if(Auth::check()) 
                    <li><a class="{{Request::is('customers') ? 'current_page_link' : ''}}"" href="/customers">Customers</a></li>
                    <li><a class="{{Request::is('customers/create') ? 'current_page_link' : ''}}"" href="/customers/create">Create New Customer</a></li>
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
    <script>
        jQuery(document).ready( function($) {

                $("#original_initial_payment").on("focus", function() {

                    var price = $("#product_cash_price").val(),
                    terms = $("#rto-terms").val(),
                    monthlyPayments = price / terms,
                    initalPayment = monthlyPayments * 2,
                    original_initial_payment = 0,
                    cra = 0;  //cash reseve account
                            

                $("#original_initial_payment").on("keyup", function() {

                    original_initial_payment = $(this).val();
                    // decrease the payment monthlyPayments
                    // increase the CRA cra
                    // until these two equal total original_initial_payment
                    
                    if(original_initial_payment > initalPayment) { // we will not do anything until the oip is greater thant the ip

                        {{-- while((cra + monthlyPayments) < original_initial_payment) {

                            cra++;
                            monthlyPayments--;

                        } --}}
                        console.log(cra + monthlyPayments) < original_initial_payment);
                    }
                    
                });

            });

        });
    </script>
</html>