@extends('admin.admin_master')
@section('admin')


    <!-- Content Wrapper. Contains page content -->

    <div class="container-full">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">
            <div class="row">


                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border d-flex">
                            <h3 class="box-title p-2">{{__('Free shipping')}} </h3>
                            <span class="ml-auto p-2">
                                <button onclick="openModal()" type="button" class="btn btn-primary"
                                    data-target="#modal-center">
                                    {{__('Set date for free shipping')}}
                                                </button>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Date')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @if (!$data->free_shipping_date || $data->free_shipping_date < \Carbon\Carbon::today())
                                            <td><span class="text-danger">{{__('No date')}}</span></td>
                                        @else
                                            <td>{{ date('Y-m-d', strtotime($data->free_shipping_date)) }}</td>
                                        @endif
                                    </tr>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>

    <!-- Modal -->
    <div class="modal center-modal fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Free shipping')}}</h5>
                    <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('set.free.shipping')}}" method="post">
                        <h5>{{__('Date')}} <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" type="date" name="date"
                                   class="form-control" required="">
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        @csrf
                        <input type="submit" class="btn btn-rounded btn-primary float-right" value="{{__('Save')}}">
                    </form>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button onclick="dismiss()" type="button" class="btn btn-rounded btn-danger" data-dismiss="modal">
                        {{__('Close')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <script>
        function openModal() {
            $('#modal-center').modal('show');
        }

        function dismiss() {
            $('#modal-center').modal('hide');
        }
    </script>

@endsection
