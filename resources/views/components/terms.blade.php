<label for="rto-terms">RTO Terms:</label> 
                        
<div class="control">

    <select name="rto_terms" id="rto_terms" required>
        @foreach($terms AS $term)
            <option value="{{$term->term_limits}}" {{ old('rto_terms') == $term->term_limits || $slot == $term->term_limits ? 'selected='.'"'.'selected'.'"' : ''   }}>{{$term->term_limits}}</option>
        @endforeach
    </select>

    @error('rto_terms')
        <p class="help is-danger">{{ $errors->first('rto_terms') }}</p>
    @enderror

</div>