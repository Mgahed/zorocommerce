@extends('admin.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">






                <!--   ------------ Edit Slider Page -------- -->


                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Edit Slider')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $slider->id }}">
                                    <input type="hidden" name="old_image" value="{{ $slider->img }}">

                                    <div class="form-group">
                                        <h5>{{__('Title in english')}}</h5>
                                        <div class="controls">
                                            <input type="text" style="direction: ltr;" name="title_en" class="form-control" value="{{ $slider->title_en }}" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Title in arabic')}}</h5>
                                        <div class="controls">
                                            <input type="text" style="direction: rtl;" name="title_ar" class="form-control" value="{{ $slider->title_ar }}" >
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>{{__('Description in english')}}</h5>
                                        <div class="controls">
                                            <input type="text" style="direction: ltr;" name="descp_en" class="form-control" value="{{ $slider->descp_en }}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Description in arabic')}}</h5>
                                        <div class="controls">
                                            <input type="text" style="direction: rtl;" name="descp_ar" class="form-control" value="{{ $slider->descp_ar }}" >
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>{{__('Image')}}
                                            <span class="badge badge-danger">{{__('When upload gif it\'s better to upload gif with width 870 and height 370')}}</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="file" accept="image/png, image/jpg, image/jpeg, image/gif" name="img" class="form-control">
                                            @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Update')}}">
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




@endsection
