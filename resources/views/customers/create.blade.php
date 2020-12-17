@extends('layouts.layout')

@section('content')
<div id="container">
<h1>Create Customer</h1>

<form method="POST" action="/customers">
@csrf
 <input type="hidden" name="user_id" value="{{\Auth::user()->id}}" />
<div class="field">

    <label for="first_name">First Name:</label>

    <div class="control">

        <input @error('first_name') class="is-danger" @enderror type="text" id="first_name" name="first_name" value="{{old('first_name')}}" required />

        @error('first_name')
            <p class="help is-danger">{{ $errors->first('first_name') }}</p>
        @enderror
    </div>

</div>
<div class="field">
    
    <label for="last_name">Last Name:</label>
    
        <div class="control">

            <input @error('last_name') class="is-danger" @enderror type="text" id="last_name" name="last_name" value="{{old('last_name')}}" required />

            @error('last_name')
                <p class="help is-danger">{{ $errors->first('last_name') }}</p>
            @enderror

        </div>
</div>
<div class="field">

    <label for="address">Address:</label>
    
    <div class="control">

        <input @error('address') class="is-danger" @enderror type="text" id="address" name="address"  value="{{old('address')}}" required />

        @error('address')
            <p class="help is-danger">{{ $errors->first('address') }}</p>
        @enderror

    </div>

</div>
<div class="field">

    <label for="city">City:</label>

    <div class="control">

        <input @error('city') class="is-danger" @enderror type="text" id="city" name="city" value="{{old('city')}}" required />

        @error('city')
            <p class="help is-danger">{{ $errors->first('city') }}</p>
        @enderror

    </div>

</div>
<div class="field">

    <label for='state'>State:</label>

    <div class="control">

        <input @error('state') class="is-danger" @enderror type="text" id="state" name="state" value="{{old('state')}}" required />

        @error('state')
            <p class="help is-danger">{{ $errors->first('state') }}</p>
        @enderror

    </div>

</div>
<div class="field">

    <label for="postal_code">Postal Code:</label> 
    
    <div class="control">

        <input @error('postal_code') class="is-danger" @enderror type="text" id="postal_code" name="postal_code" value="{{old('postal_code')}}" required />

        @error('postal_code')
            <p class="help is-danger">{{ $errors->first('postal_code') }}</p>
        @enderror

    </div>

</div>
<div class="field">

    <label for="county">County:</label> 
    
    <div class="control">

        <input @error('county') class="is-danger" @enderror type="text" id="county" name="county" value="{{old('county')}}" required />

        @error('county')
            <p class="help is-danger">{{ $errors->first('county') }}</p>
        @enderror

    </div>

</div>
<div class="field">

    <label for="country" class="options-label">Country</label>
    
    <div class="control">

        <select id="country" name="country" required >
            <option value="USA">USA</option>
            <option value="CAN">CANADA</option>
        </select>

    </div>
</div>
<div class="field">

    <label for="phone">phone:</label> 

    <div class="control">

        <input @error('phone') class="is-danger" @enderror type="phone" id="phone" name="phone"  value="{{old('phone')}}" required placeholder="000-000-0000" />

         @error('phone')
            <p class="help is-danger">{{ $errors->first('phone') }}</p>
        @enderror

    </div>
</div>
<div class="field">

    <label for="secondary_phone">Secondary Phone:</label> 
    
    <div class="control">

        <input type="phone" id="secondary_phone" name="secondary_phone" value="{{old('secondary_phone')}}" />

    </div>

</div>
<div class="field">

    <label for="email">Email:</label> 
    
    <div class="control">

        <input @error('email') class="is-danger" @enderror type="email" id="email" name="email" value="{{old('email')}}" required placeholder="user@domain.com" />

        @error('email')
            <p class="help is-danger">{{ $errors->first('email') }}</p>
        @enderror

    </div>

</div>
<div class="field">

    <div class="control">

        <button type="submit">Submit</button>

    </div>

</div>
</form>
</div>
@endsection