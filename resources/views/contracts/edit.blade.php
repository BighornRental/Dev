@extends('layouts.layout')

@section('content')
<div id="container">
    <h1>Create Contract</h1>
    <form method="POST" name="contract-form" id="contract-form" action="/contracts/{{$contract->id}}">
        @csrf
        @method('put')
        <input type="hidden" name="user_id" value="{{\Auth::user()->id}}" />
        <input type="hidden" name="customers_id" value="{{$contract->customers_id}}" />
        <input type="hidden" name="contract_id" value="{{$contract->id}}" />
        <section class="form-section" id="contract_info">
            <h3>Contract Information</h3>
            <div class="inner-section">
                <div class="form-row">

                    <div class="field">

                        <label for="dealer">Dealer:</label>

                        <div class="control">

                            <input @error('dealer') class="is-danger" @enderror type="text" id="dealer" name="dealer" value="{{$company->name}}" readonly required/>

                            @error('dealer')
                                <p class="help is-danger">{{ $errors->first('dealer') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">
                        
                        <label for="contract_number">Contract Number:</label>
                        
                            <div class="control">

                                <input @error('contract_number') class="is-danger" @enderror type="text" id="contract_number" name="contract_number" value="{{$company->short_code}}-{{$contract->id}}" readonly required />

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

                            <input @error('sales_person') class="is-danger" @enderror type="text" id="sales_person" name="sales_person"  value="{{ old('sales_person') ? old('sales_person') : trim($contract->sales_person)}}" required />

                            @error('address')
                                <p class="help is-danger">{{ $errors->first('sales_person') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <div class="control">
                            <x-ListStates name="contract_state" label="Cotract State">
                            {{$contract->contract_state}}
                            </x-ListStates>
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

                            <input type="text" id="customer_name" name="customer_name" value="{{ $customer->first_name}} {{ $customer->last_name}}" readonly />

                        </div>

                    </div>

                    <div class="field">

                        <label for="email">Email:</label> 

                        <div class="control">

                            <input type="email" id="email" name="email"  value="{{ $customer->email}}"  readonly />


                        </div>
                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for='phone'>Customer Phone:</label>

                        <div class="control">

                            <input type="text" id="phone" name="phone" value="{{ $customer->phone}}"  readonly />


                        </div>

                    </div>
                    <div class="field">

                        <label for="secondary_phone">Secondary Phone:</label> 
                        
                        <div class="control">

                            <input type="phone" id="secondary_phone" name="secondary_phone" value="{{ $customer->secondary_phone}}" readonly/>

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

                        <input @error('shipping_address') class="is-danger" @enderror type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') ? old('shipping_address') : trim($contract->shipping_address)}}" required />

                        @error('shipping_address')
                            <p class="help is-danger">{{ $errors->first('shipping_address') }}</p>
                        @enderror

                    </div>

                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_city">Shipping City:</label> 
                        
                        <div class="control">

                            <input @error('shipping_city') class="is-danger" @enderror type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') ? old('shipping_city') : trim($contract->shipping_city)}}" required />

                            @error('shipping_city')
                                <p class="help is-danger">{{ $errors->first('shipping_city') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                         
                        
                        <div class="control">
                            <x-ListStates name="shipping_state" label="Shipping State">
                            {{$contract->shipping_state}}
                            </x-ListStates>
                        </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_county">Shipping County:</label> 
                        
                        <div class="control">

                            <input @error('shipping_county') class="is-danger" @enderror type="text" id="shipping_county" name="shipping_county" value="{{ old('shipping_county') ? old('shipping_county') : trim($contract->shipping_county)}}" required />

                            @error('shipping_county')
                                <p class="help is-danger">{{ $errors->first('shipping_county') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="shipping_country">Shipping Country:</label> 
                        
                        <div class="control">
                            <select name="shipping_country" required >
                                <option value="USA">United States</option>
                            </select>

                            @error('shipping_country')
                                <p class="help is-danger">{{ $errors->first('shipping_country') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_postal_code">Shipping Postal Code:</label> 
                        
                        <div class="control">

                            <input @error('shipping_postal_code') class="is-danger" @enderror type="text" id="shipping_postal_code" name="shipping_postal_code" value="{{ old('shipping_postal_code') ? old('shipping_postal_code') : trim($contract->shipping_postal_code)}}" required />

                            @error('shipping_postal_code')
                                <p class="help is-danger">{{ $errors->first('shipping_postal_code') }}</p>
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

                            <input @error('reference_name') class="is-danger" @enderror type="text" id="reference_name" name="reference_name" value="{{ old('reference_name') ? old('reference_name') : trim($contract->reference_name)}}" required />

                            @error('reference_name')
                                <p class="help is-danger">{{ $errors->first('reference_name') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="reference_phone">Reference Phone:</label> 
                        
                        <div class="control">

                            <input @error('reference_phone') class="is-danger" @enderror type="phone" id="reference_phone" name="reference_phone" value="{{ old('reference_phone') ? old('reference_phone') : trim($contract->reference_phone)}}"  placeholder="000-000-0000" required />

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

                            <input @error('product_size') class="is-danger" @enderror type="text" id="product_size" name="product_size" value="{{ old('product_size') ? old('product_size') : trim($contract->product_size)}}"  placeholder="WxL (8x10)" required />

                            @error('product_size')
                                <p class="help is-danger">{{ $errors->first('product_size   ') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_style">Buiding Style:</label> 
                        
                        <div class="control">

                            <input @error('product_style') class="is-danger" @enderror type="phone" id="product_style" name="product_style" value="{{ old('product_style') ? old('product_style') : trim($contract->product_style)}}"  required />

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

                            <input @error('product_side_color') class="is-danger" @enderror type="text" id="product_side_color" name="product_side_color" value="{{ old('product_side_color') ? old('product_side_color') : trim($contract->product_side_color)}}" required />

                            @error('product_side_color')
                                <p class="help is-danger">{{ $errors->first('product_side_color') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_trim_color">Trim Color:</label> 
                        
                        <div class="product_trim_color">

                            <input @error('product_trim_color') class="is-danger" @enderror type="phone" id="product_trim_color" name="product_trim_color" value="{{ old('product_trim_color') ? old('product_trim_color') : trim($contract->product_trim_color)}}" required />

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

                            <input @error('product_roof_color') class="is-danger" @enderror type="text" id="product_roof_color" name="product_roof_color" value="{{ old('product_roof_color') ? old('product_roof_color') : trim($contract->product_roof_color)}}" required />

                            @error('product_roof_color')
                                <p class="help is-danger">{{ $errors->first('product_roof_color') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_roof_material">Roofing Material:</label> 
                        
                        <div class="product_roof_material">

                            <input @error('product_roof_material') class="is-danger" @enderror type="phone" id="product_roof_material" name="product_roof_material" value="{{ old('product_roof_material') ? old('product_roof_material') : trim($contract->product_roof_material)}}" required />

                            @error('product_roof_material')
                                <p class="help is-danger">{{ $errors->first('product_roof_material') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <x-material>
                        {{$contract->product_material}}
                        </x-material>

                    </div>

                    <div class="field">

                        <label for="product_serial_number">Product Serial Number:</label> 
                        
                        <div class="product_serial_number">

                            <input @error('product_serial_number') class="is-danger" @enderror type="text" id="product_serial_number" name="product_serial_number" value="{{ old('product_serial_number') ? old('product_serial_number') : trim($contract->product_serial_number)}}" required />

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
                                <input type="radio" name="product_condition" id="condition-new" value="new" {{ old('product_condition')=="new" || $contract->product_condition == 'new' ? 'checked='.'"'.'checked'.'"' : '' }} required />
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        <div class="control radio-control">

                            <label class="input-container">Use Condition:
                                <input type="radio" name="product_condition" id="condition-used" value="used" {{ old('product_condition')=="used"  || $contract->product_condition == 'used' ? 'checked='.'"'.'checked'.'"' : '' }} />
                                <span class="checkmark cm-round"></span>
                            </label>

                        </div>
                        @error('product_condition')
                            <p class="help is-danger">{{ $errors->first('product_condition') }}</p>
                        @enderror

                        <div class="control" style="margin-top: 18px;">
                            <label for="product_condition_description">If used enter description of product:
                                <textarea @error('product_condition_description') class="is-danger" @enderror name="product_condition_description" id="product_condition_description" rows="1">{{ old('product_condition_description') ? old('product_condition_description') : trim($contract->product_condition_description)}}</textarea>
                            </label>
                            @error('product_condition_description')
                                <p class="help is-danger">{{ $errors->first('product_condition_description') }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="field">

                        <x-terms>
                        {{$contract->rto_terms}}
                        </x-terms>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">

                        <label for="product_cash_price">Cash Price:</label> 
                        
                        <div class="control">

                            <div class="input-group">
                                <span class="label-sufix">$</span>
                                    <input @error('product_cash_price') class="is-danger" @enderror type="text" id="product_cash_price" name="product_cash_price" value="" required />
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
                                    <input @error('product_sales_tax') class="is-danger" @enderror type="text" id="product_sales_tax" name="product_sales_tax" value="{{ old('product_sales_tax') ? old('product_sales_tax') : trim($contract->product_sales_tax)}}" required />
                                    <input type="hidden" name="product_sales_tax_amount" id="product_sales_tax_amount" value="{{ old('product_sales_tax_amount') ? old('product_sales_tax_amount') : trim($contract->product_sales_tax_amount)}}" >
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
                                <input @error('product_delivery_charge') class="is-danger" @enderror type="text" id="product_delivery_charge" name="product_delivery_charge" value="{{ old('product_delivery_charge') ? old('product_delivery_charge') : number_format( trim($contract->product_delivery_charge), 2 ) }}"  />
                            </div>
                            @error('product_delivery_charge')
                                <p class="help is-danger">{{ $errors->first('product_delivery_charge') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="delivery_date">Estimated Delivery Date:</label> 
                        
                        <div class="delivery_date">

                            <input @error('delivery_date') class="is-danger" @enderror type="date" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') ? old('delivery_date') : trim($contract->delivery_date)}}" required />

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
                                <input type="radio" name="ldw" id="accept" value="1" {{ old('ldw')== '1'  || $contract->ldw == '1' ? 'checked='.'"'.'checked'.'"' : '' }} required/>
                                <span class="checkmark cm-round"></span>
                            </label>
                        </div>

                        <div class="control radio-control">

                            <label  class="input-container">Decline:
                                <input type="radio" name="ldw" id="decline" value="0" {{ old('ldw') == '0'  || $contract->ldw == '0' ? 'checked='.'"'.'checked'.'"' : '' }} /> {{ old('ldw')}}
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
                                    <input @error('ldw_monthly') class="is-danger" @enderror type="text" id="ldw_monthly" name="ldw_monthly" value="{{ old('ldw_monthly') ? old('ldw_monthly') : number_format( trim($contract->ldw_monthly), 2 )}}" required />
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
                                <input type="text" name="initial_down_payment" id="initial_down_payment" value=""/>
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
                    <li><label>Initial Rental Payment (2 Months): <input type="text" name="irp" id="irp" value="{{ old('irp') }}" readonly /></label></li>
                    <input type="hidden" name="monthly_payment" id="monthly_payment" value="{{ old('monthly_payment') }}"/></li>
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

                            <label for="initial-payment">Initial Payment: {{old('initial-payment')}}</label> 
                            
                            <div class="control">

                                <div class="input-group">
                                    <span class="label-sufix">$</span>
                                    <input type="text" @error('initial_payment') class="is-danger" @enderror id="initial-payment" name="initial_payment" value="{{ old('initial_payment') ?? $contract->initial_payment}}" required/>
                                </div>
                                @error('initial-payment')
                                    <p class="help is-danger">{{ $errors->first('initial-payment') }}</p>
                                @enderror

                            </div>

                        </div>
               
                    <div class="field">
                        <x-payment-type>
                            {{$contract->initial_payment_type}}
                        </x-payment-tpe>
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
                            <input type="checkbox" name="recurring_payment" id="recurring_payment" value="1" {{ old('recurring_payment') == "1" || $contract->recurring_payment == 1 ? 'checked' : '' }} />
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="field">
                        <label for="recurring-payment-type">Payment Type:</label>
                        <select name="recurring_payment_type" id="recurring_payment_type">
                            <option value="">Select Payment Type</option>
                            <option value="cc" {{ old('recurring_payment_type') == "cc" || $contract->recurring_payment_type == 'cc' ? 'selected' : '' }}>Credit Card</option>
                            <option value="ach" {{ old('recurring_payment_type') == "ach" || $contract->recurring_payment_type == 'ach' ? 'selected' : '' }}>ACH Check</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="recurring-payment-date">Payment Date:</label>
                        <select name="recurring_payment_date" id="recurring_payment_date">
                            <option value="">Please Select Date</option>
                            <option value="1" {{ old('recurring_payment_date') == 1 || $contract->recurring_payment_date == 1 ? 'selected' : '' }}>1st</option>
                            <option value="10" {{ old('recurring_payment_date') == 10 || $contract->recurring_payment_date == 10 ? 'selected' : '' }}>10th</option>
                            <option value="15" {{ old('recurring_payment_date') == 15  || $contract->recurring_payment_date == 15 ? 'selected' : '' }}>15th</option>
                            <option value="20" {{ old('recurring_payment_date') == 20 || $contract->recurring_payment_date == 20 ? 'selected' : '' }}>20th</option>
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
                    Old is {{old('papperless_billing')}} and contract is {{$contract->papperless_billing}}
                        <label class="input-container">Yes Please:
                        {{-- if there is an old the use that if not use contract --}}
                            <input @error('papperless_billing') class="is-danger" @enderror type="radio" name="papperless_billing" id="papperless-billing-yes" value="1" @if( old('papperless_billing') == '1' ) checked="checked" @elseif( $contract->papperless_billing == 1) checked="checked"  @endif required/>
                            <span class="checkmark cm-round"></span>
                        </label>
                    </div>
                    <div class="field">
                        <label class="input-container">No Thanks:

                        <input @error('papperless_billing') class="is-danger" @enderror type="radio" name="papperless_billing" id="papperless-billing-no" value="0" @if( old('papperless_billing') == '0')  checked="checked" @elseif($contract->papperless_billing == 0 ) checked="checked" @endif  required />
                        <span class="checkmark cm-round"></span>
                        </label>
                    </div>
                    @error('papperless_billing')
                        <p class="help is-danger">{{ $errors->first('papperless_billing') }}</p>
                    @enderror
                </div>
            </div>
        </section>
         <section class="form-section"  id="submit" style="background-color: transparent">
            <div class="field" align="center">
                <button type="submit">SAVE CONTRACT</button>
            </div>
        </section>
    </form>
   @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

@endsection