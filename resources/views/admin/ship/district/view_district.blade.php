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
                            <h3 class="box-title">{{__('Districts list')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($districts) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('City')}}</th>
                                        <th>{{__('Name in english')}}</th>
                                        <th>{{__('Name in arabic')}}</th>
                                        <th>{{__('Shipping cost')}}</th>
                                        <th>{{__('Actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($districts as $item)
                                        <tr>
                                            <td>{{ $item->city->name_en }} - {{ $item->city->name_ar }}</td>
                                            <td>{{ $item->name_en }}</td>
                                            <td>{{ $item->name_ar }}</td>
                                            <td>{{ $item->cost }}{{__('EGP')}}</td>
                                            <td>
                                                <a href="{{ route('district.edit',$item->id) }}" class="btn btn-info"
                                                   title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                                <a href="{{ route('district.delete',$item->id) }}"
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
                        <div class="box-header with-border badge badge-success">
                            <h3 class="box-title" style="color: white;">{{__('Add District')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('district.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>{{__('Select city')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            @php
                                                $cities = \App\Models\ShipDivision::orderBy('name_en','ASC')->get();
                                            @endphp
                                            <select name="city_id" class="form-control" required="">
                                                @foreach ($cities as $item)
                                                    <option value="{{$item->id}}">
                                                        {{app()->getLocale() == 'en'?$item->name_en:$item->name_ar}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Name in english')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name_en" style="direction: ltr;"
                                                   class="form-control" autocomplete="off">
                                            @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Name in arabic')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name_ar" style="direction: rtl;"
                                                   class="form-control" autocomplete="off">
                                            @error('name_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Shipping cost')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" step="0.01" name="cost" min="0.0"
                                                   class="form-control" autocomplete="off">
                                            @error('cost')
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
