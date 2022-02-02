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
                            <h3 class="box-title">{{__('Slider List')}}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Slider Image')}} </th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sliders as $item)
                                        <tr>

                                            <td><img src="{{ asset($item->img) }}" style="width: 70px; height: 40px;"> </td>
                                            <td>
                                                @if($item->title_en == NULL)
                                                    <span class="badge badge-pill badge-danger"> {{__('No Title')}} </span>
                                                @else
                                                    {{ $item->title_en }} - {{ $item->title_ar }}
                                                @endif
                                            </td>

                                            <td>{{ $item->descp_en }}</td>
                                            <td>
                                                @if($item->status == 1)
                                                    <span class="badge badge-pill badge-success"> {{__('Active')}} </span>
                                                @else
                                                    <span class="badge badge-pill badge-danger"> {{__('InActive')}} </span>
                                                @endif

                                            </td>

                                            <td width="30%">
                                                <a href="{{ route('slider.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                <a href="{{ route('slider.delete',$item->id) }}" class="btn btn-danger btn-sm" title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>

                                                @if($item->status == 1)
                                                    <a href="{{ route('slider.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                                @else
                                                    <a href="{{ route('slider.active',$item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                                                @endif

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
                <!-- /.col -->


                <!--   ------------ Add Slider Page -------- -->


                <div class="col-md-4">

                    <div class="box">
                        <div class="box-header with-border badge badge-success">
                            <h3 class="box-title" style="color: white;">{{__('Add Slider')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group">
                                        <h5>{{__('Title in english')}} </h5>
                                        <div class="controls">
                                            <input type="text" style="direction: ltr;"  name="title_en" class="form-control" >

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Title in arabic')}} </h5>
                                        <div class="controls">
                                            <input type="text"  name="title_ar" style="direction: rtl;"  class="form-control" >

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>{{__('Description in english')}}</h5>
                                        <div class="controls">
                                            <input type="text" style="direction: ltr;" name="descp_en" class="form-control" >

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Description in arabic')}}</h5>
                                        <div class="controls">
                                            <input type="text" name="descp_ar" style="direction: rtl;" class="form-control" >

                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <h5>{{__('Image')}} <span class="text-danger">*</span>
                                            <span class="badge badge-danger">{{__('When upload gif it\'s better to upload gif with width 870 and height 370')}}</span>
                                        </h5>
                                        <div class="controls">
                                            <input type="file" accept="image/png, image/jpg, image/jpeg, image/gif" name="img" class="form-control" required>
                                            @error('img')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Add')}}">
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
