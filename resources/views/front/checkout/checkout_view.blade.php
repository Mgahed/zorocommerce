@extends('front.main_master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="body-content">
                <div class="container">
                    <div class="checkout-box ">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel-group checkout-steps" id="accordion">
                                    <!-- checkout-step-01  -->
                                    <div class="panel panel-default checkout-step-01">

                                        <div id="collapseOne" class="panel-collapse collapse in">

                                            <!-- panel-body  -->
                                            <div class="panel-body">
                                                <div class="row">

                                                    <!-- guest-login -->
                                                    <form class="register-form" role="form" method="post"
                                                          action="{{route('checkout.store')}}">
                                                        @csrf
                                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                                            <h4 class="checkout-subtitle">
                                                                <b>{{__('Shipping details')}}</b>
                                                            </h4>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_name">
                                                                    {{__('Shipping name')}}<span
                                                                        class="text-danger"> *</span>
                                                                </label>
                                                                <input type="text" value="{{Auth::user()->name}}"
                                                                       required
                                                                       class="form-control unicase-form-control text-input"
                                                                       name="name" autocomplete="off"
                                                                       id="shipping_name"
                                                                       placeholder="{{__('Full Name')}}">
                                                                @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_email">
                                                                    {{__('Shipping email')}}<span
                                                                        class="text-danger"> *</span>
                                                                </label>
                                                                <input type="email" value="{{Auth::user()->email}}"
                                                                       required
                                                                       name="email" autocomplete="off"
                                                                       class="form-control unicase-form-control text-input"
                                                                       id="shipping_email"
                                                                       placeholder="{{__('Email')}}">
                                                                @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_phone">
                                                                    {{__('Shipping phone number')}}<span
                                                                        class="text-danger"> *</span>
                                                                </label>
                                                                <input type="number" value="{{Auth::user()->phone}}"
                                                                       required
                                                                       name="phone"
                                                                       class="form-control unicase-form-control"
                                                                       id="shipping_phone"
                                                                       placeholder="{{__('Phone')}}">
                                                                @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <!-- guest-login -->

                                                        <!-- already-registered-login -->
                                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                                            <h4 class="checkout-subtitle">
                                                                <b><br></b>
                                                            </h4>
                                                            <hr>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_city">
                                                                    {{__('Select city')}}<span
                                                                        class="text-danger"> *</span>
                                                                </label>
                                                                <select name="division_id" required class="form-control"
                                                                        id="shipping_city">
                                                                    <option value=""
                                                                            disabled
                                                                            selected>{{__('Select city')}}</option>
                                                                    @foreach ($divisions as $item)
                                                                        <option value="{{$item->id}}">
                                                                            {{app()->getLocale() === 'en'?$item->name_en:$item->name_ar}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_city">
                                                                    {{__('Select district')}}<span
                                                                        class="text-danger"> *</span>
                                                                </label>
                                                                <select name="district_id" required class="form-control"
                                                                        id="district_id">
                                                                    <option value=""
                                                                            disabled
                                                                            selected>{{__('Select district')}}</option>
                                                                </select>
                                                                @error('division_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_address">
                                                                    {{__('Shipping address details')}}<span
                                                                        class="text-danger"> *</span>
                                                                </label>
                                                                <textarea required name="address" autocomplete="off"
                                                                          class="form-control unicase-form-control"
                                                                          id="shipping_address">{{auth()->user()->address}}</textarea>
                                                                @error('address')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="info-title" for="shipping_notes">
                                                                    {{__('Notes')}}
                                                                </label>
                                                                <textarea name="notes" autocomplete="off"
                                                                          class="form-control unicase-form-control"
                                                                          id="shipping_notes"></textarea>
                                                            </div>
                                                            <button type="submit"
                                                                    class="btn-upper btn btn-primary checkout-page-button">
                                                                {{__('Submit')}}
                                                            </button>
                                                        </div>
                                                        <!-- already-registered-login -->
                                                    </form>

                                                </div>
                                            </div>
                                            <!-- panel-body  -->

                                        </div><!-- row -->
                                    </div>
                                    <!-- checkout-step-01  -->
                                </div><!-- /.checkout-steps -->
                            </div>
                            <div class="col-md-4">
                                <!-- checkout-progress-sidebar -->
                                <div class="checkout-progress-sidebar ">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">{{__('Your Checkout Progress')}}</h4>
                                            </div>
                                            <div>
                                                <ul class="nav nav-checkout-progress list-unstyled">
                                                    @foreach($carts as $item)
                                                        <li>
                                                            <strong>{{__('Image')}}: </strong>
                                                            <img width="50px" height="50px"
                                                                 src="{{asset($item->options->image)}}"
                                                                 alt="{{$item->name}}">
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <span>
                                                                <strong>{{__('Quantity')}}: </strong>
                                                                ( {{$item->qty}} )
                                                            </span>
                                                            <span class="float-right">
                                                                <strong>{{__('Color')}}: </strong>
                                                                {{$item->options->color}}
                                                            </span>
                                                        </li>
                                                        <hr>
                                                    @endforeach
                                                    @if (Session::has('coupon'))
                                                        <li>
                                                            <strong>{{__('Subtotal')}}: </strong>
                                                            <span>{{$cartTotal}}</span>{{__('EGP')}}
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <strong>{{__('Coupon')}}
                                                                : </strong> {{session()->get('coupon')['coupon_name']}}
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <strong>{{__('Discount')}}
                                                                : </strong> {{session()->get('coupon')['discount_amount']}}{{__('EGP')}}
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <strong>{{__('Grand Total')}}
                                                                : </strong> <span
                                                                id="cart_total">{{session()->get('coupon')['total_amount']}}</span>{{__('EGP')}}
                                                        </li>
                                                    @else
                                                        <li>
                                                            <strong>{{__('Grand Total')}}: </strong> <span
                                                                id="cart_total">{{$cartTotal}}</span>{{__('EGP')}}
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- checkout-progress-sidebar -->
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.checkout-box -->
                </div><!-- /.container -->
            </div><!-- /.body-content -->
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="division_id"]').on('change', function () {
                var city_id = $(this).val();
                if (city_id) {
                    $.ajax({
                        url: "{{  url('/shipping/district/ajax') }}/" + city_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="district_id"]').empty();//.append('<option value="null" selected="" >{{__('Other')}}</option>');
                            $.each(data, function (key, value) {
                                $('select[name="district_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('{{__('Error')}}');
                }
            });
        });
    </script>
@endsection
