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
                            <h3 class="box-title">{{__('Edit District')}} </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">


                                <form method="post" action="{{ route('district.update',$district->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>{{__('Select city')}}<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            @php
                                                $cities = \App\Models\ShipDivision::orderBy('name_en','ASC')->get();
                                            @endphp
                                            <select name="city_id" class="form-control" required="">
                                                @foreach ($cities as $item)
                                                    <option
                                                        value="{{$item->id}}" {{$item->id == $district->city_id?'selected=""':''}}>
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
                                        <h5>{{__('Name in english')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" type="text" style="direction: ltr;"
                                                   name="name_en" class="form-control"
                                                   value="{{ $district->name_en }}">
                                            @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Name in arabic')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" type="text" style="direction: rtl;"
                                                   name="name_ar" class="form-control"
                                                   value="{{ $district->name_ar }}">
                                            @error('name_ar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5>{{__('Shipping cost')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input autocomplete="off" type="number" step="0.01" name="cost" min="0.0"
                                                   class="form-control"
                                                   value="{{ $district->cost }}">
                                            @error('cost')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                               value="{{__('Update')}}">
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
