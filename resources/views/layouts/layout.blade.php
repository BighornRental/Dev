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
        <link rel="stylesheet" id="tracker-css" href="/css/bhr.css?version=3.5" type="text/css" media="all" />
       
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
    @if(url()->current() == 'https://com.bighornrental:8890/contracts/create')
        <script src="/js/bhr.js?version=3.4"></script>
    @endif
</html>