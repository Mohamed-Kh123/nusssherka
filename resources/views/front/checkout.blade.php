@extends('layouts.store')
@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>

    
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        @if(!Auth::user())
                        <!--Accordion Start-->
                        <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est
                                    sit amet ipsum luctus.</p>
                                <form action="{{route('login')}}" method="post">
                                    @csrf
                                    <p class="form-row-first">
                                        <label>Email <span class="required">*</span></label>
                                        <input class="mb-0" type="email" placeholder="Email Address" name="email">
                                    </p>
                                    <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input class="mb-0" type="password" placeholder="Password" name="password">
                                    </p>
                                    <p class="form-row">
                                        <button value="Login" type="submit">Login</button>
                                        <label>
                                            <input type="checkbox">
                                            Remember me
                                        </label>
                                    </p>
                                    <p class="lost-password"><a href="#">Lost your password?</a></p>
                                </form>
                            </div>
                        </div>
                        @endif
                        <!--Accordion End-->
                        <!--Accordion Start-->
                        @if(!$coupon)
                        <div id="apply_coupon">
                            <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="{{route('coupons.apply')}}" method="post">
                                        @csrf
                                        <p class="checkout-coupon">
                                            <input placeholder="Coupon code" name="code" type="text">
                                            <button type="submit" class="btn">Apply Coupon</button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!--Accordion End-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="country-select clearfix">
                                        <label>Country <span class="required">*</span></label>
                                        <select name="billing_country_name" id="billing_country_name" class="form-control">
                                            @foreach ($countries as $key => $value)
                                            <option value="{{ $value }}" @if($value == old('billing_country_name', $order->billing_country_name)) selected @endif>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Name <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="billing_name" value="{{old('billing_name', $order->billing_name)}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input placeholder="" type="text" name="billing_company_name" value="{{old('billing_company_name', $order->billing_company_name)}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Delivery Name</label>
                                        <select name="delivery_name">
                                            <option value="حمامة">حمامة</option>
                                            <option value="يمامة">يمامة</option>
                                            <option value="حودة">حودة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Street address" type="text" name="billing_address" value="{{old('billing_address', $order->billing_address)}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input placeholder="Apartment, suite, unit etc. (optional)" type="text" name="billing_apartment_name" value="{{old('billing_apartment_name', $order->billing_apartment_name)}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text" name="billing_city" value="{{old('billing_city', $order->billing_city)}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>State / County <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="billing_state" value="{{old('billing_state', $order->billing_state)}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input placeholder="" type="text" name="billing_postcode" value="{{old('billing_postcode', $order->billing_postcode)}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="" type="email" name="billing_email" value="{{old('billing_email', $order->billing_email)}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="billing_phone_number" value="{{old('billing_phone_number', $order->billing_phone_number)}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list create-acc">
                                        <input id="cbox" type="checkbox">
                                        <label>Create an account?</label>
                                    </div>
                                    <div id="cbox-info" class="checkout-form-list create-account">
                                        <p>Create an account by entering the information below. If you are a returning
                                            customer please login at the top of the page.</p>
                                        <label>Account password <span class="required">*</span></label>
                                        <input placeholder="password" type="password">
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Ship to a different address?</label>
                                        <input id="ship-box" type="checkbox">
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="country-select clearfix">
                                            <label>Country <span class="required">*</span></label>
                                            <x-form-select name="shipping_country_name" :options="$countries" :selected="$order->shipping_country_name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Name <span class="required">*</span></label>
                                            <input placeholder="" type="text" name="shipping_name" value="{{old('shipping_name', $order->shipping_name)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input placeholder="" type="text" name="shipping_company_name" value="{{old('shipping_company_name', $order->shipping_company_name)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input placeholder="Street address" type="text" name="shipping_address" value="{{old('shipping_address', $order->shipping_address)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <input placeholder="Apartment, suite, unit etc. (optional)" type="text" name="shipping_apartment_name" value="{{old('shipping_apartment_name', $order->shipping_apartment_name)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Town / City <span class="required">*</span></label>
                                            <input type="text" name="shipping_city" value="{{old('shipping_city', $order->shipping_city)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>State / County <span class="required">*</span></label>
                                            <input placeholder="" type="text" name="shipping_state" value="{{old('shipping_state', $order->shipping_state)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input placeholder="" type="text" name="shipping_postcode" value="{{old('shipping_postcode', $order->shipping_postcode)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input placeholder="" type="email" name="shipping_email" value="{{old('shipping_email', $order->shipping_email)}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" name="shipping_phone_number" value="{{old('shipping_phone_number', $order->shipping_phone_number)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10"
                                            placeholder="Notes about your order, e.g. special notes for delivery." name="note">{{old('note', $order->note)}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Product Name</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->all() as $item)
                                    <tr class="cart_item">
                                        <td class="cart-product-name">{{$item->product->name}}<strong class="product-quantity"> × {{$item->quantity}}</strong></td>
                                        <td class="cart-product-total">${{$item->product->last_price}} </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                        @if($coupon)
                                        <tr class="cart-subtotal" id="{{$coupon['id']}}">
                                            <th><span>Discount</span>
                                            <a href="" id="removeCoupon" data-id="{{$coupon['id']}}" class="removeCoupon"><img src="{{asset('assets/front/images/trash-solid.svg')}}" class="trash"></a>
                                            </th>
                                            <td><span class="amount">-${{$discount}}</span></td>
                                        </tr>
                                        @endif
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">${{$cart->subTotal()}}</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Delivery price</th>
                                            <td><strong><span class="amount">${{config('app.delivery_price')}}</span></strong></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">${{($cart->total() - $discount) + config('app.delivery_price')}}</span></strong></td>
                                        </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="#payment-1">
                                            <h5 class="panel-title">
                                                <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                Direct Bank Transfer.
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Make your payment directly into our bank account. Please use your Order
                                                ID as the payment reference. Your order won’t be shipped until the funds
                                                have cleared in our account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="#payment-2">
                                            <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Cheque Payment
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment reference. Your order won’t be shipped until the funds
                                                    have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-3">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    PayPal
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment reference. Your order won’t be shipped until the funds
                                                    have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="order-button-payment">
                                    <button type="submit">Place order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

