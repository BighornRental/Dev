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
        <link rel="stylesheet" id="tracker-css" href="/css/bhr.css?version=1.7" type="text/css" media="all" />
       
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
    <script src="/js/bhr.js?version=0.4"></script>
    <script src="/js/calculator.js?version=4.7"></script>
    @if(isset($customer->id) AND url()->current() == env('APP_URL').'contracts/'.$customer->id.'/create')
        {{-- <script type="text/javascript" src="https://jstest.authorize.net/v1/Accept.js" charset="utf-8"></script> --}}
        {{-- <script type="text/javascript" src="https://jstest.authorize.net/v3/AcceptUI.js" charset="utf-8"></script> --}}
    @endif

</html>