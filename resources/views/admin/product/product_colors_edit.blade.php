@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                            <div class="d-flex">
                                <span>
                                    <h3 class="box-title">{{__('Edit Colors')}}</h3>
                                    <span class="text-danger">{{__('total quantity must be not more than')}}
                                        <span class="totalqty">{{$qty}}</span></span>
                                </span>
                                <span class="ml-auto">
                                    <button onclick="openCurrModal({{$product_colors[0]->product_color_id}})"
                                            type="button"
                                            class="btn btn-primary" data-target="#modal-center-product">
                                        <i class="fa fa-plus-square"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">

                                @foreach ($product_colors as $item)
                                    <form method="post" action="{{ route('product.color.update',$item->id) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <h5>{{__('Color in English')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input autocomplete="off" style="direction: ltr;" type="text"
                                                               disabled class="form-control"
                                                               value="{{ $item->color_en }}">
                                                        @error('color_en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">


                                                <div class="form-group">
                                                    <h5>{{__('Color in Arabic')}} <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input autocomplete="off" style="direction: rtl;" type="text"
                                                               disabled class="form-control"
                                                               value="{{ $item->color_ar }}">
                                                        @error('color_ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <h5>{{__('Quantity')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input autocomplete="off" style="direction: rtl;" type="text"
                                                               name="qty" onkeyup="check_total()"
                                                               class="form-control"
                                                               value="{{ $item->qty }}">
                                                        @error('qty')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="text-xs-right">
                                                    <input type="submit"
                                                           class="btn btn-rounded btn-primary mt-5 update-btn"
                                                           value="{{__('Update')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach

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

    <div class="modal center-modal fade" id="modal-center-product" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add color')}}</h5>
                    <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add.product.color')}}" method="post">
                        <div class="controls">
                            <h5>{{__('Color in English')}} <span class="text-danger">*</span></h5>
                            <input type="text" name="color_en" style="direction: ltr;" class="form-control" required="">
                        </div>
                        <br>
                        <div class="controls">
                            <h5>{{__('Color in Arabic')}} <span class="text-danger">*</span></h5>
                            <input type="text" name="color_ar" style="direction: rtl;" class="form-control" required="">
                        </div>
                        <br>
                        <input type="hidden" name="product_id" value="">
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


    <script>
        function check_total() {
            var sum = 0;
            var totalqty = parseFloat($('.totalqty').text());
            $('input[name="qty"]').each(function () {
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            if (sum > totalqty) {
                alert("{{__('total quantity must be not more than')}}" + totalqty);
                location.reload();
            }
        }

        setInterval(check, 500);

        function check() {
            var sum = 0;
            var totalqty = parseFloat($('.totalqty').text());
            $('input[name="qty"]').each(function () {
                sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
            });
            if (totalqty !== sum) {
                $('.update-btn').css('display', 'none');
            } else {
                $('.update-btn').css('display', 'block');
            }
        }

        function openCurrModal(id) {
            $('input[name="product_id"]').val(id);
            $('#modal-center-product').modal('show');
        }

        function dismiss() {
            $('#modal-center').modal('hide');
            $('#modal-center-product').modal('hide');
        }
    </script>
@endsection
