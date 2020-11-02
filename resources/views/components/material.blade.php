<label for="product_material">Material:</label> 
                        
<div class="control">

    <select name="product_material">
        @foreach($materials AS $material)
            <option value="{{$material->material}}">{{$material->material}}</option>
        @endforeach
    </select>

</div>