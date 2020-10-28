@extends('layouts.layout')

@section('content')
        <h1>Welcome to Bighorn Rental</h1>
        <ul>
            @foreach($customers AS $customer)
            <li>Name: <a href="/customers/{{$customer->id}}">{{$customer->first_name}}</a></li>
            @endforeach
        </ul>
        </div>
    </body>
</html>
@endsection