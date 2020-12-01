<select name="company_id" id="companies" class="form-control" >
    @foreach($companines AS $company)
        <option value="{{$company->id}}">{{$company->name}}</option>
    @endforeach
</select>