@extends('front.main_master')
@section('content')
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="my-wishlist-page">
                <div class="row">
                    <div class="col-md-12 my-wishlist">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">{{__('My Wishlist')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($wishlist->count())
                                    @foreach ($wishlist as $product)
                                        <tr>
                                            <td class="col-md-2">
                                                <img style="width: 60px !important;" height="60px;"
                                                     src="{{asset($product->product->thumbnail)}}"
                                                     alt="{{$product->product->name_en}}">
                                            </td>
                                            <td class="col-md-7">
                                                <div class="product-name"><a
                                                        href="{{route('product.details',$product->product->id)}}">{{app()->getLocale() === 'en'?$product->product->name_en:$product->product->name_ar}}</a>
                                                </div>
                                                {{-- <div class="rating">
                                                     <i class="fa fa-star rate"></i>
                                                     <i class="fa fa-star rate"></i>
                                                     <i class="fa fa-star rate"></i>
                                                     <i class="fa fa-star rate"></i>
                                                     <i class="fa fa-star non-rate"></i>
                                                     <span class="review">( 06 Reviews )</span>
                                                 </div>--}}
                                                <div class="price">
                                                    @if ($product->product->discount_price !== NULL)
                                                        {{$product->product->discount_price}}{{__('EGP')}}
                                                        <span>{{$product->product->sell_price}}{{__('EGP')}}</span>
                                                    @else
                                                        {{$product->product->sell_price}}{{__('EGP')}}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="col-md-2">
                                                <button data-toggle="modal" data-target="#add_to_cart"
                                                        onclick="productView({{$product->product->id}})"
                                                        class="btn btn-primary icon" type="button"
                                                        title="{{__('Add Cart')}}">
                                                    {{__('Add to Cart')}} <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                {{--<a href="javascript:productView({{$product->product->id}})" class="btn-upper btn btn-primary">{{__('Add to Cart')}}</a>--}}
                                            </td>
                                            <td class="col-md-1 close-btn">
                                                <a href="{{route('wishlist.delete',$product->product->id)}}" class=""><i
                                                        class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <h3 class="text-danger text-center">{{__('No items in wishlist')}}</h3>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
            <br><br>
        </div><!-- /.container -->
    </div><!-- /.body-content -->
@endsection
