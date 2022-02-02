@extends('admin.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-md-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Coupon List')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($coupons) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Product name')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Discount')}}</th>
                                        <th>{{__('Validity')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Actions')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $item)
                                        <tr>
                                            <td><img style="width: 50px; height: 50px;"
                                                     src="{{ asset($item->product->thumbnail) }}"
                                                     alt="{{$item->product->name_en}}"></td>
                                            <td>{{ $item->product->name_en }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->discount }}%</td>
                                            <td>{{\Carbon\Carbon::parse($item->validity)->diffForHumans()}}</td>
                                            <td>
                                                @if($item->status == 1  && (\Carbon\Carbon::parse($item->validity)>=\Carbon\Carbon::today()))
                                                    <span
                                                        class="badge badge-pill badge-success"> {{__('Valid')}} </span>
                                                @else
                                                    <span
                                                        class="badge badge-pill badge-danger"> {{__('Invalid')}} </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('product.coupon.edit',$item->id) }}"
                                                   class="btn btn-info"
                                                   title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                                <a href="{{ route('product.coupon.delete',$item->id) }}"
                                                   class="btn btn-danger" title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md -->


                <!--   ------------ Add Category Page -------- -->


                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Add Coupon')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('product.coupon.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>{{__('Name')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" autocomplete="off">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Discount')}}<span class="text-danger">(%) *</span></h5>
                                        <div class="controls">
                                            <input type="number" name="discount"
                                                   class="form-control" autocomplete="off">
                                            @error('discount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Validity')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="validity"
                                                   min="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                                   class="form-control" autocomplete="off">
                                            @error('validity')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Category and sub to get product--}}
                                    <div class="form-group">
                                        <h5>{{__('Select Category')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select Category
                                                </option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}">{{ $category->name_en }}
                                                        - {{$category->name_ar}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Select SubCategory')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select
                                                    SubCategory
                                                </option>
                                            </select>
                                            @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Select Product')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="product_id" class="form-control" required="">
                                                <option value="" selected="" disabled="">Select
                                                    Product
                                                </option>
                                            </select>
                                            @error('product_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                               value="{{__('Add New')}}">
                                    </div>
                                </form>


                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.name_en + ' - ' + value.name_ar + '</option>');
                            });
                        },
                    });
                } else {
                    alert('{{__('Error')}}');
                }
            });
            $('select[name="subcategory_id"]').on('change', function () {
                var category_id = $('select[name="category_id"]').val();
                var subcategory_id = $(this).val();
                if (subcategory_id) {
                    $.ajax({
                        url: "{{  url('/admin/product/ajax') }}/" + category_id + "/" + subcategory_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var d = $('select[name="product_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="product_id"]').append('<option value="' + value.id + '">' + value.name_en + ' - ' + value.name_ar + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });

        });
    </script>
@endsection

