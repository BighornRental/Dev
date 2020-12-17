@extends('layouts.layout')

@section('content')
<div id="container">
        <h1>Bighorn Rental Customer</h1>
        <p><a href="{{url()->previous()}}}}">Back To Customers</a></p>
        <h2>{{$customer->first_name}} {{$customer->last_name}}</h2>
        <h3>Address:</h3>
        <p>{{$customer->address}}<br>
        {{$customer->city}}, {{$customer->state}} {{$customer->postal_code}}<br>
        {{$customer->county}} | {{$customer->country}}
        </p>
        <p><a href="tel:{{$customer->phone}}">{{$customer->phone}}</a> @if($customer->secondary_phone) | <a href="tel:{{$customer->secondary_phone}}">{{$customer->secondary_phone}}</a> @endif</p>
        <p><a href="mailto:{{$customer->email}}">{{$customer->email}}</a></p>
        <p><a class="std-btn" href="{{$customer->id}}/edit/">Edit</a> <a class="std-btn" id="delete-customer" href="{{$customer->id}}/delete/" rel="{{$customer->first_name}} {{$customer->last_name}}">Delete</a></p>

</div>
@endsection