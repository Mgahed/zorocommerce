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
                            <h3 class="box-title">{{__('Edit Colors')}}</h3>
                            <span class="text-danger">{{__('total quantity must be not more than')}} <span
                                    class="totalqty">{{$qty}}</span></span>
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
            if (totalqty !== sum) {
                $('.update-btn').css('display', 'none');
            } else {
                $('.update-btn').css('display', 'block');
            }
        }
    </script>
@endsection
