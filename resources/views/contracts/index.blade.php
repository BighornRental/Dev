@extends('layouts.layout')

@section('content')
<div id="container">
    <h1>Bighorn Rental Contracts</h1>
    <h2>For {{$customer->first_name}} {{$customer->last_name}}</h2>
    <div id="customer-list">
        <div class="customer-row row-head">
            <div style="flex-basis:14%">Contract Number</div>
            <div style="flex-basis:14%">Created On</div>
            <div style="flex-basis:14%">View/Edit</div>
            <div style="flex-basis:14%">Sign</div>
            <div style="flex-basis:16%">Email</div>
            <div style="flex-basis:14%">Initial Payment</div>
            <div style="flex-basis:14%">Delete</div>
        </div>
        @foreach($contracts AS $contract)
        <div class="customer-row">
            <div style="flex-basis:14%">{{$contract->contract_number}}</div>
            <div style="flex-basis:14%">{{date_format($contract->created_at,'M dS, Y')}}</div>
            <div style="flex-basis:14%"><a href="/contracts/{{$contract->id}}/edit"">View/Edit</a></div>
            <div style="flex-basis:14%">
                @if($contract->signed == 0)
                        Sign
                @else
                        Signed
                @endif
            </div>
            <div style="flex-basis:16%">Send Email</div>
            <div style="flex-basis:14%">
                @if($contract->intial_payment == 0)
                        Sign
                @else
                        Signed
                @endif
            </div>
            <div style="flex-basis:14%"><a href="/contracts/{{$contract->id}}/delete">Delete</a></div>
        </div>
        @endforeach
    </div>
</div>
@endsection