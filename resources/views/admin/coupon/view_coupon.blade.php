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
                                                <a href="{{ route('coupon.edit',$item->id) }}" class="btn btn-info"
                                                   title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                                <a href="{{ route('coupon.delete',$item->id) }}"
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


                                <form method="post" action="{{ route('coupon.store') }}">
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
                                        <h5>{{__('Discount')}}(%)<span class="text-danger">*</span></h5>
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




@endsection
