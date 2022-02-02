@php
    $about = \App\Models\About::find(1);
@endphp
@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="contact-page">
                <div class="row">
                    <div class="col-md-12">
                        {!! app()->getLocale() == 'en' ? $about->description_en : $about->description_ar !!}
                    </div>
                </div>
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
