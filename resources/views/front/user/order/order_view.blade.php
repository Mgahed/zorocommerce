@extends('front.main_master')
@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('front.common.user_sidebar')

                <div class="col-md-2">
                </div>

                <div class="col-md-8">

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>

                            <tr style="background: #e2e2e2;">
                                <td class="col-md-1">
                                    <label for=""> {{__('Date')}}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> {{__('Total')}}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> {{__('Payment')}}</label>
                                </td>


                                <td class="col-md-2">
                                    <label for=""> {{__('Invoice')}}</label>
                                </td>

                                <td class="col-md-2">
                                    <label for=""> {{__('Order status')}}</label>
                                </td>

                                <td class="col-md-1">
                                    <label for=""> {{__('Action')}} </label>
                                </td>

                            </tr>


                            @foreach($orders as $order)
                                <tr>
                                    <td class="col-md-1">
                                        <label for=""> {{ $order->created_at }}</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> {{ $order->amount }}{{__('EGP')}}</label>
                                    </td>


                                    <td class="col-md-3">
                                        <label for=""> {{ $order->payment_method }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> {{ $order->invoice_number }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">
                                            <span class="badge badge-pill {{$order->status === 'delivered' || $order->status === 'shipped' || $order->status === 'returned' ?'badge-success':'badge-warning'}}"
                                                  style="background: #800080;">{{__($order->status)}}</span>
                                            {{--@if($order->status === 'pending')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #800080;"> Pending </span>
                                            @elseif($order->status === 'confirm')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #0000FF;"> Confirm </span>

                                            @elseif($order->status === 'processing')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #FFA500;"> Processing </span>

                                            @elseif($order->status === 'picked')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #808000;"> Picked </span>

                                            @elseif($order->status === 'shipped')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #808080;"> Shipped </span>

                                            @elseif($order->status === 'delivered')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #008000;"> Delivered </span>

                                            @elseif($order->status === 'returned')
                                                <span class="badge badge-pill badge-warning"
                                                      style="background:red;">Return Requested </span>


                                            @else
                                                <span class="badge badge-pill badge-warning"
                                                      style="background: #FF0000;"> Cancel </span>

                                            @endif--}}
                                        </label>
                                    </td>

                                    <td class="col-md-1">
                                        <a href="{{ route('OrderDetails',$order->id ) }}"
                                           class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> {{__('View')}}</a>

                                        <a target="_blank" href="{{ route('InvoiceDownload',$order->id ) }}"
                                           class="btn btn-sm btn-danger" style="margin-top: 5px;"><i
                                                class="fa fa-download" style="color: white;"></i> {{__('Invoice')}} </a>

                                    </td>

                                </tr>
                            @endforeach


                            </tbody>

                        </table>

                    </div>


                </div> <!-- / end col md 8 -->


            </div> <!-- // end row -->

        </div>

    </div>


@endsection
