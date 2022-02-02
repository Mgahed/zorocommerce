@extends('admin.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <!--   ------------ Add Category Page -------- -->


                <div class="col-md-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Edit Coupon')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('coupon.update',$coupons->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>{{__('Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" type="text" name="name" class="form-control"
                                                   value="{{ $coupons->name }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <h5>{{__('Discount')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" type="number" name="discount" class="form-control"
                                                   value="{{ $coupons->discount }}">
                                            @error('discount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Validity')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" type="date" name="validity" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control"
                                                   value="{{ $coupons->validity }}">
                                            @error('validity')
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
