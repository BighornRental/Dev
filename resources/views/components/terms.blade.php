<label for="rto-terms">RTO Terms:</label> 
                        
<div class="control">

    <select name="rto-terms" id="rto-terms">
        @foreach($terms AS $term)
            <option value="{{$term->term_limits}}">{{$term->term_limits}}</option>
        @endforeach
    </select>

</div>