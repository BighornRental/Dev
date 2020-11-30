@extends('layouts.layout')

@section('content')
<div id="container">
    <h1>Create Contract</h1>
    <form method="POST" name="contract-form" id="contract-form" action="/contracts">
        @csrf
        <section class="form-section" id="contract_info">
            <h3>Contract Information</h3>
            <div class="inner-section">
                <div class="form-row">

                    <div class="field">

                        <label for="dealer">Dealer:</label>

                        <div class="control">

                            <input type="text" id="dealer" name="dealer" value="" disabled />

                        </div>

                    </div>
                    <div class="field">
                        
                        <label for="contract_number">Contract Number:</label>
                        
                            <div class="control">

                                <input type="text" id="contract_number" name="contract_number" value="" disabled />


                            </div>
                    </div>
                </div>
            
                <div class="form-row">

                    <div class="field">

                        <label for="sales_person">Sales Person:</label>
                        
                        <div class="control">

                            <input @error('sales_person') class="is-danger" @enderror type="text" id="sales_person" name="sales_person"  value="{{old('sales_person')}}"  />

                            @error('address')
                                <p class="help is-danger">{{ $errors->first('sales_person') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="contract_state">Contract State:</label>
                        
                        <div class="control">

                            <input type="text" id="contract_state" name="contract_state"  value="{{old('contract_state')}}" disabled />

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="customer_info">
            <h3>Customer Information</h3>
            <div class="inner-section">
                <div class="form-row">

                    <div class="field">

                        <label for="customer_name">Customer Name:</label>

                        <div class="control">

                            <input type="text" id="customer_name" name="customer_name" value="" disabled />

                        </div>

                    </div>

                    <div class="field">

                        <label for="email">Email:</label> 

                        <div class="control">

                            <input @error('email') class="is-danger" @enderror type="phone" id="email" name="email"  value="{{old('email')}}"  placeholder="user@domain.com" />

                            @error('email')
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @enderror

                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for='phone'>Customer Phone:</label>

                        <div class="control">

                            <input @error('phone') class="is-danger" @enderror type="text" id="phone" name="phone" value="{{old('phone')}}"  placeholder="000-000-0000" />

                            @error('phone')
                                <p class="help is-danger">{{ $errors->first('phone') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="secondary_phone">Secondary Phone:</label> 
                        
                        <div class="control">

                            <input type="phone" id="secondary_phone" name="secondary_phone" value="{{old('secondary_phone')}}" />

                        </div>

                    </div>  
                </div>
            </div>
        </section>
        <section class="form-section"  id="shipping_address">
            <h3>Shipping Information</h3>
            <div class="inner-section">
                <div class="field">

                    <label for="shipping_address">Address:</label> 
                    
                    <div class="control">

                        <input @error('shipping_address') class="is-danger" @enderror type="text" id="shipping_address" name="shipping_address" value="{{old('shipping_address')}}"  />

                        @error('shipping_address')
                            <p class="help is-danger">{{ $errors->first('shipping_address') }}</p>
                        @enderror

                    </div>

                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_city">Shipping City:</label> 
                        
                        <div class="control">

                            <input @error('shipping_city') class="is-danger" @enderror type="text" id="shipping_city" name="shipping_city" value="{{old('shipping_city')}}"  />

                            @error('shipping_city')
                                <p class="help is-danger">{{ $errors->first('shipping_city') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="shipping_state">Shipping State:</label> 
                        
                        <div class="control">
                            <select name="shipping_state" >
                                <option value="">Select State</option>
                                <option value="ID">Idaho</option>
                                <option value="MT">Montana</option>
                                <option value="ND">North Dakota</option>
                                <option value="OR">Oregon</option>
                                <option value="WA">Washington</option>
                            </select>

                            @error('shipping_state')
                                <p class="help is-danger">{{ $errors->first('shipping_state') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_county">Shipping County:</label> 
                        
                        <div class="control">

                            <input @error('shipping_county') class="is-danger" @enderror type="text" id="shipping_county" name="shipping_county" value="{{old('shipping_county')}}"  />

                            @error('shipping_county')
                                <p class="help is-danger">{{ $errors->first('shipping_county') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="shipping_country">Shipping Country:</label> 
                        
                        <div class="control">
                            <select name="shipping_country" >
                                <option value="USA">United States</option>
                            </select>

                            @error('shipping_country')
                                <p class="help is-danger">{{ $errors->first('shipping_country') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Reference</h3>
            <div class="inner-section">
                <div class="form-row">

                    <div class="field">

                        <label for="reference_name">Reference Name:</label> 
                        
                        <div class="control">

                            <input @error('reference_name') class="is-danger" @enderror type="text" id="reference_name" name="reference_name" value="{{old('reference_name')}}"  />

                            @error('reference_name')
                                <p class="help is-danger">{{ $errors->first('reference_name') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="reference_phone">Reference Phone:</label> 
                        
                        <div class="control">

                            <input @error('reference_phone') class="is-danger" @enderror type="phone" id="reference_phone" name="reference_phone" value="{{old('reference_phone')}}"  placeholder="000-000-0000" />

                            @error('reference_phone')
                                <p class="help is-danger">{{ $errors->first('reference_phone') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="production_information">
            <h3>Production Information</h3>
            <div class="inner-section">
                <div class="form-row">

                    <div class="field">

                        <label for="product_size">Buidling Size:</label> 
                        
                        <div class="control">

                            <input @error('product_size') class="is-danger" @enderror type="text" id="product_size" name="product_size" value="{{old('product_size')}}"  placeholder="WxL (8x10)" />

                            @error('product_size')
                                <p class="help is-danger">{{ $errors->first('product_size   ') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_style">Buiding Style:</label> 
                        
                        <div class="control">

                            <input @error('product_style') class="is-danger" @enderror type="phone" id="product_style" name="product_style" value="{{old('product_size')}}"  />

                            @error('product_style')
                                <p class="help is-danger">{{ $errors->first('product_style') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for="product_side_color">Siding Color:</label> 
                        
                        <div class="control">

                            <input @error('product_side_color') class="is-danger" @enderror type="text" id="product_side_color" name="product_side_color" value="{{old('product_side_color')}}"  />

                            @error('product_side_color')
                                <p class="help is-danger">{{ $errors->first('product_side_color') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_trim_color">Trim Color:</label> 
                        
                        <div class="product_trim_color">

                            <input @error('product_trim_color') class="is-danger" @enderror type="phone" id="product_trim_color" name="product_trim_color" value="{{old('product_trim_color')}}"  />

                            @error('product_trim_color')
                                <p class="help is-danger">{{ $errors->first('product_trim_color') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for="product_roof_color">Roof Color:</label> 
                        
                        <div class="control">

                            <input @error('product_roof_color') class="is-danger" @enderror type="text" id="product_roof_color" name="product_roof_color" value="{{old('product_roof_color')}}"  />

                            @error('product_roof_color')
                                <p class="help is-danger">{{ $errors->first('product_roof_color') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_roof_material">Roofing Material:</label> 
                        
                        <div class="product_roof_material">

                            <input @error('product_trim_color') class="is-danger" @enderror type="phone" id="product_roof_material" name="product_roof_material" value="{{old('product_roof_material')}}"  />

                            @error('product_roof_material')
                                <p class="help is-danger">{{ $errors->first('product_roof_material') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <x-material />

                    </div>

                    <div class="field">

                        <label for="product_serial_number">Product Serial Number:</label> 
                        
                        <div class="product_serial_number">

                            <input @error('product_serial_number') class="is-danger" @enderror type="text" id="product_serial_number" name="product_serial_number" value="{{old('product_serial_number')}}"  />

                            @error('product_serial_number')
                                <p class="help is-danger">{{ $errors->first('product_serial_number') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">
                        
                        <div class="control radio-control">

                            <label class="input-container">New Condition:
                                <input type="radio" name="product_condition" id="condition-new" value="new" />
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        <div class="control radio-control">

                            <label class="input-container">Use Condition:
                                <input type="radio" name="product_condition" id="condition-used" value="used" />
                                <span class="checkmark cm-round"></span>
                            </label>

                        </div>

                    </div>

                    <div class="field">

                        <x-terms />

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for="product_cash_price">Cash Price:</label> 
                        
                        <div class="control">

                            <div class="input-group">
                                <span class="label-sufix">$</span>
                                    <input @error('product_cash_price') class="is-danger" @enderror type="text" id="product_cash_price" name="product_cash_price" value="{{old('product_cash_price', '0.00')}}"  />
                            </div>
                            @error('product_cash_price')
                                <p class="help is-danger">{{ $errors->first('product_cash_price') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_sales_tax">Sales Tax:</label> 
                        
                        <div class="product_sales_tax">
                            <div class="input-group">
                                <span class="label-sufix">%</span>
                                    <input @error('product_sales_tax') class="is-danger" @enderror type="text" id="product_sales_tax" name="product_sales_tax" value="{{old('product_trim_color')}}"  />
                            </div>
                            @error('product_sales_tax')
                                <p class="help is-danger">{{ $errors->first('product_sales_tax') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for="product_delivery_charge">Delivery Charge:</label> 
                        
                        <div class="control">
                            <div class="input-group">
                                <span class="label-sufix">$</span>
                                <input @error('product_delivery_charge') class="is-danger" @enderror type="text" id="product_delivery_charge" name="product_delivery_charge" value="{{old('product_delivery_charge')}}" />
                            </div>
                            @error('product_delivery_charge')
                                <p class="help is-danger">{{ $errors->first('product_delivery_charge') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="delivery_date">Estimated Delivery Date:</label> 
                        
                        <div class="delivery_date">

                            <input @error('delivery_date') class="is-danger" @enderror type="date" id="delivery_date" name="delivery_date" value="{{old('delivery_date')}}" />

                            @error('delivery_date')
                                <p class="help is-danger">{{ $errors->first('delivery_date') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Liability Damage Waver “LDW”</h3>
            <div class="inner-section">

                <div class="form-row">

                    <div class="field">
                        
                        <div class="control radio-control">

                            <label class="input-container">Accept:
                                <input type="radio" name="liability_damage_waver" id="accept" value="accept" />
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        <div class="control radio-control">

                            <label  class="input-container">Decline:
                                <input type="radio" name="liability_damage_waver" id="decline" value="decline" />
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                    </div>

                    <div class="field">

                        <label for="ldw-monthly">this coverage (monthly):</label> 
                        
                        <div class="control">

                            <div class="input-group">
                                <span class="label-sufix">$</span>
                                    <input @error('ldw-monthly') class="is-danger" @enderror type="text" id="ldw-monthly" name="ldw-monthly" value="{{old('ldw-monthly')}}" disabled />
                            </div>
                            @error('ldw-monthly')
                                <p class="help is-danger">{{ $errors->first('ldw-monthly') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Customer Reserve Account (OPTIONAL)</h3>
            <div class="inner-section">
                <div class="form-row">
                    <div class="field">
                    <label for="original_initial_payment">Enter Down Payment: </label> 
                    <div class="control">
                    <input type="text" name="original_initial_payment" id="original_initial_payment" /> 
                    </div>
                    </div>
    
                    <div class="field">
                    <label for="AdjDownPayment">Recacluate Payments: </label>
                    <div class="control">
                    <button value="Recacluate" id="AdjDownPayment" name="AdjDownPayment">Recacluate</button>
                    </div>
                     </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Rental Payment</h3>
            <div class="inner-section">
                <div class="form-row">
                    <p>The monthly rental payment without CRA is  $<span id="payment-no-cra">0.00</span> plus a monthly sales tax of  $<span class="tax-cra">0.00</span> plus optional Liability Damage Waiver fee of   $<span class="ldw-cra">0.00</span> for a total of  $<span id="no-ldw-total">0.00</span></p>
                </div>
            <div class="form-row">
                    <p>The monthly rental payment with CRA is  $<span id="payment-yes-cra">0.00</span> plus a monthly sales tax of  $<span class="tax-cra">0.00</span> plus optional Liability Damage Waiver fee of  $<span class="ldw-cra">0.00</span> for a total of  $<span id="yes-ldw-total">0.00</span></p>
            </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Intial Payments</h3>
            <div class="inner-section">
                <div class="form-row">
                <input type="hidden" name="month1" id="month1" />
                <ol>
                    <li><label>Initial Rental Payment (2 Months): <input type="text" name="irp" id="irp" /></label></li>
                    <li><label>Initial Sales Tax <input type="text" name="ist" id="ist" /></label></li>
                    <li><label>Liability Damage Waiver <input type="text" name="ldw" id="ldw" /></label></li>
                    <li><label>Customer Reserve Account <input type="number" name="cra" id="cra" /></label></li>
                    <li><label>Delivery Charge <input type="text" name="dc" id="dc" /></label></li>
                    <li><label>Total Initial Payment <input type="text" name="tip" id="tip" /></label></li>
                </ol>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Rental Purchasse Ownership</h3>
            <div class="inner-section">
                 <div class="form-row">
                    <p>At <span id="AgreeToTerms"></span> monthly rental payments, we will apply any balance in the CRA, plus tax, and you will own the property. You will have paid a Total Cost of $<span id="ContractTotal">0.00</span> not including LDW or tax. At any time you can do an early payoff by paying <span id="PayOff"></span> of the remaining payments plus tax for ownership.
                    </p>
                 </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Initial Payment Authorization</h3>
            <div class="inner-section">
                <div class="form-row">
                    <div class="field">

                            <label for="initial-pay-athorization">Initial Payment:</label> 
                            
                            <div class="control">

                                <div class="input-group">
                                    <span class="label-sufix">$</span>
                                        <input @error('initial-pay-athorization') class="is-danger" @enderror type="text" id="initial-pay-athorization" name="initial-pay-athorization" value="{{old('initial-pay-athorization')}}" />
                                </div>
                                @error('initial-pay-athorization')
                                    <p class="help is-danger">{{ $errors->first('initial-pay-athorization') }}</p>
                                @enderror

                            </div>

                        </div>
               
                    <div class="field">
                        <x-payment-type />
                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Recurring Payment Authorization</h3>
            <div class="inner-section">
                <div class="form-row">
                    <div class="field">
                        <label class="input-container">Would you like to sign up for recurring payments?
                            <input type="checkbox" name="recurring-payment" id="recurring-payment" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="field">
                        <label for="recurring-payment-type">Payment Type:</label>
                        <select name="recurring-payment-type" id="recurring-payment-type">
                            <option value="CC">Credit Card</option>
                            <option value="ACH">ACH Card</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="recurring-payment-date">Payment Date:</label>
                        <select name="recurring-payment-date" id="recurring-payment-date">
                            <option value="1">1st</option>
                            <option value="10">10th</option>
                            <option value="15">15th</option>
                            <option value="20">20th</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Paperless Billing Authorization</h3>
            <p>Please send all statements via email instead of postal?</p>
            <div class="inner-section">
                <div class="form-row">
                    <div class="field">
                        <label class="input-container">Yes Please:
                            <input type="radio" name="paperless-billing" id="paperless-billing-yes" />
                            <span class="checkmark cm-round"></span>
                        </label>
                    </div>
                    <div class="field">
                        <label class="input-container">No Thank:
                        <input type="radio" name="paperless-billing" id="paperless-billing-no" />
                        <span class="checkmark cm-round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </section>
        
    </form>
</div>
@endsection