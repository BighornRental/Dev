<label for=initial-payment-type">Initial Payment Type</label>
<select name="initial-payment-type" id="initial-payment-type">
    <option value="">Select Type</option>
    @foreach($paymentType AS $payment) 
        <option value="{{$payment->id}}">{{$payment->type}}</option>
    @endforeach
</select>
