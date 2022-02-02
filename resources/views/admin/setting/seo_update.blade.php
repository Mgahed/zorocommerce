@extends('admin.admin_master')
@section('admin')

    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{__('SEO Setting Page')}} </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.seosetting') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $seo->id }}">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-12">


                                                <div class="form-group">
                                                    <h5>{{__('Meta Title')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="meta_title" class="form-control"
                                                               value="{{ $seo->meta_title }}"></div>
                                                </div>


                                                <div class="form-group">
                                                    <h5>{{__('Meta Author')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="meta_author" class="form-control"
                                                               value="{{ $seo->meta_author }}"></div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>{{__('Meta Keywords')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="meta_keyword" class="form-control"
                                                               data-role="tagsinput" value="{{ $seo->meta_tag }}"></div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>{{__('Meta Description')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="meta_description" id="textarea"
                                                                  class="form-control"
                                                                  required>{{ $seo->meta_description }}</textarea>
                                                    </div>
                                                </div>

                                                {{--<div class="form-group">
                                                    <h5>Google Analytics <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="google_analytics" id="textarea2"
                                                                  class="form-control" required>{{ $seo->google_analytics }}
                                                        </textarea>
                                                    </div>
                                                </div>--}}

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
