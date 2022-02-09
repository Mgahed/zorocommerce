<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale() === 'en' ? 'ltr' : 'rtl'}}">
<head>
<!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @inject('SEO', 'App\Traits\seoclass')
    @if (\Request::route()->getName() !== 'product.details')
        @php($SEO->SEOTrait())
    @endif

    {!! SEO::generate() !!}
    <meta name="author" content="">
    <link rel="icon" href="{{asset('logo.png')}}">
    <meta name="robots" content="all">
    @if (app()->getLocale() === 'en')
        <style>
            .float-right {
                float: right !important
            }
        </style>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">

        <!-- Customizable CSS -->
        <link rel="stylesheet" href="{{asset('front/assets/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/owl.transitions.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/rateit.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap-select.min.css')}}">

        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{asset('front/assets/css/font-awesome.css')}}">
    @else
        <style>
            .float-right {
                float: left !important
            }
        </style>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_bootstrap.css')}}">

        <!-- Customizable CSS -->
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_main.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_owl.carousel.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_owl.transitions.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_animate.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_rateit.css')}}">
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_bootstrap-select.css')}}">

        <!-- Icons/Glyphs -->
        <link rel="stylesheet" href="{{asset('front/assets/css/rtl_font-awesome.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('front/assets/css/themes/dark.css')}}">


    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
          rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    {{-- toaster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <style>
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }
    </style>
    <style>
        #profileImage {
            width: 133px;
            height: 133px;
            border-radius: 50%;
            background: #157ED2;
            color: #FDD922;
            text-align: center;
            line-height: 130px;
            font-size: 50px;
        }
    </style>
    <style>
        .my-d-none {
            display: none !important;
        }

        .my-d-block {
            display: block !important;
        }

        @media (min-width: 576px) {
            .my-d-sm-block {
                display: block !important;
            }

            .my-d-sm-none {
                display: none !important;
            }
        }
    </style>
</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
@include('front.body.header')

<!-- ============================================== HEADER : END ============================================== -->
@yield('content')
<!-- /#top-banner-and-menu -->

<!-- ============================================================= FOOTER ============================================================= -->
@include('front.body.footer')
<!-- ============================================================= FOOTER : END============================================================= -->

<!-- For demo purposes – can be removed on production -->

<!-- For demo purposes – can be removed on production : End -->

<!-- JavaScripts placed at the end of the document so the pages load faster -->
<script src="{{asset('front/assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
@if (app()->getLocale() === 'en')
    <script src="{{asset('front/assets/js/owl.carousel.min.js')}}"></script>
@else
    <script src="{{asset('front/assets/js/rtl_owl.carousel.js')}}"></script>
@endif
<script src="{{asset('front/assets/js/echo.min.js')}}"></script>
<script src="{{asset('front/assets/js/jquery.easing-1.3.min.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap-slider.min.js')}}"></script>
<script src="{{asset('front/assets/js/jquery.rateit.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front/assets/js/lightbox.min.js')}}"></script>
<script src="{{asset('front/assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('front/assets/js/wow.min.js')}}"></script>
<script src="{{asset('front/assets/js/scripts.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- truncate --}}
<script>
    (function () {
        var showChar = 700;
        var ellipsestext = "...........";
        if ($('html').attr('lang') == "ar") {
            var readMore = 'اقرأ المزيد +';
            var readLess = 'اقرأ اقل -';
        } else {
            readMore = 'Read More +';
            readLess = 'Read Less -';
        }

        $(".truncate").each(function () {
            var content = $(this).html();
            if (content.length > showChar) {
                var c = content.substr(0, showChar);
                var h = content;
                var html =
                    '<div class="truncate-text" style="display:block">' +
                    c +
                    '<span class="moreellipses">' +
                    ellipsestext +
                    '&nbsp;&nbsp;<br><br><span style="white-space: nowrap;"><a href="" class="moreless more btn-sm btn-primary" style="color: #fff;">' + readMore + '</a></span></span></span></div><div class="truncate-text" style="display:none">' +
                    h +
                    '<br><br><span style="white-space: nowrap;"><a href="" class="moreless less btn-sm btn-primary" style="color: #fff;">' + readLess + '</a></span></span></div>';

                $(this).html(html);
            }
        });

        $(".moreless").click(function () {
            var thisEl = $(this);
            var cT = thisEl.closest(".truncate-text");
            var tX = ".truncate-text";

            if (thisEl.hasClass("less")) {
                cT.prev(tX).toggle();
                cT.slideToggle();
            } else {
                cT.toggle();
                cT.next(tX).fadeToggle();
            }
            return false;
        });
        /* end iffe */
    })();
