<label for="product_material">Material:</label> 
                        
<div class="control">

    <select name="product_material" required>
        @foreach($materials AS $material)
            <option value="{{$material->material}}" {{ old('product_material') == $material->material || $slot == $material->material ? 'selected='.'"'.'selected'.'"' : ''   }}>{{$material->material}}</option>
        @endforeach
    </select>

</div>