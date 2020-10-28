@extends('layouts.layout')

@section('content')
        <h1>Welcome to Bighorn Rental | Customers</h1>
        <ul>
           <li>Name: {{$customer->first_name}} <a href="../customers/{{$customer->id}}/edit">EDIT</a></li>
        </ul>
        </div>
    </body>
</html>
@endsection