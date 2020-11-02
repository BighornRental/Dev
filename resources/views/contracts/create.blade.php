@extends('layouts.layout')

@section('content')
<div id="container">
    <h1>Create Contract</h1>

    <form method="POST" action="/contracts">
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

                            <input @error('sales_person') class="is-danger" @enderror type="text" id="sales_person" name="sales_person"  value="{{old('sales_person')}}" required />

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

                            <input @error('email') class="is-danger" @enderror type="phone" id="email" name="email"  value="{{old('email')}}" required placeholder="user@domain.com" />

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

                            <input @error('phone') class="is-danger" @enderror type="text" id="phone" name="phone" value="{{old('phone')}}" required placeholder="000-000-0000" />

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

                        <input @error('shipping_address') class="is-danger" @enderror type="text" id="shipping_address" name="shipping_address" value="{{old('shipping_address')}}" required />

                        @error('shipping_address')
                            <p class="help is-danger">{{ $errors->first('shipping_address') }}</p>
                        @enderror

                    </div>

                </div>
                <div class="form-row">
                    <div class="field">

                        <label for="shipping_city">Shipping City:</label> 
                        
                        <div class="control">

                            <input @error('shipping_city') class="is-danger" @enderror type="text" id="shipping_city" name="shipping_city" value="{{old('shipping_city')}}" required />

                            @error('shipping_city')
                                <p class="help is-danger">{{ $errors->first('shipping_city') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="shipping_state">Shipping State:</label> 
                        
                        <div class="control">
                            <select name="shipping_state" required>
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

                            <input @error('shipping_county') class="is-danger" @enderror type="text" id="shipping_county" name="shipping_county" value="{{old('shipping_county')}}" required />

                            @error('shipping_county')
                                <p class="help is-danger">{{ $errors->first('shipping_county') }}</p>
                            @enderror

                        </div>

                    </div>
                    <div class="field">

                        <label for="shipping_country">Shipping Country:</label> 
                        
                        <div class="control">
                            <select name="shipping_country" required>
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

                            <input @error('reference_name') class="is-danger" @enderror type="text" id="reference_name" name="reference_name" value="{{old('reference_name')}}" required />

                            @error('reference_name')
                                <p class="help is-danger">{{ $errors->first('reference_name') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="reference_phone">Reference Phone:</label> 
                        
                        <div class="control">

                            <input @error('reference_phone') class="is-danger" @enderror type="phone" id="reference_phone" name="reference_phone" value="{{old('reference_phone')}}" required placeholder="000-000-0000" />

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

                            <input @error('product_size') class="is-danger" @enderror type="text" id="product_size" name="product_size" value="{{old('product_size')}}" required placeholder="WxL (8x10)" />

                            @error('product_size')
                                <p class="help is-danger">{{ $errors->first('product_size   ') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_style">Buiding Style:</label> 
                        
                        <div class="control">

                            <input @error('product_style') class="is-danger" @enderror type="phone" id="product_style" name="product_style" value="{{old('product_size')}}" required />

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

                            <input @error('product_side_color') class="is-danger" @enderror type="text" id="product_side_color" name="product_side_color" value="{{old('product_side_color')}}" required />

                            @error('product_side_color')
                                <p class="help is-danger">{{ $errors->first('product_side_color') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_trim_color">Trim Color:</label> 
                        
                        <div class="product_trim_color">

                            <input @error('product_trim_color') class="is-danger" @enderror type="phone" id="product_trim_color" name="product_trim_color" value="{{old('product_trim_color')}}" required />

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

                            <input @error('product_roof_color') class="is-danger" @enderror type="text" id="product_roof_color" name="product_roof_color" value="{{old('product_roof_color')}}" required />

                            @error('product_roof_color')
                                <p class="help is-danger">{{ $errors->first('product_roof_color') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="product_roof_material">Roofing Material:</label> 
                        
                        <div class="product_roof_material">

                            <input @error('product_trim_color') class="is-danger" @enderror type="phone" id="product_roof_material" name="product_roof_material" value="{{old('product_roof_material')}}" required />

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

                            <input @error('product_serial_number') class="is-danger" @enderror type="text" id="product_serial_number" name="product_serial_number" value="{{old('product_serial_number')}}" required />

                            @error('product_serial_number')
                                <p class="help is-danger">{{ $errors->first('product_serial_number') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
                <div class="form-row">

                    <div class="field">
                        
                        <div class="control radio-control">

                            <label for="condition-new">New Condition:</label>

                            <input type="radio" name="product_condition" id="condition-new" value="new" />
                        </div>

                        <div class="control radio-control">

                            <label for="condition-used">Use Condition:</label>

                            <input type="radio" name="product_condition" id="condition-used" value="used" />

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
                                    <input @error('product_cash_price') class="is-danger" @enderror type="text" id="product_cash_price" name="product_cash_price" value="{{old('product_cash_price')}}" required />
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
                                    <input @error('product_sales_tax') class="is-danger" @enderror type="text" id="product_sales_tax" name="product_sales_tax" value="{{old('product_trim_color')}}" required />
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
                                <input @error('product_delivery_charge') class="is-danger" @enderror type="text" id="product_delivery_charge" name="product_delivery_charge" value="{{old('product_delivery_charge')}}" required />
                            </div>
                            @error('product_delivery_charge')
                                <p class="help is-danger">{{ $errors->first('product_delivery_charge') }}</p>
                            @enderror

                        </div>

                    </div>

                    <div class="field">

                        <label for="delivery_date">Estimated Delivery Date:</label> 
                        
                        <div class="delivery_date">

                            <input @error('delivery_date') class="is-danger" @enderror type="date" id="delivery_date" name="delivery_date" value="{{old('delivery_date')}}" required />

                            @error('delivery_date')
                                <p class="help is-danger">{{ $errors->first('delivery_date') }}</p>
                            @enderror

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Liablity Damage Waver “LDW”</h3>
            <div class="inner-section">

                <div class="form-row">

                    <div class="field">
                        
                        <div class="control radio-control">

                            <label for="accept">Accept:</label>

                            <input type="radio" name="ldw" id="accept" value="accept" />
                        </div>

                        <div class="control radio-control">

                            <label for="decline">Decline:</label>

                            <input type="radio" name="ldw" id="decline" value="decline" />

                        </div>

                    </div>

                    <div class="field">

                        <label for="ldw-monthly">this coverage (monthly):</label> 
                        
                        <div class="control">

                            <div class="input-group">
                                <span class="label-sufix">$</span>
                                    <input @error('ldw-monthly') class="is-danger" @enderror type="text" id="ldw-monthly" name="ldw-monthly" value="{{old('ldw-monthly')}}" required />
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
                <p>
                    Use this calculator if the customer has a set amount of money that they would like to split between their initial payment and the CRA. Enter the total amount of the initial payment here: ORIGINAL INITAL PAYMENT: <input type="text" name="original_initial_payment" id="original_initial_payment" /> Enter CRA <input type="text" name="cra_amount" id="cra-amount" /> into the CRA field $ 204.28 for the customers total initial payment to equal $1000.00
                </p>
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Rental Payment</h3>
            <div class="inner-section">
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Intial Payments</h3>
            <div class="inner-section">
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Rental Purchasse Ownership</h3>
            <div class="inner-section">
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Initial Payment Authorization</h3>
            <div class="inner-section">
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Recurring Payment Authorization</h3>
            <div class="inner-section">
            </div>
        </section>
        <section class="form-section"  id="reference">
            <h3>Paperless Billing Authorization</h3>
            <div class="inner-section">
            </div>
        </section>
        
    </form>
</div>
@endsection