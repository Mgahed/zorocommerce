<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="/admin">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="rounded-circle" src="{{asset('logo.png')}}" width="50" height="50" alt="">
                        <h3><b>Zoro</b> Store</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'financial')
                <li class="{{Request::is(app()->getLocale().'/admin') ? 'active' : ''}}">
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="pie-chart"></i>
                        <span>{{__('Dashboard')}}</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role === 'admin')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/category/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="ti-layout-list-thumb-alt"></i> <span>{{__('Category')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/category/view') ? 'active' : ''}}"><a
                                href="{{route('all.category')}}"><i class="ti-more"></i>{{__('All categories')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'marketing')
                    <li class="{{Request::is(app()->getLocale().'/admin/free-shipping') ? 'active' : ''}}">
                        <a href="{{route('free.shipping')}}">
                            <i class="mdi mdi-truck-delivery" style="{{Request::is(app()->getLocale().'/admin/free-shipping') ? 'color: white;' : ''}}"></i>
                            <span>{{__('Free shipping')}}</span>
                        </a>
                    </li>
                <li class="treeview {{Request::is(app()->getLocale().'/admin/product/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-shopping-basket"></i> <span>{{__('Products')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/product/add') ? 'active' : ''}}"><a
                                href="{{route('add-product')}}"><i class="ti-more"></i>{{__('Add products')}}</a></li>
                        <li class="{{Request::is(app()->getLocale().'/admin/product/edit/*') ? 'active' : ''}}{{Request::is(app()->getLocale().'/admin/product/manage') ? 'active' : ''}}">
                            <a
                                href="{{route('manage-product')}}"><i class="ti-more"></i>{{__('Manage products')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'marketing')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/slider/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="ti-layout-slider"></i> <span>{{__('Slider')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/slider/*') ? 'active' : ''}}">
                            <a
                                href="{{route('manage-slider')}}"><i class="ti-more"></i>{{__('Manage slider')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'marketing')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/coupons/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-percent"></i> <span>{{__('Coupon')}}</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/coupons/percentage/*') ? 'active' : ''}}">
                            <a
                                href="{{route('manage-coupon')}}"><i class="ti-more"></i>{{__('Percentage coupons')}}
                            </a>
                        </li>
                        {{-- price coupon --}}
                        <li class="{{Request::is(app()->getLocale().'/admin/coupons/price/*') ? 'active' : ''}}">
                            <a
                                href="{{route('price.manage-coupon')}}"><i class="ti-more"></i>{{__('Price coupons')}}
                            </a>
                        </li>
                        {{-- user coupon --}}
                        <li class="{{Request::is(app()->getLocale().'/admin/coupons/user/*') ? 'active' : ''}}">
                            <a
                                href="{{route('user.manage-coupon')}}"><i class="ti-more"></i>{{__('User coupons')}}
                            </a>
                        </li>
                        {{-- product coupon --}}
                        <li class="{{Request::is(app()->getLocale().'/admin/coupons/product/*') ? 'active' : ''}}">
                            <a
                                href="{{route('product.manage-coupon')}}"><i
                                    class="ti-more"></i>{{__('Product coupons')}}
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'shipping')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/shipping/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-truck"></i> <span>{{__('Shipping Area')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/shipping/division/*') ? 'active' : ''}}">
                            <a
                                href="{{route('manage-division')}}"><i class="ti-more"></i>{{__('Shipping city')}}</a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/shipping/district/*') ? 'active' : ''}}">
                            <a
                                href="{{route('manage-district')}}"><i class="ti-more"></i>{{__('Shipping district')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'shipping')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/orders/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="mdi mdi-briefcase-check"></i> <span>{{__('Orders')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/pending/orders') ? 'active' : ''}}">
                            <a
                                href="{{route('pending-orders')}}"><i class="ti-more"></i>{{__('Pending orders')}}</a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/confirmed/*') ? 'active' : ''}}">
                            <a
                                href="{{route('confirmed-orders')}}"><i class="ti-more"></i>{{__('Confirmed orders')}}
                            </a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/processing/*') ? 'active' : ''}}">
                            <a
                                href="{{route('processing-orders')}}"><i class="ti-more"></i>{{__('Processing orders')}}
                            </a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/picked/*') ? 'active' : ''}}">
                            <a
                                href="{{route('picked-orders')}}"><i class="ti-more"></i>{{__('Picked orders')}}</a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/shipped/*') ? 'active' : ''}}">
                            <a
                                href="{{route('shipped-orders')}}"><i class="ti-more"></i>{{__('Shipped orders')}}</a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/delivered/*') ? 'active' : ''}}">
                            <a
                                href="{{route('delivered-orders')}}"><i class="ti-more"></i>{{__('Delivered orders')}}
                            </a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/orders/cancel/*') ? 'active' : ''}}">
                            <a
                                href="{{route('cancel-orders')}}"><i class="ti-more"></i>{{__('Cancelled orders')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'shipping')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/order-return/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="mdi mdi-backup-restore"></i> <span>{{__('Return orders')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/order-return/request') ? 'active' : ''}}">
                            <a
                                href="{{route('return-request-orders')}}"><i
                                    class="ti-more"></i>{{__('Return requests')}}
                            </a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/order-return/returned') ? 'active' : ''}}">
                            <a href="{{route('returned-orders')}}"><i class="ti-more"></i>{{__('Returned orders')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="header nav-small-cap">{{__('Others')}}</li>
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'financial')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/reports/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="mdi mdi-file-document"></i> <span>{{__('Reports')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/reports/*') ? 'active' : ''}}">
                            <a
                                href="{{route('all-reports')}}"><i class="ti-more"></i>{{__('All reports')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="treeview {{Request::is(app()->getLocale().'/admin/alluser/*') ? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-users"></i> <span>{{__('Users')}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{Request::is(app()->getLocale().'/admin/alluser/*') ? 'active' : ''}}">
                        <a
                            href="{{route('all-users')}}"><i class="ti-more"></i>{{__('All users')}}</a>
                    </li>
                </ul>
            </li>
            @if (auth()->user()->role === 'admin')
                <li class="treeview {{Request::is(app()->getLocale().'/admin/site-settings/*') ? 'active' : ''}}">
                    <a href="#">
                        <i class="mdi mdi-settings"></i> <span>{{__('Site settings')}}</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::is(app()->getLocale().'/admin/site-settings/seo/*') ? 'active' : ''}}">
                            <a
                                href="{{route('seo.setting')}}"><i class="ti-more"></i>{{__('SEO')}}</a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/site-settings/social-media/*') ? 'active' : ''}}">
                            <a
                                href="{{route('social.setting')}}"><i class="ti-more"></i>{{__('Footer')}}</a>
                        </li>
                        <li class="{{Request::is(app()->getLocale().'/admin/site-settings/social-media/*') ? 'active' : ''}}">
                            <a
                                href="{{route('about.setting')}}"><i class="ti-more"></i>{{__('About us')}}</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </section>

    {{--<div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
           aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
                class="ti-lock"></i></a>
    </div>--}}
</aside>
