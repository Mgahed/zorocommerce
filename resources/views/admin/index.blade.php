@extends('admin.admin_master')
@section('admin')
    <div class="container-full">
    @php
        $users = \App\Models\User::where('role','normal')->count();
        $revenue = \App\Models\Order::where('status','delivered')->whereYear('updated_at',\Carbon\Carbon::now()->year)->sum('amount');
        $orders = \App\Models\Order::where('status','delivered')->whereYear('updated_at',\Carbon\Carbon::now()->year)->count();
        $products = \App\Models\Product::all()->count();

    @endphp
    <!-- Main content -->
        <div class="container-full">
            <section class="content">
                <div class="row">
                    <div class="col-xl-6 col-6">
                        <div class="box overflow-hidden pull-up text-center">
                            <div class="box-body">
                                <center>
                                    <div class="icon bg-primary-light rounded w-60 h-60">
                                        <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                                    </div>
                                </center>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">{{__('Customers')}}</p>
                                    <h3 class="text-white mb-0 font-weight-500">{{$users}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-6">
                        <div class="box overflow-hidden pull-up text-center">
                            <div class="box-body">
                                <center>
                                    <div class="icon bg-light rounded w-60 h-60">
                                        <i class="text-white mr-0 font-size-24 mdi mdi-chart-line"></i>
                                    </div>
                                </center>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">{{__('This Year Revenue')}}</p>
                                    <h3 class="text-white mb-0 font-weight-500">{{$revenue}}{{__('EGP')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-6">
                        <div class="box overflow-hidden pull-up text-center">
                            <div class="box-body">
                                <center>
                                    <div class="icon bg-success-light rounded w-60 h-60">
                                        <i class="text-success mr-0 font-size-24 mdi mdi-cart"></i>
                                    </div>
                                </center>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">{{__('This Year Orders')}}</p>
                                    <h3 class="text-white mb-0 font-weight-500">{{$orders}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-6">
                        <div class="box overflow-hidden pull-up text-center">
                            <div class="box-body">
                                <center>
                                    <div class="icon bg-info-light rounded w-60 h-60">
                                        <i class="text-info mr-0 font-size-24 fa fa-shopping-basket"></i>
                                    </div>
                                </center>
                                <div>
                                    <p class="text-mute mt-20 mb-0 font-size-16">{{__('Products')}}</p>
                                    <h3 class="text-white mb-0 font-weight-500">{{$products}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content -->
    </div>
@endsection

<script src="{{asset('admin-dashboard/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/chart.js-master/Chart.min.js')}}"></script>
{{--<script src="{{asset('admin-dashboard/js/pages/widget-charts2.js')}}"></script>--}}
