@extends('front.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('front.common.user_sidebar')

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h4>{{__('Shipping Details')}}</h4></div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> {{__('Shipping Name')}}:</th>
                                    <th> {{ $order->name }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Shipping Phone')}}:</th>
                                    <th> {{ $order->phone }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Shipping Email')}}:</th>
                                    <th> {{ $order->email }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Order Address')}}:</th>
                                    <th> {{app()->getLocale() === 'en'?$order->division->name_en:$order->division->name_ar }}
                                        , {{$order->address}} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Order Date')}}:</th>
                                    <th> {{ $order->created_at }} </th>
                                </tr>

                            </table>


                        </div>

                    </div>

                </div> <!-- // end col md -5 -->


                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"><h4>{{__('Order Details')}}
                                <span class="text-danger"> {{__('Invoice')}} : {{ $order->invoice_number }}</span></h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
                            <table class="table">
                                <tr>
                                    <th> {{__('Name')}}:</th>
                                    <th> {{ $order->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Phone')}}:</th>
                                    <th> {{ $order->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Payment method')}}:</th>
                                    <th> {{ $order->payment_method }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Invoice')}}:</th>
                                    <th class="text-danger"> {{ $order->invoice_number }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Total')}}:</th>
                                    <th>{{ $order->amount }}{{__('EGP')}} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Order status')}} :</th>
                                    <th>
                                        <span class="badge badge-pill badge-warning"
                                              style="background: #418DB9;">{{ __($order->status) }} </span></th>
                                </tr>


                            </table>


                        </div>

                    </div>

                </div> <!-- // 2ND end col md -5 -->


                <div class="row">


                    <div class="col-md-12">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                <tr style="background: #e2e2e2;">
                                    <td class="col-md-1">
                                        <label for=""> {{__('Image')}}</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> {{__('Product Name')}} </label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> {{__('Product Code')}}</label>
                                    </td>


                                    <td class="col-md-2">
                                        <label for=""> {{__('Color')}} </label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> {{__('Quantity')}} </label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> {{__('Price')}} </label>
                                    </td>

                                    {{--<td class="col-md-1">
                                        <label for=""> Download </label>
                                    </td>--}}

                                </tr>


                                @foreach($orderItem as $item)
                                    <tr>
                                        @if ($item->product)
                                            <td class="col-md-1">
                                                <label for=""><img src="{{ asset($item->product->thumbnail) }}"
                                                                   height="50px;" width="50px;"> </label>
                                            </td>

                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->name_en }}</label>
                                            </td>


                                            <td class="col-md-3">
                                                <label for=""> {{ $item->product->code }}</label>
                                            </td>
                                        @else
                                            <td class="col-md-3">{{__('Deleted product')}}</td>
                                            <td class="col-md-3">{{__('Deleted product')}}</td>
                                            <td class="col-md-3">{{__('Deleted product')}}</td>
                                        @endif
                                        <td class="col-md-2">
                                            <label for=""> {{ $item->color }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->qty }}</label>
                                        </td>

                                        <td class="col-md-2">
                                            <label for=""> {{ $item->price }}{{__('EGP')}}
                                                ({{ $item->price * $item->qty}}{{__('EGP')}}) </label>
                                        </td>
                                        {{--@php
                                            $file = App\Models\Product::where('id',$item->product_id)->first();
                                        @endphp

                                        <td class="col-md-1">
                                            @if($order->status === 'pending')
                                                <strong>
                                                    <span class="badge badge-pill badge-success"
                                                          style="background: #418DB9;"> No File</span> </strong>

                                            @elseif($order->status === 'confirm')

                                                <a target="_blank"
                                                   href="{{ asset('upload/pdf/'.$file->digital_file) }}">
                                                    <strong>
                                                        <span class="badge badge-pill badge-success"
                                                              style="background: #FF0000;"> Download Ready</span>
                                                    </strong> </a>
                                            @endif
                                        </td>--}}

                                    </tr>
                                @endforeach


                                </tbody>

                            </table>

                        </div>


                    </div> <!-- / end col md 8 -->

                </div> <!-- // END ORDER ITEM ROW -->

                @if ($order->status === 'pending')
                    <a href="{{route('cancel.order',$order->id)}}" class="btn btn-warning">
                        <i class="fa fa-times-circle"></i> {{__('Cancel order')}}
                    </a>
                @endif

                @if($order->status !== "delivered" && \Carbon\Carbon::now()->diffInDays($order->dilivered_date)<=14)

                @else

                    @php
                        $order = App\Models\Order::where('id',$order->id)->where('return_reason','=',NULL)->first();
                    @endphp


                    @if($order)
                        <form action="{{ route('return.order',$order->id) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="label"> {{__('Order Return Reason:')}}</label>
                                <textarea name="return_reason" id="" class="form-control" cols="30" rows="05"
                                          placeholder=""></textarea>
                            </div>

                            <button type="submit" class="btn btn-danger">{{__('Return Order')}}</button>

                        </form>
                    @else

                        <span class="badge badge-pill badge-warning" style="background: red">You Have send return request for this order</span>

                    @endif



                @endif
                <br><br>


            </div> <!-- // end row -->

        </div>

    </div>


@endsection
