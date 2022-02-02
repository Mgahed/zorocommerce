{{--@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))--}}
@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="x-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <h1>404</h1>
                        <p>{{__('We are sorry, the page you\'ve requested is not available.')}} </p>
                        <a href="{{route('home')}}"><i class="fa fa-home"></i>{{__('Go To Homepage')}}</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
