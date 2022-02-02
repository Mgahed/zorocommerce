@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">
                    <div class="col-md-12 col-sm-12 sign-in">
                        <h5 class="">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</h5>
                        <br>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <div class="font-weight-bold"><b>{{ __('auth.Whoops! Something went wrong.') }}</b></div>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <hr>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="email">{{ __('Email') }}</label>
                                <input class="form-control unicase-form-control text-input" id="email" type="email"
                                       name="email"
                                       value="{{old('email')}}" required autofocus/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
@endsection
