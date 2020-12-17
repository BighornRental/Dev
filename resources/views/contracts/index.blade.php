@extends('layouts.layout')

@section('content')
<div id="container">
    <h1>Bighorn Rental Contracts</h1>
    <h2>For {{$customer->first_name ?? ''}} {{$customer->last_name ?? ''}}</h2>
    <div id="customer-list">
        <div class="customer-row row-head">
            <div style="flex-basis:12%">Contract Number</div>
            <div style="flex-basis:12%">Created On</div>
            <div style="flex-basis:16%">Building</div>
            <div style="flex-basis:8%">View/Edit</div>
            <div style="flex-basis:6%">Sign</div>
            <div style="flex-basis:10%">Email</div>
            <div style="flex-basis:11%">Recurring Payment</div>
            <div style="flex-basis:11%">Initial Payment</div>
            <div style="flex-basis:12%">Delete</div>
        </div>
        @foreach($contracts AS $contract)
        <div class="customer-row">
            <div style="flex-basis:12%">{{$contract->contract_number}}</div>
            <div style="flex-basis:12%">{{date_format($contract->created_at,'M dS, Y')}}</div>
            <div style="flex-basis:16%">{{$contract->product_style}}</div>
            <div style="flex-basis:8%"><a href="/contracts/{{$contract->id}}/edit"">View/Edit</a></div>
            <div style="flex-basis:6%">
                @if($contract->signed == 0)
                        <a href="signPDF/{{$contract->id}}">Sign</a>
                @else
                        &check; Signed
                @endif
            </div>
            <div style="flex-basis:10%">
                @if($contract->signed == 0)
                        <a href="mailPDF/{{$contract->id}}">Email Contract</a>
                @else
                        &check; Signed
                @endif
            </div>
            <div style="flex-basis:11%">
                @if($contract->recurring_payment == 0)
                        No
                @else
                       &check; Yes
                @endif
            </div>
            <div style="flex-basis:11%">
                @if($contract->initial_payment_made == 0)
                        Make Payment
                @else
                        &check; Paid
                @endif
            </div>
            <div class="delete-contract" style="flex-basis:12%"><a href="/contracts/{{$contract->id}}/delete">Delete</a></div>
        </div>
        @endforeach
    </div>
</div>
@endsection