</script>

<script>
    window.onscroll = function () {
        myFunction()
    };

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    }
</script>

{{-- toaster --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}"
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}")
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}")
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}")
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}")
            break;
    }
    @endif
</script>

{{----- Add to cart modal -----}}
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="add_to_cart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span style="font-weight: bold;" id="pname"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="" id="pimage" class="card-img-top" alt="{{__('Product')}}" height="170px"
                                 width="100%">
                            <br><br>
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">{{__('Price')}}:
                                <span style="font-weight: bold;" class="text-danger" id="pprice"></span>
                                <del style="font-weight: bold;" id="poldprice"></del>
                            </li>
                            <li class="list-group-item">{{__('Brand')}}: <span style="font-weight: bold;"
                                                                               id="pbrand"></span></li>
                            <li class="list-group-item">{{__('Stock')}}: <span style="font-weight: bold;"
                                                                               id="pstock"></span></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="select_color">{{__('Select color')}}</label>
                            <select class="form-control" id="select_color" name="color">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{__('Quantity')}}</label>
                            <input type="number" class="form-control" id="quantity" value="1" min="1" max=""
                                   name="quantity"
                                   autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="product_id">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="closeModel">{{__('Close')}}</button>
                <button type="submit" id="add_to_cart_submit" class="btn btn-primary"
                        onclick="addToCart()">{{__('Add to cart')}}</button>
            </div>
        </div>
    </div>
