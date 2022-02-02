@extends('front.main_master')
@section('content')


    <style>
        .checked {
            color: orange;
        }
    </style>


    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                {{--<div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                    </div>
                </div><!-- /.sidebar -->--}}

                <div class='col-md-12'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-lightbox="image-1" data-title="Gallery"
                                               href="{{asset($product->thumbnail)}}">
                                                <img class="img-responsive" alt="" src="{{asset($product->thumbnail)}}"
                                                     data-echo="{{asset($product->thumbnail)}}"/>
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                        @php($i=1)
                                        @foreach ($product->multiimg as $img)
                                            <div class="single-product-gallery-item" id="slide{{++$i}}">
                                                <a data-lightbox="image-{{$i}}" data-title="{{$img->id}}"
                                                   href="{{asset($img->name)}}">
                                                    <img class="img-responsive" alt="" src="{{asset($img->name)}}"
                                                         data-echo="{{asset($img->name)}}"/>
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach

                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">

                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                   data-slide="1" href="#slide1">
                                                    <img class="img-responsive" width="85" alt=""
                                                         src="{{asset($product->thumbnail)}}"
                                                         data-echo="{{asset($product->thumbnail)}}"/>
                                                </a>
                                            </div>
                                            @php($i=1)
                                            @foreach ($product->multiimg as $img)
                                                <div class="item">
                                                    <a class="horizontal-thumb" data-target="#owl-single-product"
                                                       data-slide="{{++$i}}"
                                                       href="#slide{{$i}}">
                                                        <img class="img-responsive" width="85" alt=""
                                                             src="{{asset($img->name)}}"
                                                             data-echo="{{asset($img->name)}}"/>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div><!-- /#owl-single-product-thumbnails -->


                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name" id="pcname">{{app()->getLocale() === 'en'?$product->name_en:$product->name_ar}}</h1>
                                    <br>
                                    {{--<div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div>--}}<!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">{{__('Availability')}} :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span
                                                        class="value">{{$product->quantity?__('In stock'):__('Not available')}}</span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        {{app()->getLocale() === 'en'?$product->short_descp_en:$product->short_descp_ar}}
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price != NULL)
                                                        <div class="product-price"><span
                                                                class="price" id="pcprice">{{$product->discount_price}}</span><span>{{__('EGP')}}</span>
                                                            <span
                                                                class="price-strike">{{$product->sell_price}}{{__('EGP')}}</span>
                                                        </div>
                                                    @else
                                                        <div class="product-price"><span
                                                                class="price" id="pcprice">{{$product->sell_price}}</span><span>{{__('EGP')}}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip"
                                                       data-placement="right"
                                                       title="Wishlist" href="javascript:addToWishlist({{$product->id}})">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    {{--<a class="btn btn-primary" data-toggle="tooltip"
                                                       data-placement="right"
                                                       title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip"
                                                       data-placement="right"
                                                       title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>--}}
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->

                                    {{----- Color -----}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="info-title control-label">{{__('Color')}}
                                                    <span></span></label>
                                                <select id="cselect_color" class="form-control unicase-form-control selectpicker"
                                                        style="display: none;" required>
                                                    <option disabled>--{{__('Choose color')}}--</option>
                                                    @if (app()->getLocale() === 'en')
                                                        <?php $product_color = $product_color_en; ?>
                                                    @else
                                                        <?php $product_color = $product_color_ar; ?>
                                                    @endif
                                                    @foreach ($product_color as $color)
                                                        <option value="{{$color}}">{{$color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{----- End Color -----}}

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        {{--<div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>--}}
                                                        <input type="number" id="cquantity" min="1" value="1" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($product->quantity>0)
                                                <input type="hidden" id="cproduct_id" value="{{$product->id}}">
                                                <div class="col-sm-7">
                                                    <button type="submit" onclick="addcToCart()" class="btn btn-primary" ><i
                                                            class="fa fa-shopping-cart inner-right-vs"></i> {{__('Add to cart')}}</button>
                                                </div>
                                            @endif
                                            <br><br><br><br>

                                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                            <div class="addthis_inline_share_toolbox"></div>

                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->


                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">{{__('DESCRIPTION')}}</a></li>
                                    {{--<li><a data-toggle="tab" href="#review">{{__('REVIEW')}}</a></li>--}}
                                    {{--<li><a data-toggle="tab" href="#tags">TAGS</a></li>--}}
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">{!! app()->getLocale() === 'en'?$product->long_descp_en:$product->long_descp_ar !!}</p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    {{--<div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">
                                                    <div class="review">
                                                        <div class="review-title"><span
                                                                class="summary">We love this product</span><span
                                                                class="date"><i
                                                                    class="fa fa-calendar"></i><span>1 days ago</span></span>
                                                        </div>
                                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur
                                                            adipiscing elit.Aliquam suscipit."
                                                        </div>
                                                    </div>

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->


                                            <div class="product-add-review">
                                                <h4 class="title">Write your own review</h4>
                                                <div class="review-table">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th class="cell-label">&nbsp;</th>
                                                                <th>1 star</th>
                                                                <th>2 stars</th>
                                                                <th>3 stars</th>
                                                                <th>4 stars</th>
                                                                <th>5 stars</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td class="cell-label">Quality</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Price</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="5"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="cell-label">Value</td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="1"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="2"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="3"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="4"></td>
                                                                <td><input type="radio" name="quality" class="radio"
                                                                           value="5"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table><!-- /.table .table-bordered -->
                                                    </div><!-- /.table-responsive -->
                                                </div><!-- /.review-table -->

                                                <div class="review-form">
                                                    <div class="form-container">
                                                        <form role="form" class="cnt-form">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputName">Your Name <span
                                                                                class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                               id="exampleInputName" placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                    <div class="form-group">
                                                                        <label for="exampleInputSummary">Summary <span
                                                                                class="astk">*</span></label>
                                                                        <input type="text" class="form-control txt"
                                                                               id="exampleInputSummary" placeholder="">
                                                                    </div><!-- /.form-group -->
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputReview">Review <span
                                                                                class="astk">*</span></label>
                                                                        <textarea class="form-control txt txt-review"
                                                                                  id="exampleInputReview" rows="4"
                                                                                  placeholder=""></textarea>
                                                                    </div><!-- /.form-group -->
                                                                </div>
                                                            </div><!-- /.row -->

                                                            <div class="action text-right">
                                                                <button class="btn btn-primary btn-upper">SUBMIT REVIEW
                                                                </button>
                                                            </div><!-- /.action -->

                                                        </form><!-- /.cnt-form -->
                                                    </div><!-- /.form-container -->
                                                </div><!-- /.review-form -->

                                            </div><!-- /.product-add-review -->

                                        </div><!-- /.product-tab -->
                                    </div>--}}<!-- /.tab-pane -->
                                    {{--

                                                                        <div id="tags" class="tab-pane">
                                                                            <div class="product-tag">

                                                                                <h4 class="title">Product Tags</h4>
                                                                                <form role="form" class="form-inline form-cnt">
                                                                                    <div class="form-container">

                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputTag">Add Your Tags: </label>
                                                                                            <input type="email" id="exampleInputTag"
                                                                                                   class="form-control txt">


                                                                                        </div>

                                                                                        <button class="btn btn-upper btn-primary" type="submit">ADD TAGS
                                                                                        </button>
                                                                                    </div><!-- /.form-container -->
                                                                                </form><!-- /.form-cnt -->

                                                                                <form role="form" class="form-inline form-cnt">
                                                                                    <div class="form-group">
                                                                                        <label>&nbsp;</label>
                                                                                        <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                                                                    </div>
                                                                                </form><!-- /.form-cnt -->

                                                                            </div><!-- /.product-tab -->
                                                                        </div><!-- /.tab-pane -->
                                    --}}

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
                    @if ($relatedProduct->count())
                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">{{__('Related products')}}</h3>
                            <div
                                class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                                @foreach ($relatedProduct as $product)


                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"><a
                                                            href="{{route('product.details',$product->id)}}"><img
                                                                src="{{asset($product->thumbnail)}}"
                                                                alt="{{$product->name_en}}"></a>
                                                    </div><!-- /.image -->

                                                    @if ($product->discount_price != NULL)
                                                        <?php
                                                            $amount = $product->sell_price-$product->discount_price;
                                                            $percentage = ($amount/$product->sell_price) * 100;
                                                        ?>
                                                        <div class="tag hot"><span>{{round($percentage)}}%</span></div>
                                                    @else
                                                        {{--<div class="tag sale"><span>{{__('new')}}</span></div>--}}
                                                    @endif
                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{route('product.details',$product->id)}}">
                                                            @if (app()->getLocale() === 'en')
                                                                {{$product->name_en}}
                                                            @else
                                                                {{$product->name_ar}}
                                                            @endif
                                                        </a>
                                                    </h3>
                                                    {{--<div class="rating rateit-small"></div>--}}
                                                    <div class="description">
                                                        @if (app()->getLocale() === 'en')
                                                            {{Str::limit($product->short_descp_en, 20, $end='.......')}}
                                                        @else
                                                            {{Str::limit($product->short_descp_ar, 20, $end='.......')}}
                                                        @endif
                                                    </div>

                                                    @if ($product->discount_price != NULL)
                                                        <div class="product-price"><span
                                                                class="price"> {{$product->discount_price}}{{__('EGP')}} </span>
                                                            <span
                                                                class="price-before-discount">{{$product->sell_price}}{{__('EGP')}}</span>
                                                        </div>
                                                    @else
                                                        <div class="product-price"><span
                                                                class="price"> {{$product->sell_price}}{{__('EGP')}} </span>
                                                        </div>
                                                @endif
                                                <!-- /.product-price -->

                                                </div><!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                        type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#add_to_cart"
                                                                        onclick="productView({{$product->id}})"
                                                                        title="{{__('Add Cart')}}"><i
                                                                        class="fa fa-shopping-cart"></i>
                                                                </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                        type="button">
                                                                    {{__('Add Cart')}}
                                                                </button>
                                                            </li>

                                                            <li class="lnk wishlist">
                                                                <a class="add-to-cart" href="javascript:addToWishlist({{$product->id}})"
                                                                   title="Wishlist">
                                                                    <i class="icon fa fa-heart"></i>
                                                                </a>
                                                            </li>

                                                            {{--<li class="lnk">
                                                                <a class="add-to-cart" href="detail.html"
                                                                   title="Compare">
                                                                    <i class="fa fa-signal"></i>
                                                                </a>
                                                            </li>--}}
                                                        </ul>
                                                    </div><!-- /.action -->
                                                </div><!-- /.cart -->
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                @endforeach
                            </div><!-- /.home-owl-carousel -->
                        </section><!-- /.section -->
                @endif
                <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->


        </div>
        <!-- /.container -->
    </div><!-- /.body-content -->


    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61af412ea9a3161b"></script>

@endsection
