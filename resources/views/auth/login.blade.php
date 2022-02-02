@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <!-- Sign-in -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">{{__('Sign in')}}</h4>
                        <p class="">{{__('Hello, Welcome to your account.')}}</p>
                        {{--<div class="social-sign-in outer-top-xs">
                            <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with
                                Facebook</a>
                            <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                        </div>--}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail1">{{__('Email Address')}}
                                    <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input"
                                       id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="exampleInputPassword1">{{__('Password')}} <span>*</span></label>
                                <input type="password" name="password"
                                       class="form-control unicase-form-control text-input"
                                       id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="radio outer-xs">
                                <a href="{{ route('password.request') }}" class="forgot-password pull-left">
                                    {{__('Forgot your Password?')}}</a>
                            </div>
                            <button type="submit"
                                    class="btn-upper btn btn-primary checkout-page-button">{{__('Login')}}</button>
                        </form>
                    </div>
                    <!-- Sign-in -->

                    <!-- create a new account -->
                    <div class="col-md-6 col-sm-6 create-new-account">
                        <h4 class="checkout-subtitle">{{__('Create a new account')}}</h4>
                        <p class="text title-tag-line">{{__('Create your new account')}}</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="name">{{__('Name')}} <span>*</span></label>
                                <input type="text" name="name" class="form-control unicase-form-control text-input"
                                       id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="email">{{__('Email Address')}} <span>*</span></label>
                                <input type="email" name="email" class="form-control unicase-form-control text-input"
                                       id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="phone">{{__('Phone Number')}} <span>*</span></label>
                                <input type="text" name="phone" class="form-control unicase-form-control text-input"
                                       id="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="address">{{__('Detailed Address')}} <span>*</span></label>
                                <textarea type="text" name="address" class="form-control unicase-form-control text-input"
                                       id="address" placeholder="{{__('City / District / Street / Building / Floor / Apartment')}}"
                                          autocomplete="off" required>{{old('address')}}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">{{__('Password')}} <span>*</span></label>
                                <input type="password" name="password"
                                       class="form-control unicase-form-control text-input"
                                       id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">{{__('Confirm Password')}}
                                    <span>*</span></label>
                                <input type="password" name="password_confirmation"
                                       class="form-control unicase-form-control text-input"
                                       id="password_confirmation">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit"
                                    class="btn-upper btn btn-primary checkout-page-button">{{__('Sign Up')}}
                            </button>
                        </form>


                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection










{{--<x-guest-layout>--}}
{{--    <x-jet-authentication-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <x-jet-authentication-card-logo />--}}
{{--        </x-slot>--}}

{{--        <x-jet-validation-errors class="mb-4" />--}}

{{--        @if (session('status'))--}}
{{--            <div class="mb-4 font-medium text-sm text-green-600">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-jet-label for="email" value="{{ __('Email') }}" />--}}
{{--                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="mt-4">--}}
{{--                <x-jet-label for="password" value="{{ __('Password') }}" />--}}
{{--                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="flex items-center">--}}
{{--                    <x-jet-checkbox id="remember_me" name="remember" />--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-jet-button class="ml-4">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-jet-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-jet-authentication-card>--}}
{{--</x-guest-layout>--}}
