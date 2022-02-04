<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        @auth
                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'financial')
                                <li>
                                    <a href="{{route('admin.dashboard')}}"><i
                                            class="icon fa fa-dashboard"></i>{{__('Dashboard')}}</a>
                                </li>
                            @elseif(auth()->user()->role === 'marketing')
                                <li>
                                    <a href="{{route('manage-product')}}"><i
                                            class="icon fa fa-dashboard"></i>{{__('Dashboard')}}</a>
                                </li>
                            @elseif(auth()->user()->role === 'shipping')
                                <li>
                                    <a href="{{route('manage-division')}}"><i
                                            class="icon fa fa-dashboard"></i>{{__('Dashboard')}}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('wishlist')}}"><i class="icon fa fa-heart"></i>{{__('Wishlist')}}</a>
                            </li>
                            <li><a href="{{route('mycart')}}"><i class="icon fa fa-shopping-cart"></i>{{__('My Cart')}}
                                </a></li>
                        @endauth
                        {{--<li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>--}}
                        @auth
                            <li><a href="{{ route('user.profile') }}"><i
                                        class="icon fa fa-user"></i>{{__('My Account')}}</a></li>
                            <li>
                                <form method="POST" class="mb-3" action="{{ route('logout') }}">
                                    @csrf
                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <i class="icon fa fa-sign-out"></i>{{ __('Log Out') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </li>
                        @else
                            <li><a href="{{route('login')}}"><i class="icon fa fa-lock"></i>{{__('Login|Register')}}</a>
                            </li>
                        @endauth
                    </ul>
                </div>
                <!-- /.cnt-account -->
                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                               data-toggle="dropdown"><span
                                    class="value">{{app()->getLocale()==='en'?'English':'العربية'}} </span><b
                                    class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (app()->getLocale()==='en')
                                    <li><a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">العربية</a>
                                    </li>
                                @else
                                    <li><a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">English</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"><a href="{{url('/')}}"> <img
                                style="border-radius: 50% !important; position: relative; top: -9px;" height="60"
                                width="60" src="{{asset('logo.png')}}"
                                alt="logo"> <span
                                style="font-size: 26px; font-family: fantasy; font-weight: bold;"><span
                                    style="color: #FDD922;">Zurro</span> <span style="color: white;">Store</span></span></a>
                    </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->
                @php
                    $categories = \App\Models\Category::orderBy('name_en', 'ASC')->get();
                    $all = \App\Models\Category::where('name_en', 'all')->first();
                @endphp
                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form action="{{route('advanced.search')}}" method="post">
                            @csrf
                            <div class="form-group control-group" style="display: flex">
                                <ul class="categories-filter animate-dropdown">
                                    <select name="category" class="form-control" style="height: 47px;">
                                        <option value="all">{{__('All')}}</option>
                                        @foreach ($categories as $category)
                                            @if ($category->name_en != 'all')
                                                <option value="{{$category->id}}">
                                                    {{app()->getLocale() === 'en'?$category->name_en:$category->name_ar}}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </ul>
                                <input class="search-field" name="search" style="width: 100%;"
                                       placeholder="{{__('Search here...')}}"/>
                                <button type="submit" style="height: 47px; margin-left: auto;"
                                        class="search-button"></button>
                            </div>
                        </form>
                    </div>
                    @error('search')
                    <span class="invalid-feedback badge-pill badge badge-danger text-center" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                @enderror
                <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"><a href="#" class="dropdown-toggle lnk-cart"
                                                           data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"><i class="glyphicon glyphicon-shopping-cart"></i></div>
                                <div class="basket-item-count"><span class="count" id="cartQty">0</span></div>
                                <div class="total-price-basket"><span class="lbl">{{__('cart')}} -</span> <span
                                        class="total-price"> <span class="value" id="cartSubTotal">0</span><span
                                            class="sign">{{__('EGP')}}</span></span></div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div id="miniCart">

                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix cart-total">
                                    <div class="{{--pull-right--}} text-center"><span
                                            class="text">{{__('Total')}} :</span><span class='price' id="cartSubTotal1">0</span>{{__('EGP')}}
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="{{route('mycart')}}"
                                       class="btn btn-upper btn-primary btn-block m-t-20">{{__('Checkout')}}</a></div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div id="navbar" class="header-nav animate-dropdown" style="z-index:2;">
        <div class="{{--container--}}">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                            class="icon-bar"></span> <span class="icon-bar"></span></button>
                </div>

                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="{{Route::is('home')?'active':''}} dropdown yamm-fw"><a
                                        href="{{route('home')}}">{{__('Home')}}</a>
                                </li>
                                @if ($all)
                                    <li class="dropdown yamm-fw">
                                        <a href="{{route('products.by.category',$all->id)}}">
                                            {{app()->getLocale() === 'en'?$all->name_en:$all->name_ar}}
                                        </a>
                                    </li>
                                @endif
                                @foreach ($categories as $category)
                                    @if ($category->name_en != 'all')
                                        <li class="dropdown"><a href="{{route('products.by.category',$category->id)}}"
                                                                class="dropdown-toggle" data-hover="dropdown"
                                                {{--data-toggle="dropdown"--}}>{{app()->getLocale() === 'en'?$category->name_en:$category->name_ar}}</a>
                                        </li>
                                    @endif
                                @endforeach
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-hover="dropdown"
                                                        data-toggle="dropdown">{{__('Other')}}</a>
                                    <ul class="dropdown-menu pages">
                                        <li>
                                            <a href="{{route('special.offer')}}">{{__('Special Offer')}}</a>
                                        </li>
                                        <li>
                                            <a href="{{route('best.seller')}}">{{__('Best Seller')}}</a>
                                        </li>
                                    </ul>
                                </li>
                                {{--<li class="dropdown  navbar-right special-menu"><a href="#">Todays offer</a></li>--}}
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
