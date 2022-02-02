@extends('admin.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="{{--page-title--}}">{{__('Order Details')}}</h3>
                    {{--<div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{__('Order Details')}}</li>

                            </ol>
                        </nav>
                    </div>--}}
                </div>
            </div>
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>{{__('Shipping Details')}}</strong></h4>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table">
                                <tr>
                                    <th> {{__('Shipping Name')}} :</th>
                                    <th> {{ $order->name }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Shipping Phone')}} :</th>
                                    <th> {{ $order->phone }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Shipping Email')}} :</th>
                                    <th> {{ $order->email }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Shipping address details')}} :</th>
                                    <th> {{ $order->division->name_en }}, {{ $order->district_id?$order->district->name_en.',':'' }} {{$order->address}} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Order Date')}} :</th>
                                    <th> {{ $order->created_at }} </th>
                                </tr>

                                @if ($order->notes)
                                    <tr>
                                        <th> {{__('Order notes')}} :</th>
                                        <th> {{ $order->notes }} </th>
                                    </tr>
                                @endif

                                @if ($order->return_reason)
                                    <tr>
                                        <th> {{__('Return reason')}} :</th>
                                        <th> {{ $order->return_reason }} </th>
                                    </tr>
                                @endif

                            </table>

                        </div>

                    </div>
                </div> <!--  // cod md -6 -->


                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>{{__('Order Details')}}:</strong><span
                                    class="text-danger"> Invoice : {{ $order->invoice_number }}</span></h4>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th> {{__('Name')}} :</th>
                                    <th> {{ $order->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Phone')}} :</th>
                                    <th> {{ $order->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Payment type')}} :</th>
                                    <th> {{ $order->payment_method }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Invoice')}} :</th>
                                    <th class="text-danger"> {{ $order->invoice_number }} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Total')}} :</th>
                                    <th>{{ $order->amount }}{{__('EGP')}} </th>
                                </tr>

                                <tr>
                                    <th> {{__('Order status')}} :</th>
                                    <th>
                                    <span class="badge badge-pill badge-warning"
                                          style="background: #418DB9;">{{ __($order->status) }} </span></th>
                                </tr>

                                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'shipping')
                                    <tr>
                                        <th></th>
                                        <th>
                                            @if($order->status === 'pending')
                                                <a href="{{ route('pending-confirm',$order->id) }}"
                                                   class="btn btn-block btn-success"
                                                   id="confirm">{{__('Confirm Order')}}</a>
                                                <br>
                                                <a href="{{ route('cancel-by-admin',$order->id) }}"
                                                   class="btn btn-block btn-danger"
                                                   id="cancel">{{__('Cancel Order')}}</a>

                                            @elseif($order->status === 'confirm')
                                                <a href="{{ route('confirm.processing',$order->id) }}"
                                                   class="btn btn-block btn-success"
                                                   id="processing">{{__('Processing Order')}}</a>

                                            @elseif($order->status === 'processing')
                                                <a href="{{ route('processing.picked',$order->id) }}"
                                                   class="btn btn-block btn-success"
                                                   id="picked">{{__('Pick Order')}}</a>

                                            @elseif($order->status === 'picked')
                                                <a href="{{ route('picked.shipped',$order->id) }}"
                                                   class="btn btn-block btn-success"
                                                   id="shipped">{{__('Ship Order')}}</a>

                                            @elseif($order->status === 'shipped')
                                                <a href="{{ route('shipped.delivered',$order->id) }}"
                                                   class="btn btn-block btn-success"
                                                   id="delivered">{{__('Delivered Order')}}</a>
                                            @elseif ($order->status === 'return requested')
                                                <a href="{{ route('return.done',$order->id) }}" class="btn btn-success">
                                                    {{__('Confirm return')}}
                                                </a>
                                            @endif

                                        </th>
                                    </tr>
                                @endif

                            </table>
                        </div>

                    </div>
                </div> <!--  // cod md -6 -->


                <div class="col-md-12 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">

                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                <tr>
                                    <td width="10%">
                                        <label for=""> {{__('Image')}}</label>
                                    </td>

                                    <td width="20%">
                                        <label for=""> {{__('Product Name')}} </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> {{__('Product Code')}}</label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> {{__('Color')}} </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> {{__('Quantity')}} </label>
                                    </td>

                                    <td width="10%">
                                        <label for=""> {{__('Price')}} </label>
                                    </td>

                                </tr>


                                @foreach($orderItem as $item)
                                    <tr>
                                        @if ($item->product)
                                            <td width="10%">
                                                <label for=""><img src="{{ asset($item->product->thumbnail) }}"
                                                                   height="50px;"
                                                                   width="50px;"> </label>
                                            </td>

                                            <td width="20%">
                                                <label for=""> {{ $item->product->name_en }}</label>
                                            </td>


                                            <td width="10%">
                                                <label for=""> {{ $item->product->code }}</label>
                                            </td>
                                        @else
                                            <td width="10%">
                                                <label class="text-danger"> {{__('Deleted product')}}</label>
                                            </td>

                                            <td width="20%">
                                                <label class="text-danger"> {{__('Deleted product')}}</label>
                                            </td>


                                            <td width="10%">
                                                <label class="text-danger"> {{__('Deleted product')}}</label>
                                            </td>
                                        @endif
                                        <td width="10%">
                                            <label for=""> {{ $item->color }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->qty }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->price }}{{__('EGP')}}
                                                ( {{ $item->price * $item->qty}}{{__('EGP')}} ) </label>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>  <!--  // cod md -12 -->
            </div>
            <!-- /. end row -->
        </section>
        <!-- /.content -->

    </div>




@endsection
