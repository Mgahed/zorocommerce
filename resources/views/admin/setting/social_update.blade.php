@extends('admin.admin_master')
@section('admin')

    <div class="container-full">

        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{__('Footer settings')}} </h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form method="post" action="{{ route('update.socialsetting') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $social->id }}">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-12">


                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-facebook-box"></i> {{__('Facebook')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;"  name="facebook" class="form-control"
                                                               value="{{ $social->facebook }}"></div>
                                                </div>


                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-instagram"></i> {{__('Instagram')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;"  name="instagram" class="form-control"
                                                               value="{{ $social->instagram }}"></div>
                                                </div>
                                                <link rel="stylesheet" href="{{app()->getLocale() === 'en' ? asset('fontawesome6/css/all.css') : asset('fontawesome6/css/all_rtl.css')}}">
                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="fab fa-tiktok"></i> {{__('Tiktok')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;"  name="tiktok" class="form-control"
                                                               value="{{ $social->tiktok }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-youtube-play"></i> {{__('Youtube')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;" name="youtube" id="youtube"
                                                               class="form-control" value="{{ $social->youtube }}"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-whatsapp"></i> {{__('Whatsapp')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;" name="whatsapp" id="whatsapp"
                                                               class="form-control" value="{{ $social->whatsapp }}"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-email"></i> {{__('Email')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;" name="email" id="email"
                                                               class="form-control" value="{{ $social->email }}"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-phone-classic"></i> {{__('Number')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;" name="number" id="number"
                                                               class="form-control" value="{{ $social->number }}"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-map-marker"></i> {{__('Address')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;" name="address" id="address"
                                                               class="form-control" value="{{ $social->address }}"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5 style="float: left;"><i class="mdi mdi-google-maps"></i> {{__('google map address')}} </h5>
                                                    <div class="controls">
                                                        <input type="text" style="direction: ltr;" name="google_map_address" id="google_map_address"
                                                               class="form-control" value="{{ $social->google_map_address }}"/>
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
