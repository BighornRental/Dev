@extends('layouts.layout')

@section('content')
<div id="container">
        <h1>Contracts</h1>
        <ul>
        {{$allContracts->count()}}
                @foreach($allContracts AS $contract)
        <h1>This</h1>
                        {{$contract}}

                @endforeach
        </ul>
       </div>
</div>
@endsection