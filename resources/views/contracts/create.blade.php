@extends('layouts.layout')
@section('content')
<div id="container">
    <h1>Create Contract</h1>
    <form method="POST" name="contract-form" id="contract-form" action="/contracts/{{$id}}">
        @csrf
        <input type="hidden" name="user_id" value="{{\Auth::user()->id}}" />
        <input type="hidden" name="customers_id" value="{{$customer->id}}" />
        <input type="hidden" name="contract_id" value="{{$id}}" />
        <section class="form-section" id="contract_info">
            <h3>Contract Information</h3>
            <div class="inner-section">
                <div class="form-row">

                    <div class="field">

                        <label for="dealer">Dealer:</label>

                        <div class="control">

                            <input @error('dealer') class="is-danger" @enderror type="text" id="dealer" name="dealer" value="{{$company->name}}" readonly />

                            @error('dealer')
                                <p class="help is-danger">{{ $errors->first('dealer') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">
                        
                        <label for="contract_number">Contract Number:</label>
                        
                            <div class="control">

                                <input @error('contract_number') class="is-danger" @enderror type="text" id="contract_number" name="contract_number" value="{{$company->short_code}}-{{$id}}" readonly />

                                @error('contract_number')
                                    <p class="help is-danger">{{ $errors->first('contract_number') }}</p>
                                @enderror
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

                            <input @error('contract_state') class="is-danger" @enderror type="text" id="contract_state" name="contract_state"  value="{{$company->state}}"  />

                            @error('contract_state')
                                <p class="help is-danger">{{ $errors->first('contract_state') }}</p>
                            @enderror
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

                            <input type="text" id="customer_name" name="customer_name" value="{{$customer->first_name}} {{$customer->last_name}}" readonly />

                        </div>

                    </div>

                    <div class="field">

                        <label for="email">Email:</label> 

                        <div class="control">

                            <input @error('email') class="is-danger" @enderror type="email" id="email" name="email"  value="{{$customer->email}}"  placeholder="user@domain.com" readonly />

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

                            <input @error('phone') class="is-danger" @enderror type="text" id="phone" name="phone" value="{{$customer->phone}}"  placeholder="000-000-0000" readonly/>

                            @error('phone')
                                <p class="help is-danger">{{ $errors->first('phone') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="secondary_phone">Secondary Phone:</label> 
                        
                        <div class="control">

                            <input type="phone" id="secondary_phone" name="secondary_phone" value="{{$customer->secondary_phone ?? old('secondary_phone')}}" readonly/>

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

                        <input @error('shipping_address') class="is-danger" @enderror type="text" id="shipping_address" name="shipping_address" value="{{$customer->address ?? old('shipping_address')}}"  />

                        @error('shipping_address')
                            <p class="help is-danger">{{ $errors->first('shipping_address') }}</p>
                        @enderror

                    </div>

                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_city">Shipping City:</label> 
                        
                        <div class="control">

                            <input @error('shipping_city') class="is-danger" @enderror type="text" id="shipping_city" name="shipping_city" value="{{$customer->city ?? old('shipping_city')}}"  />

                            @error('shipping_city')
                                <p class="help is-danger">{{ $errors->first('shipping_city') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                         
                        
                        <div class="control">
                            <x-ListStates />
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

                            <input @error('product_style') class="is-danger" @enderror type="phone" id="product_style" name="product_style" value="{{old('product_style')}}"  />

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

                            <input @error('product_roof_material') class="is-danger" @enderror type="phone" id="product_roof_material" name="product_roof_material" value="{{old('product_roof_material')}}"  />

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
                                <input type="radio" name="product_condition" id="condition-new" value="new" {{ old('product_condition')=="new" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        <div class="control radio-control">

                            <label class="input-container">Use Condition:
                                <input type="radio" name="product_condition" id="condition-used" value="used" {{ old('product_condition')=="used" ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                <span class="checkmark cm-round"></span>
                            </label>

                        </div>
                        @error('product_condition')
                            <p class="help is-danger">{{ $errors->first('product_condition') }}</p>
                        @enderror

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
                                    <input @error('product_cash_price') class="is-danger" @enderror type="text" id="product_cash_price" name="product_cash_price" value="{{old('product_cash_price')}}"  />
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
                                    <input @error('product_sales_tax') class="is-danger" @enderror type="text" id="product_sales_tax" name="product_sales_tax" value="{{ 0 ??old('product_trim_color')}}"  />
                                    <input type="hidden" name="product_sales_tax_amount" id="product_sales_tax_amount" value="" >
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
                                <input @error('product_delivery_charge') class="is-danger" @enderror type="text" id="product_delivery_charge" name="product_delivery_charge" value="{{old('product_delivery_charge')}}"  />
                            </div>
                            @error('product_delivery_charge')
                                <p class="help is-danger">{{ $errors->first('product_delivery_charge') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="delivery_date">Estimated Delivery Date:</label> 
                        
                        <div class="delivery_date">

                            <input @error('delivery_date') class="is-danger" @enderror type="date" id="delivery_date" name="delivery_date" value="{{old('delivery_date')}}"  />

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
                                <input type="radio" name="ldw" id="accept" value="1" {{ old('ldw')=="1" ? 'checked='.'"'.'checked'.'"' : '' }}/>
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        <div class="control radio-control">

                            <label  class="input-container">Decline:
                                <input type="radio" name="ldw" id="decline" value="0" {{ old('ldw')=="0" ? 'checked='.'"'.'checked'.'"' : '' }} />
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        @error('ldw')
                            <p class="help is-danger">{{ $errors->first('ldw') }}</p>
                        @enderror
                    </div>

                    <div class="field">

                        <label for="ldw-monthly">this coverage (monthly):</label> 
                        
                        <div class="control">

                            <div class="input-group">
                                <span class="label-sufix">$</span>
                                    <input @error('ldw_monthly') class="is-danger" @enderror type="text" id="ldw_monthly" name="ldw_monthly" value="{{old('ldw_monthly')}}"  />
                            </div>
                            @error('ldw_monthly')
                                <p class="help is-danger">{{ $errors->first('ldw_monthly') }}</p>
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
                            <label for="initial_down_payment">Enter Down Payment: </label> 
                            <div class="control">
                                <input type="text" name="initial_down_payment" id="initial_down_payment" value="{{old('initial_down_payment')}}"/>
                            </div>
                        </div>
                        <div class="field">
                            <p>The &ldquo;Adjusted Down Payment&rdquo; is used to adjust the &ldquo;Down Payment&rdquo; so that the &ldquo;Total Initial Payment&rdquo; and the &ldquo;Down Payment&rdquo; are equal.<p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="field">
                            <label for="original_initial_payment">Adjusted Down Payment: </label> 
                            <div class="control">
                                <input type="text" name="original_initial_payment" id="original_initial_payment" value="{{old('original_initial_payment')}}"/> <span id="adjust_dp"><span rel="down">-</span> <span rel="up">+</span></span>
                            </div>
                        </div>
        
                        <div class="field">
                            <label for="AdjDownPayment">Recacluate Payments: </label>
                            <div class="control">
                                <button value="Recacluate" id="AdjDownPayment" name="AdjDownPayment">Recacluate</button> <span id="calc_now">Calculating...</span>
                            </div>  
                    </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Rental Payment</h3>
            <div class="inner-section">
                <div class="form-row">
                    <p>The monthly rental payment is  $<span id="payment-no-cra">0.00</span> plus a monthly sales tax of  $<span class="tax-cra">0.00</span> plus optional Liability Damage Waiver fee of   $<span class="ldw-cra">0.00</span> for a total of  $<span id="no-ldw-total">0.00</span></p>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Intial Payments</h3>
            <div class="inner-section">
                <div class="form-row">
                <input type="hidden" name="month1" id="month1" value="{{old('month1')}}"/>
                <ol>
                    <li><label>Initial Rental Payment (2 Months): <input type="text" name="irp" id="irp" value="{{old('irp')}}" readonly /></label>
                    <input type="hidden" name="monthly_payment" id="monthly_payment" value="{{old('monthly_payment')}}"/></li>
                    <li><label>Initial Sales Tax <input type="text" name="ist" id="ist" value="{{old('ist')}}" readonly /></label></li>
                    <li><label>Liability Damage Waiver <input type="text" name="ldw2" id="ldw2" value="{{old('ldw2')}}" readonly /></label></li>
                    <li><label>Customer Reserve Account <input type="number" name="cra" id="cra" value="{{old('cra')}}" readonly /></label></li>
                    @error('cra')
                        <p class="help is-danger">{{ $errors->first('cra') }}</p>
                    @enderror
                    <li><label>Delivery Charge <input type="text" name="dc" id="dc" value="{{old('dc')}}" readonly /></label></li>
                    <li><label>Total Initial Payment <input type="text" name="tip" id="tip" value="{{old('tip')}}" readonly /></label></li>
                </ol>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Rental Purchasse Ownership</h3>
            <div class="inner-section">
                 <div class="form-row">
                    <p>At <span id="AgreeToTerms"></span> monthly rental payments, we will apply any balance in the CRA, plus tax, and you will own the property. You will have paid a Total Cost of <span id="ContractTotal"></span> not including LDW or tax. At any time you can do an early payoff by paying <span id="PayOff"></span> of the remaining payments plus tax for ownership.
                    </p>
                 </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Initial Payment Authorization</h3>
            <div class="inner-section">
                <div class="form-row">
                    <div class="field">

                            <label for="initial-pay-athorization">Initial Payment: {{old('initial-payment')}}</label> 
                            
                            <div class="control">

                                <div class="input-group">
                                    <span class="label-sufix">$</span>
                                    <input type="text" @error('initial_payment') class="is-danger" @enderror id="initial-payment" name="initial_payment" value="{{ old('initial_payment')}}"/>
                                </div>
                                @error('initial-payment')
                                    <p class="help is-danger">{{ $errors->first('initial-payment') }}</p>
                                @enderror

                            </div>

                        </div>
               
                    <div class="field">
                        <x-payment-type name="" />
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
                            <input type="checkbox" name="recurring-payment" id="recurring_payment" value="1" />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="field">
                        <label for="recurring-payment-type">Payment Type:</label>
                        <select name="recurring-payment-type" id="recurring_payment_type">
                            <option value="">Select Payment Type</option>
                            <option value="cc" {{ old('recurring-payment-type') == "cc" ? 'selected' : '' }}>Credit Card</option>
                            <option value="ach" {{ old('recurring-payment-type') == "ach" ? 'selected' : '' }}>ACH Check</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="recurring-payment-date">Payment Date:</label>
                        <select name="recurring-payment-date" id="recurring_payment_date">
                            <option value="1" {{ old('recurring-payment-date') == "1" ? 'selected' : '' }}>1st</option>
                            <option value="10" {{ old('recurring-payment-date') == "0" ? 'selected' : '' }}>10th</option>
                            <option value="15" {{ old('recurring-payment-date') == "15" ? 'selected' : '' }}>15th</option>
                            <option value="20" {{ old('recurring-payment-date') == "20" ? 'selected' : '' }}>20th</option>
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
                            <input type="radio" name="paperless-billing" id="paperless-billing-yes" value="1" {{ old('paperless-billing') == "1" ? 'checked' : '' }} />
                            <span class="checkmark cm-round"></span>
                        </label>
                    </div>
                    <div class="field">
                        <label class="input-container">No Thanks:
                        <input type="radio" name="paperless-billing" id="paperless-billing-no" value="0" {{ old('paperless-billing') == "0" ? 'checked' : '' }} />
                        <span class="checkmark cm-round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </section>
         <section class="form-section"  id="submit" style="background-color: transparent">
            <div class="field" align="center">
                <button type="submit">SAVE CONTRACT</button>
            </div>
        </section>
    </form>
    @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
</div>

@endsection