@extends('layouts.layout')

@section('content')
<div id="container">
    <h1>Bighorn Rental Customers</h1>
    <p>{{$customers->links()}}</p>
    <div id="customer-list">
        <div class="customer-row row-head">
            <div style="flex-basis:20%">Customer Name</div>
            <div style="flex-basis:30%">Email</div>
            <div style="flex-basis:25%">Phone</div>
            <div style="flex-basis:10%">View Contracts</div>
            <div style="flex-basis:15%">Create Contracts</div>
        </div>
        @foreach($customers AS $customer)
        <div class="customer-row">
            <div style="flex-basis:20%"><a href="/customers/{{$customer->id}}">{{$customer->first_name}}</a></div>
            <div style="flex-basis:30%">{{$customer->email}}</div>
            <div style="flex-basis:25%">{{$customer->phone}}</div>
            <div style="flex-basis:10%" align="center"><a class="circle-btn" href="\contracts\{{$customer->id}}" title="Click To See Contracts">{{ App\Models\Contracts::where('customers_id', '=',$customer->id)->count()}}</a></div>
            <div style="flex-basis:15%"><a href="/contracts/{{$customer->id}}/create">Create Contract</a></div>
        </div>
        @endforeach
    </div>
    <p>{{$customers->links()}}</p>
</div>
@endsection