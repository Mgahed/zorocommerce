@extends('admin.admin_master')
@section('admin')

    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{__('About us')}} </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.about_us') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $about->id }}">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5>{{__('Long Description in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" style="direction: ltr;"
                                                                  name="description_en" class="form-control" rows="10"
                                                                  cols="80"
                                                                  required="">{{$about->description_en}}</textarea>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->

                                            <div class="col-md-12">
                                                <br><br>
                                                <div class="form-group">
                                                    <h5>{{__('Long Description in Arabic')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" style="direction: rtl;"
                                                                  name="description_ar" class="form-control" rows="10"
                                                                  cols="80"
                                                                  required="">{{$about->description_ar}}</textarea>
                                                    </div>
                                                </div>

                                            </div> <!-- end cold md 6 -->

                                        </div>    <!-- end row 	 -->


                                        <div class="text-xs-right">
                                            <input type="submit" class="btn btn-rounded btn-primary mb-5"
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


    </div>



@endsection
