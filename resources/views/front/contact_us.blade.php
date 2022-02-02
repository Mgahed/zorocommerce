@php
    $social = \App\Models\SocialMedia::find(1);
@endphp
@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="contact-page">
                <div class="row">
                    <div class="col-md-12 contact-map outer-bottom-vs">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d371.01845084446563!2d30.982855239013507!3d30.033781508290833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145859bd7a44e109%3A0x3217075113096c85!2z2YbYp9mB2YjYsdipINin2YTYp9mB2YI!5e0!3m2!1sen!2seg!4v1639430215253!5m2!1sen!2seg"
                            width="600" height="450" style="border:0"></iframe>
                    </div>
                    <form action="{{route('contact-us')}}" method="post">
                        @csrf
                        <div class="col-md-9 contact-form">
                            <div class="col-md-12 contact-title">
                                <h4>{{__('Contact Form')}}</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputName">{{__('Name')}}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control unicase-form-control text-input"
                                           id="exampleInputName" value="{{auth()->user()?auth()->user()->name:''}}">
                                @error('name')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">{{__('Email Address')}}
                                            <span class="text-danger">*</span></label>
                                        <input type="email" name="email"
                                               class="form-control unicase-form-control text-input"
                                               id="exampleInputEmail1" value="{{auth()->user()?auth()->user()->email:''}}">
                                @error('email')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                    </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputComments">{{__('Your Comments')}}
                                        <span class="text-danger">*</span></label>
                                    <textarea class="form-control unicase-form-control" name="msg"
                                              id="exampleInputComments"></textarea>
                                @error('msg')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-12 outer-bottom-small m-t-20">
                                <button type="submit"
                                        class="btn-upper btn btn-primary checkout-page-button">{{__('Send Message')}}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-3 contact-info">
                        <div class="contact-title">
                            <h4>{{__('Information')}}</h4>
                        </div>
                        <div class="clearfix address">
                            <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                            <span class="contact-span"><a href="{{$social->google_map_address}}"><p>{{$social->address}}</p></a></span>
                        </div>
                        <div class="clearfix phone-no">
                            <span class="contact-i"><i class="fa fa-mobile"></i></span>
                            <span class="contact-span"><a href="tel:+2{{$social->number}}">{{$social->number}}</a></span>
                        </div>
                        <div class="clearfix email">
                            <span class="contact-i"><i class="fa fa-envelope"></i></span>
                            <span class="contact-span"><a href="mailto:{{$social->email}}">{{$social->email}}</a></span>
                        </div>
                    </div>
                </div><!-- /.contact-page -->
            </div><!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            <div id="brands-carousel" class="logo-slider wow fadeInUp">


                <div class="logo-slider-inner">

                </div><!-- /.logo-slider -->
                <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
            </div><!-- /.container -->

        </div>
    </div>
@endsection
