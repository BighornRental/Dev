<label for=initial-payment-type">Initial Payment Type</label>
<select name="initial_payment_type" id="initial-payment-type" required>
    <option value="">Select Type</option>
    @foreach($paymentType AS $payment) 
        <option value="{{$payment->type}}"" {{ old('initial_payment_type') == $payment->type || $slot == $payment->type ? 'selected' : ''   }}>{{$payment->type}}</option>
    @endforeach
</select>
