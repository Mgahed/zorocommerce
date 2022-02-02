@php
    $social = \App\Models\SocialMedia::find(1);
@endphp
<footer id="footer" class="footer color-bg">
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="module-heading">
                        <h4 class="module-title">{{__('Contact us')}}</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class="toggle-footer" style="">
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                            class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <a href="{{$social->google_map_address}}"><p>{{$social->address}}</p></a>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                            class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body">
                                    <a href="tel:+2{{$social->number}}"><p>{{$social->number}}</p></a>
                                </div>
                            </li>
                            <li class="media">
                                <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                            class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span></div>
                                <div class="media-body"><span><a
                                            href="mailto:{{$social->email}}">{{$social->email}}</a></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="module-heading">
                        <h4 class="module-title">{{__('User pages')}}</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="{{ route('user.profile') }}">{{__('My Account')}}</a></li>
                            <li><a href="{{ route('my.orders') }}">{{__('Order History')}}</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="module-heading">
                        <h4 class="module-title">{{__('Why us')}}</h4>
                    </div>
                    <!-- /.module-heading -->

                    <div class="module-body">
                        <ul class='list-unstyled'>
                            <li class="first"><a href="{{route('about-us')}}">{{__('About us')}}</a></li>
                            <li><a href="{{route('contact-us')}}">{{__('Contact us')}}</a></li>
                        </ul>
                    </div>
                    <!-- /.module-body -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-padding social">
                <ul class="link">
                    <link rel="stylesheet" href="{{asset('fontawesome6/css/all.css')}}">
                    @if ($social->facebook)
                        <li class="fb pull-left"><a target="_blank" rel="nofollow" href="{{$social->facebook}}" title="Facebook"></a></li>
                    @endif
                    @if ($social->instagram)
                        <li class="instagram pull-left"><a target="_blank" rel="nofollow" href="{{$social->instagram}}" title="Instagram"></a></li>
                    @endif
                    @if ($social->tiktok)
                        <li class="tiktok pull-left"><a target="_blank" rel="nofollow" href="{{$social->tiktok}}" title="Tiktok"></a></li>
                    @endif
                    @if ($social->youtube)
                        <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="{{$social->youtube}}" title="Youtube"></a></li>
                    @endif
                    @if ($social->whatsapp)
                        <li class="whatsapp pull-left"><a target="_blank" rel="nofollow" href="{{$social->whatsapp}}" title="Whatsapp"></a></li>
                    @endif
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 no-padding">
                <div class="clearfix payment-methods" style="color: aliceblue;">
                    &copy; {{\Carbon\Carbon::now()->year}} {{__('Made by')}} <a target="_blank"
                                                                                href="https://business.mrtechnawy.com">Mr
                        Technawy</a> {{__('All Rights Reserved.')}}
                </div>
                <!-- /.payment-methods -->
            </div>
        </div>
    </div>
</footer>
