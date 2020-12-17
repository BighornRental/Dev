
<label for="{{$name}}">{{$label}}:</label>
<select name="{{$name}}" id="{{$name}}" required>
    <option value="">Select State</option>
    @foreach($states AS $state)
        <option value="{{$state->state_abbrev}}" {{ old('shipping_state') == $state->state_abbrev || $slot ==  $state->state_abbrev ? 'selected='.'"'.'selected'.'"' : ''   }}>{{$state->states_name}}</option>
    @endforeach
</select>

@error('shipping_state')
    <p class="help is-danger">{{ $errors->first('shipping_state') }}</p>
@enderror