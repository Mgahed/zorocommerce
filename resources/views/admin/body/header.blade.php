<header class="main-header">
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-30">
        <!-- Sidebar toggle button-->
        <div>
            <ul class="nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon"
                       data-toggle="push-menu" role="button">
                        <i class="nav-link-icon mdi mdi-menu"></i>
                    </a>
                </li>
                {{--<li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                       class="waves-effect waves-light nav-link rounded svg-bt-icon" title="Full Screen">
                        <i class="nav-link-icon mdi mdi-crop-free"></i>
                    </a>
                </li>--}}
                <li class="btn-group nav-item">
                    <a class="waves-effect waves-light nav-link rounded svg-bt-icon" title="{{__('Home')}}"
                       href="{{route('home')}}"><i
                            class="nav-link-icon mdi mdi-home text-muted mr-2"></i></a>
                </li>
                <li class="btn-group nav-item">
                    <a class="waves-effect waves-light nav-link rounded svg-bt-icon" onclick="openModalLogo()"
                       href="#"><i
                            class="nav-link-icon mdi mdi-image-area text-muted mr-2"></i></a>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                @if (app()->getLocale()==='en')
                    <li class="btn-group nav-item" style="margin-top: 10px;">
                        <a rel="alternate" style="width: 100%" hreflang="ar"
                           class="waves-effect waves-light nav-link rounded dropdown-toggle p-0"
                           href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"><i title="العربية"
                                                                                                      class="flag-icon flag-icon-eg"></i></a>
                    </li>
                @else
                    <li class="btn-group nav-item" style="margin-top: 10px;">
                        <a rel="alternate" style="width: 100%" hreflang="en"
                           class="waves-effect waves-light nav-link rounded dropdown-toggle p-0"
                           href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"><i title="English"
                                                                                                      class="flag-icon flag-icon-us"></i></a>
                    </li>
                @endif
                @php
                    $products = \App\Models\Product::where('quantity','<=',5)->get();
                @endphp
            <!-- Notifications -->
                @if ($products->count())
                    <li class="dropdown notifications-menu">
                        <a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown"
                           title="{{__('Notifications')}}">
                            <i class="ti-bell"></i>
                        </a>
                        <ul class="dropdown-menu animated bounceIn">
                            <li class="header">
                                <div class="p-20">
                                    <div class="flexbox">
                                        <div>
                                            <h4 class="mb-0 mt-0">{{__('Notifications')}}</h4>
                                        </div>
                                        {{--<div>
                                            <a href="#" class="text-danger">Clear All</a>
                                        </div>--}}
                                    </div>
                                </div>
                            </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu sm-scrol">
                                    <li>
                                        <a href="{{route('in.notification')}}"
                                           title="{{__('There is ')}}{{$products->count()}}{{__(' products will almost finish.')}}">
                                            <i class="fa fa-shopping-basket text-danger"></i>
                                            {{__('There is ')}}{{$products->count()}}{{__(' products will almost finish.')}}
                                        </a>
                                    </li>
                                    {{--<li>
                                        <a href="#" title="{{__('Don\'t forget to renew domain subscription')}}">
                                            <i class="fa fa-warning text-warning"></i>
                                            {{__('Don\'t forget to renew domain subscription')}}
                                        </a>
                                    </li>--}}
                                </ul>
                            </li>
                            {{--<li class="footer">
                                <a href="#">View all</a>
                            </li>--}}
                        </ul>
                    </li>
            @endif
            <!-- User Account-->
                <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown"
                       title="User">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            {{--                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">--}}
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->name }}"/>
                            {{--                            </button>--}}
                        @else
                            <span class="inline-flex rounded-md">
{{--                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">--}}
                                <div id="name" class="d-none">{{ Auth::user()->name }}</div>
                                <div id="profileImage"></div>
                                        {{--<svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>--}}
                                {{--                                    </button>--}}
                                </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <form method="POST" class="mb-3" action="{{ route('logout') }}">
                                @csrf
                                <x-jet-dropdown-link style="width: 105% !important;" href="{{ route('logout') }}"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    <i class="ti-lock text-muted mr-2"></i> {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </li>
                        <li class="user-body"><a href="{{route('light.theme')}}">Light</a></li>
                        <li class="user-body"><a href="{{route('dark.theme')}}">Dark</a></li>
                        <li class="user-body"><a href="{{route('mint.theme')}}">Mint</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
<!-- Modal -->
<div class="modal center-modal fade" id="modal-center-logo" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Change logo')}}</h5>
                <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('change.logo')}}" method="post" enctype="multipart/form-data">
                    <h5>{{__('Select image')}} <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="file" accept="image/png, image/jpg, image/jpeg, image/gif" name="img" class="form-control" required>
                        @error('img')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-rounded btn-primary float-right" value="{{__('Save')}}">
                </form>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button onclick="dismiss()" type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">
                    {{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<script>
    function openModalLogo() {
        $('#modal-center-logo').modal('show');
    }

    function dismiss() {
        $('#modal-center-logo').modal('hide');
    }
</script>