</div>
{{----- End Add to cart modal -----}}
<script>
    $(document).ready(function () {
        var intials = $('#name').text().charAt(0);
        var profileImage = $('#profileImage').text(intials);
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    /*----- Product view -----*/
    function productView(id) {
        $('#product_id').val('')
        $('#pname').text('')
        $('#pprice').text('')
        $('#poldprice').text('')
        $('#pbrand').text('')
        $('#pimage').attr('src', '')
        $('#add_to_cart_submit').addClass('hide');
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/' + id,
            dataType: 'json',
            success: function (data) {
                $('#quantity').attr('max', data.product.quantity)
                if (data.product.quantity <= 0) {
                    $('#add_to_cart_submit').hide();
                } else {
                    $('#add_to_cart_submit').removeClass('hide');
                    $('#add_to_cart_submit').show();
                }
                /*console.log(data)*/
                $('#product_id').val(data.product.id)
                $('#quantity').val(1);
                $('#pname').text(data.product.name_{{app()->getLocale()}})
                if (data.product.discount_price !== null) {
                    $('#pprice').text(data.product.discount_price)
                    $('#poldprice').text(data.product.sell_price)
                } else {
                    $('#pprice').text(data.product.sell_price)
                    $('#poldprice').text('')
                }
                $('#pbrand').text(data.product.brand)

                let quan = data.product.quantity
                if (quan > 0) {
                    $('#pstock').text('{{__('In stock')}}')
                    $('#pstock').removeClass('badge badge-danger')
                    $('#pstock').addClass('badge badge-success')
                } else {
                    $('#pstock').text('{{__('Not available')}}')
                    $('#pstock').removeClass('badge badge-success')
                    $('#pstock').addClass('badge badge-danger')
                }

                $('#pimage').attr('src', '/' + data.product.thumbnail)

                $('select[name="color"]').empty();
                $.each(data.color, function (key, value) {
                    $('select[name="color"]').append('<option value="' + value + '">' + value + '</option>')
                })
            }
        })
    }

    /*----- End Product view -----*/

    /*----- Add to cart -----*/
    function addToCart() {
        let name = $('#pname').text();
        let id = $('#product_id').val();
        let price = $('#pprice').text();
        let color = $('#select_color option:selected').text();
        let quantity = $('#quantity').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                color: color,
                name: name,
                price: price,
                quantity: quantity,
                lang: $('html').attr('lang')
            },
            url: '/cart/data/store/' + id,
            success: function (data) {
                miniCart();
                $('#closeModel').click()
                /*console.log(data)*/
                const toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    toast.fire({
                        type: 'success',
                        title: data.success,
                        icon: 'success'
                    })
                } else {
                    toast.fire({
                        type: 'error',
                        title: data.error,
                        icon: 'error'
                    })
                }
            }
        })
    }

    function addcToCart() {
        let name = $('#pcname').text();
        let id = $('#cproduct_id').val();
        let price = $('#pcprice').text();
        let color = $('#cselect_color option:selected').text();
        let quantity = $('#cquantity').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                color: color,
                name: name,
                price: price,
                quantity: quantity,
                lang: $('html').attr('lang')
            },
            url: '/cart/data/store/' + id,
            success: function (data) {
                miniCart();
                $('#closeModel').click()
                /*console.log(data)*/
                const toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    toast.fire({
                        type: 'success',
                        title: data.success,
                        icon: 'success'
                    })
                } else {
                    toast.fire({
                        type: 'error',
                        title: data.error,
                        icon: 'error'
                    })
                }
            }
        })
    }

    /*----- End Add to cart -----*/

    function miniCart() {
        $.ajax({
            type: "GET",
            url: '/cart/mini',
            dataType: 'json',
            success: function (response) {
                let miniCart = ""
                $('#cartQty').text(response.cartQty);
                $('#cartSubTotal').text(response.cartTotal);
                $('#cartSubTotal1').text(response.cartTotal);
                $.each(response.carts, function (key, value) {
                    miniCart += '<div class="cart-item product-summary"> <div class="row"> <div class="col-xs-4"> <div class="image"><a href="/product/details/' + value.options.product_id + '"><img src="/' + value.options.image + '"alt="' + value.name + '"></a></div> </div> <div class="col-xs-7"> <h3 class="name"><a href="/product/details/' + value.options.product_id + '">' + value.name + '</a></h3> <div class="price">' + value.price + '{{__('EGP')}} * ' + value.qty + '</div> </div> <div class="col-xs-1 action"><a href="/cart/mini/product-remove/' + value.rowId + '"><i class="fa fa-trash"></i></a> </div> </div> </div><div class="clearfix"></div> <hr>';
                });
                $('#miniCart').html(miniCart)
            }
        })
    }

    miniCart();

    /*----- Add to wishlist -----*/
    function addToWishlist(product_id) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '/wishlist/add/' + product_id,
            data: {
                lang: $('html').attr('lang')
            },
            success: function (data) {
                const toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    icon: 'success'
                })
                if ($.isEmptyObject(data.error)) {
                    toast.fire({
                        type: 'success',
                        title: data.success,
                        icon: 'success'
                    })
                } else {
                    toast.fire({
                        type: 'error',
                        title: data.error,
                        icon: 'error'
                    })
                }
            }
        })
    }

    /*----- End Add to wishlist -----*/

    /*----- Apply coupon -----*/
    function apply_coupon() {
        let coupon_name = $('#coupon_name').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "{{route('apply.coupon')}}",
            data: {
                coupon_name: coupon_name,
                lang: $('html').attr('lang')
            },
            success: function (data) {
                const toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    icon: 'success'
                })
                if ($.isEmptyObject(data.error)) {
                    $('#has_coupon').hide();
                    couponCalculation();
                    toast.fire({
                        type: 'success',
                        title: data.success,
                        icon: 'success'
                    })
                } else {
                    toast.fire({
                        type: 'error',
                        title: data.error,
                        icon: 'error'
                    })
                }
            }
        });
    }

    function couponCalculation() {
        $.ajax({
            type: 'GET',
            url: "{{route('coupon.calculation')}}",
            dataType: 'json',
            success: function (data) {
                if (data.total) {
                    $('#couponCalField').html('<tr><th><div class="cart-grand-total">{{__("Grand Total")}}<span class="float-right"><span id="cart_total">' + data.total + '</span>{{__('EGP')}}</span></div></th></tr>')
                } else {
                    $('#couponCalField').html('<tr><th><div class="cart-sub-total">{{__('Subtotal')}}<span class="float-right"><span id="cart_sub_total">' + data.subtotal + '</span>{{__('EGP')}}</span></div><div class="cart-sub-total">{{__('Coupon')}}<span class="float-right"><span>' + data.coupon_name + '</span> <a href="{{route('coupon.remove')}}"><i class="fa fa-times"></i></a></span></div> <div class="cart-sub-total">{{__('Discount')}}<span class="float-right"><span>' + data.discount_amount + '</span>{{__('EGP')}}</span></div><div class="cart-grand-total">{{__("Grand Total")}}<span class="float-right"><span id="cart_total">' + data.total_amount + '</span>{{__('EGP')}}</span></div></th></tr>')
                }
            }
        });
    }

    couponCalculation();
    /*----- End Apply coupon -----*/

</script>

</body>
</html>
