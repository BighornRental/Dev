
 <select name="company_id" id="company" class="form-control">
    @foreach($businesses AS $bus)
        <option value="{{$bus->id}}" >{{$bus->company_name}}</option>
    @endforeach
</select>