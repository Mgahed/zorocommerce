@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="container-full">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <div class="d-flex">
                        <span>
                            <h4 class="box-title">{{__('Edit Product')}} </h4>
                        </span>
                        <span class="ml-auto">
                            <button onclick="openCurrModal({{$product->id}})"
                                    type="button"
                                    class="btn btn-primary" data-target="#modal-center-product">
                                <i class="fa fa-file-image-o"></i>
                                <i class="fa fa-plus"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form method="post" action="{{ route('product-update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                <div class="row">
                                    <div class="col-12">


                                        <div class="row"> <!-- start 1st row  -->

                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <h5>{{__('Select Category')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control" required="">
                                                            @if ($product->category_id)
                                                                <option value="{{$product->category->id}}"
                                                                        selected="">{{$product->category->name_en}}
                                                                    - {{$product->category->name_ar}}
                                                                </option>
                                                            @endif
                                                            @foreach($categories as $category)
                                                                @if ($product->category_id != $category->id)
                                                                    <option
                                                                        value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : ''}}>{{ $category->name_en }}
                                                                        - {{$category->name_ar}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <input type="hidden" name="subcategory_id" value="null">
                                            {{--<div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Select SubCategory')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control" required="">
                                                            @if ($product->subcategory_id)
                                                                <option value="{{$product->subcategory_id}}"
                                                                        selected="">
                                                                    {{$product->subcategory->name_en}}
                                                                    - {{$product->subcategory->name_ar}}
                                                                </option>
                                                            @else
                                                                <option value="null">{{__('non')}}</option>
                                                            @endif
                                                        </select>
                                                        @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->--}}


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Selling Price')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="sell_price"
                                                               class="form-control"
                                                               required="" value="{{$product->sell_price}}">
                                                        @error('sell_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 1st row  -->


                                        <div class="row"> <!-- start 2nd row  -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Name in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: ltr;" type="text" autocomplete="off"
                                                               name="name_en" class="form-control"
                                                               required="" value="{{$product->name_en}}">
                                                        @error('name_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Name in Arabic')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input style="direction: rtl;" type="text" autocomplete="off"
                                                               name="name_ar" class="form-control"
                                                               required="" value="{{$product->name_ar}}">
                                                        @error('name_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Discount Price')}}</h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="discount_price"
                                                               class="form-control"
                                                               value="{{$product->discount_price}}">
                                                        @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                        </div> <!-- end 2nd row  -->


                                        <div class="row"> <!-- start 3RD row  -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Product Code')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" autocomplete="off" name="code"
                                                               class="form-control"
                                                               required="" value="{{$product->code}}">
                                                        @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Product Quantity')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off"
                                                               name="quantity"
                                                               class="form-control"
                                                               required="" value="{{$product->quantity}}">
                                                        @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Brand')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: ltr;" type="text" name="brand"
                                                               class="form-control"
                                                               placeholder="" required="" value="{{$product->brand}}">
                                                        @error('brand')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 3RD row  -->


                                        <div class="row d-none"> <!-- start 4th row  -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Color in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: ltr;" type="text" name="color_en"
                                                               class="form-control"
                                                               placeholder="red,Black,Green" data-role="tagsinput"
                                                               value="{{$product->color_en}}">
                                                        @error('color_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 3 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Color in Arabic')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: rtl;" type="text" name="color_ar"
                                                               class="form-control"
                                                               placeholder="????????,????????,????????" data-role="tagsinput"
                                                               value="{{$product->color_ar}}">
                                                        @error('color_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 3 -->

                                        </div> <!-- end 4th row  -->


                                        <div class="row"> <!-- start 5th row  -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Short Description in English')}} <span
                                                            class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea style="direction: ltr;" name="short_descp_en"
                                                                  id="textarea"
                                                                  class="form-control" required
                                                                  placeholder="short discription">{{$product->short_descp_en}}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Short Description in Arabic')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea style="direction: rtl;" name="short_descp_ar"
                                                                  id="textarea2"
                                                                  class="form-control" required
                                                                  placeholder="?????? ????????">{{$product->short_descp_ar}}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                        </div> <!-- end 5th row  -->


                                        <div class="row"> <!-- start 6th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>{{__('Long Description in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" style="direction: ltr;"
                                                                  name="long_descp_en" class="form-control" rows="10"
                                                                  cols="80"
                                                                  required="">{{$product->long_descp_en}}</textarea>
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>{{__('Long Description in Arabic')}} <span
                                                            class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" style="direction: rtl;"
                                                                  name="long_descp_ar" class="form-control" rows="10"
                                                                  cols="80"
                                                                  required>{{$product->long_descp_ar}}</textarea>
                                                    </div>
                                                </div>


                                            </div> <!-- end col md 6 -->

                                        </div> <!-- end 6th row  -->


                                        <hr>


                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_1" name="special_offer"
                                                                   value="1" {{$product->special_offer === 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_1">{{__('Special Offer')}}</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="checkbox" id="checkbox_2" name="best_seller"
                                                                   value="1" {{$product->best_seller === 1 ? 'checked' : ''}}>
                                                            <label for="checkbox_2">{{__('Best Seller')}}</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6"></div>

                                        </div>


                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-success mb-5"
                                                   value="{{__('Update')}}">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->


        <!-- ///////////////// Start Multiple Image Update Area ///////// -->
        @if ($multiImgs->count())
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box bt-3 border-info">
                            <div class="box-header">
                                <h4 class="box-title">{{__('Multiple Image')}} <strong>{{__('Update')}}</strong></h4>
                            </div>

                            <div class="container-fluid mt-3">

                                <form method="post" action="{{ route('update-product-image') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row row-sm">
                                        @foreach($multiImgs as $img)
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img src="{{ asset($img->name) }}" class="card-img-top"
                                                         style="height: 130px; width: 280px;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <a href="{{ route('product.multiimg.delete',$img->id) }}"
                                                               class="btn btn-sm btn-danger" id="delete"
                                                               title="Delete Data"><i
                                                                    class="fa fa-trash"></i> </a>
                                                        </h5>
                                                        <p class="card-text">
                                                        <div class="form-group">
                                                            <label class="form-control-label">{{__('Change Image')}} {{--<span
                                                                class="text-danger">*</span>--}}</label>
                                                            <input class="form-control" type="file"
                                                                   accept="image/png, image/jpg, image/jpeg"
                                                                   name="multi_img[{{ $img->id }}]">
                                                        </div>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div><!--  end col md 3		 -->
                                        @endforeach

                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-success mb-5"
                                               value="{{__('Update')}}">
                                    </div>
                                    <br><br>


                                </form>

                            </div>
                        </div>
                    </div>
                </div> <!-- // end row  -->

            </section>
    @endif
    <!-- ///////////////// End Start Multiple Image Update Area ///////// -->


        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->

        <section class="content">
            <div class="row">

                <div class="col-md-12">
                    <div class="box bt-3 border-info">
                        <div class="box-header">
                            <h4 class="box-title">{{__('Main Thumbnail')}} <strong>{{__('Update')}}</strong></h4>
                        </div>

                        <div class="container-fluid mt-3">
                            <form method="post" action="{{ route('update-product-thambnail') }}"
                                  enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="old_img" value="{{ $product->thumbnail }}">

                                <div class="row row-sm">

                                    <div class="col-md-3">

                                        <div class="card">
                                            <img src="{{ asset($product->thumbnail) }}" class="card-img-top"
                                                 style="height: 130px; width: 280px;">
                                            <div class="card-body">

                                                <p class="card-text">
                                                <div class="form-group">
                                                    <label class="form-control-label">{{__('Change Image')}} <span
                                                            class="tx-danger">*</span></label>
                                                    <input type="file" name="product_thumbnail"
                                                           accept="image/png, image/jpg, image/jpeg"
                                                           class="form-control" required
                                                           onChange="mainThamUrl(this)">
                                                    @error('product_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">
                                                </div>
                                                </p>

                                            </div>
                                        </div>

                                    </div><!--  end col md 3		 -->


                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-success mb-5"
                                           value="{{__('Update')}}">
                                </div>
                                <br><br>


                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- // end row  -->

        </section>
        <!-- ///////////////// End Start Thambnail Image Update Area ///////// -->


    </div>

    <div class="modal center-modal fade" id="modal-center-product" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Multiple Image')}}</h5>
                    <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('product.add.multiimg')}}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h5>{{__('Multiple Image')}}</h5>
                            <div class="controls">
                                <input type="file" accept="image/png, image/jpg, image/jpeg" name="multi_img[]"
                                       class="form-control"
                                       multiple="" id="multiImg">
                                @error('multi_img')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="row" id="preview_img"></div>
                            </div>
                        </div>
                        <br>
                        <input type="hidden" name="product_id" value="">
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


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        function openCurrModal(id) {
            $('input[name="product_id"]').val(id);
            $('#modal-center-product').modal('show');
        }

        function dismiss() {
            $('#modal-center').modal('hide');
            $('#modal-center-product').modal('hide');
        }

        $(document).ready(function () {
            $('#multiImg').on('change', function () { //on file input change
                if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function (index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function (file) { //trigger function on successful read
                                return function (e) {
                                    var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(80)
                                        .height(80); //create image element
                                    $('#preview_img').append(img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>


@endsection
