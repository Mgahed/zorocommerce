@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="my-wishlist-page">
                <div class="row">
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    @if ($carts->count())
                                        <th style="font-size: 16px !important;"
                                            class="heading-title">{{__('Image')}}</th>
                                        <th style="font-size: 16px !important;"
                                            class="heading-title">{{__('Product name')}}</th>
                                        <th style="font-size: 16px !important;"
                                            class="heading-title">{{__('Color')}}</th>
                                        <th style="font-size: 16px !important;"
                                            class="heading-title">{{__('Total')}}</th>
                                        <th style="font-size: 16px !important;"
                                            class="heading-title">{{__('Remove')}}</th>
                                    @else
                                        <th colspan="4" class="heading-title">{{__('My Cart')}}</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @if ($carts->count())
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="col-md-2"><img style="width: 60px !important;" height="60px;"
                                                                      src="{{asset($cart->options->image)}}"
                                                                      alt="{{$cart->name}}">
                                            </td>
                                            <td class="col-md-3">
                                                <div class="product-name"><a
                                                        href="{{route('product.details',$cart->options->product_id)}}">{{$cart->name}}</a>
                                                </div>
                                                <div class="price">
                                                    {{$cart->price}}{{__('EGP')}} * {{$cart->qty}}
                                                </div>
                                            </td>
                                            <td class="col-md-3">
                                                <strong>{{$cart->options->color}}</strong>
                                            </td>
                                            <td class="col-md-3">
                                                <strong>{{$cart->subtotal}}{{__('EGP')}}</strong>
                                            </td>
                                            <td class="col-md-1 close-btn">
                                                <a href="{{route('remove.mycart',$cart->rowId)}}" class=""><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <h3 class="text-danger text-center">{{__('No items in cart')}}</h3>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($carts->count())
                    <div class="row">
                        <div class="col-md-4 col-sm-12 estimate-ship-tax"></div>
                        <div class="col-md-4 col-sm-12 estimate-ship-tax">
                            @if (Session::has('coupon'))

                            @else
                                <table class="table" id="has_coupon">
                                    <thead>
                                    <tr>
                                        <th>
                                            <span class="estimate-title">{{__('Discount Code')}}</span>
                                            <p class="text-muted">{{__('Enter your coupon code if you have one..')}}</p>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <input id="coupon_name" type="text"
                                                       class="form-control unicase-form-control text-input"
                                                       placeholder="{{__('Your Coupon..')}}">
                                            </div>
                                            <div class="clearfix pull-right">
                                                <button type="submit" onclick="apply_coupon()"
                                                        class="btn-upper btn btn-primary">{{__('APPLY COUPON')}}</button>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody><!-- /tbody -->
                                </table><!-- /table -->
                            @endif
                        </div><!-- /.estimate-ship-tax -->

                        <div class="col-md-4 col-sm-12 cart-shopping-total">
                            <table class="table">
                                <thead id="couponCalField">
                                {{--<tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            {{('Subtotal')}}<span class="inner-left-md"><span
                                                    id="cart_total">{{$cartTotal}}</span>{{__('EGP')}}</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            {{('Grand Total')}}<span class="inner-left-md"><span
                                                    id="cart_total">{{$cartTotal}}</span>{{__('EGP')}}</span>
                                        </div>
                                    </th>
                                </tr>--}}
                                </thead><!-- /thead -->
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn text-center">
                                            <a href="{{route('checkout')}}" class="btn btn-primary checkout-btn">
                                                {{__('PROCEED TO CHECKOUT')}}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                </tbody><!-- /tbody -->
                            </table><!-- /table -->
                        </div><!-- /.cart-shopping-total -->
                    </div><!-- /.row -->
                @endif

            </div><!-- /.sigin-in-->
            <br><br>
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
