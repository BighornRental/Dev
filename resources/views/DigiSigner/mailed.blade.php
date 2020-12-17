@extends('layouts.layout')

@section('content')
<div id="container">
    <h3>Contract Has Been Emailed.</h3>
    <p>This contract has been mailed to {{$contract->customer_name}} at {{$contract->email}}</p>
    <p><a class="std-btn" href='/customers'>Return To Customers</a> <a class="std-btn" href='/contracts/{{$contract->customers_id}}'>Return To Contracts</a></p>
</div>
@endsection