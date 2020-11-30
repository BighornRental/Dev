<label for="rto-terms">RTO Terms:</label> 
                        
<div class="control">

    <select name="rto-terms" id="rto-terms">
        @foreach($terms AS $term)
        {{$selected = ($term->term_limits == 36) ? 'selected' : ''}}
            <option value="{{$term->term_limits}}" {{$selected}}>{{$term->term_limits}}</option>
        @endforeach
    </select>

</div>