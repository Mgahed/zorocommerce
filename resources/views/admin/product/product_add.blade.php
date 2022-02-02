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
                    <h4 class="box-title">{{__('Add Product')}} </h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form method="post" action="{{ route('product-store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-12">


                                        <div class="row"> <!-- start 1st row  -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Select Category')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" class="form-control" required="">
                                                            <option value="" selected="" disabled="">Select Category
                                                            </option>
                                                            @foreach($categories as $category)
                                                                <option
                                                                    value="{{ $category->id }}">{{ $category->name_en }} - {{$category->name_ar}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Select SubCategory')}} {{--<span class="text-danger">*</span>--}}</h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" class="form-control" {{--required=""--}}>
                                                            <option selected="" >{{__('non')}}</option>
                                                        </select>
                                                        @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Selling Price')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off" name="sell_price" class="form-control"
                                                               required="" value="{{old('sell_price')}}">
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
                                                        <input style="direction: ltr;" type="text" autocomplete="off" name="name_en" class="form-control"
                                                               required="" value="{{old('name_en')}}">
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
                                                        <input style="direction: rtl;" type="text" autocomplete="off" name="name_ar" class="form-control"
                                                               required="" value="{{old('name_ar')}}">
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
                                                        <input type="number" step="0.01" autocomplete="off" name="discount_price" class="form-control"
                                                               value="{{old('discount_price')}}">
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
                                                        <input type="text" autocomplete="off" name="code" class="form-control"
                                                               required="" value="{{old('code')}}">
                                                        @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Product Quantity')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" step="0.01" autocomplete="off" name="quantity" class="form-control"
                                                               required="" value="{{old('quantity')}}">
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
                                                        <input style="direction: ltr;" type="text" name="brand" class="form-control"
                                                               placeholder="" required="" value="{{old('brand')}}">
                                                        @error('brand')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->


                                        </div> <!-- end 3RD row  -->


                                        <div class="row"> <!-- start 4th row  -->

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <h5>{{__('Color in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: ltr;" type="text" name="color_en" class="form-control"
                                                               placeholder="red,Black,Green" data-role="tagsinput" value="{{old('color_en')}}">
                                                        @error('color_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 3 -->

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <h5>{{__('Color in Arabic')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input style="direction: rtl;" type="text" name="color_ar" class="form-control"
                                                               placeholder="احمر,اسود,اخضر" data-role="tagsinput"
                                                               value="{{old('color_ar')}}">
                                                        @error('color_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 3 -->

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <h5>{{__('Main Thumbnail')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="file" accept="image/png, image/jpg, image/jpeg" name="thumbnail" class="form-control"
                                                               onChange="mainThamUrl(this)" required="">
                                                        @error('thumbnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <img src="" id="mainThmb">
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 3 -->

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <h5>{{__('Multiple Image')}}</h5>
                                                    <div class="controls">
                                                        <input type="file" accept="image/png, image/jpg, image/jpeg" name="multi_img[]" class="form-control"
                                                               multiple="" id="multiImg">
                                                        @error('multi_img')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="row" id="preview_img"></div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 3 -->

                                        </div> <!-- end 4th row  -->


                                        <div class="row"> <!-- start 5th row  -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Short Description in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea style="direction: ltr;" name="short_descp_en" id="textarea"
                                                                  class="form-control" required
                                                                  placeholder="short discription">{{old('short_descp_en')}}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Short Description in Arabic')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea style="direction: rtl;" name="short_descp_ar" id="textarea2"
                                                                  class="form-control" required
                                                                  placeholder="وصف قصير">{{old('short_descp_ar')}}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                        </div> <!-- end 5th row  -->


                                        <div class="row"> <!-- start 6th row  -->
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>{{__('Long Description in English')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                        <textarea id="editor1" style="direction: ltr;" name="long_descp_en" class="form-control" rows="10" cols="80" required="">{{old('long_descp_en')}}</textarea>
                                                    </div>
                                                </div>

                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>{{__('Long Description in Arabic')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                            <textarea id="editor2" style="direction: rtl;" name="long_descp_ar" class="form-control"rows="10" cols="80" required>{{old('long_descp_ar')}}</textarea>
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
                                                                   value="1">
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
                                                                   value="1">
                                                            <label for="checkbox_2">{{__('Best Seller')}}</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6"></div>

                                        </div>


                                        {{--<div class="col-md-6">

                                            <div class="form-group">
                                                <h5>Digital Product <span class="text-danger">pdf,xlx,csv*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="file" class="form-control">

                                                </div>
                                            </div>


                                        </div>--}} <!-- end col md 4 -->


                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                   value="{{__('Add Product')}}">
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
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="category_id"]').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    $.ajax({
                        url: "{{  url('/admin/category/sub/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="subcategory_id"]').empty().append('<option value="null" selected="" >{{__('non')}}</option>');
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.name_en + ' - ' + value.name_ar + '</option>');
                            });
                        },
                    });
                } else {
                    alert('{{__('Error')}}');
                }
            });
            /*$('select[name="subcategory_id"]').on('change', function () {
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{  url('/category/sub-subcategory/ajax') }}/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="subsubcategory_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="subsubcategory_id"]').append('<option value="' + value.id + '">' + value.subsubcategory_name_en + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });*/

        });
    </script>


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
