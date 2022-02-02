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
                        <div class="box-header with-border">
                            <h3 class="box-title">{{__('Product List')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($products) }} </span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Product Code')}}</th>
                                        <th>{{__('Product name')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Price')}}</th>
                                        <th>{{__('Quantity')}}</th>
                                        <th>{{__('Discount')}}</th>
                                        <th>{{__('Free shipping')}}</th>
                                        <th>{{__('Action')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $item)
                                        <tr>
                                            <td><img src="{{ asset($item->thumbnail) }}"
                                                     style="width: 60px; height: 50px;"></td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->name_en }} - {{ $item->name_ar }}</td>
                                            @if ($item->category_id)
                                                <td>{{ $item->category->name_en }}</td>
                                            @else
                                                <td>{{__('No category or deleted')}}</td>
                                            @endif
                                            <td>{{ $item->sell_price }}{{__('EGP')}}</td>
                                            <td>{{ $item->quantity }}</td>

                                            <td>
                                                @if($item->discount_price == NULL)
                                                    <span class="badge badge-pill badge-danger">No Discount</span>
                                                @else
                                                    @php
                                                        $amount = $item->sell_price - $item->discount_price;
                                                        $discount = ($amount/$item->sell_price) * 100;
                                                    @endphp
                                                    <span class="badge badge-pill badge-danger">{{ round($discount)  }} %</span>

                                                @endif


                                            </td>

                                            <td>
                                                @if ($item->free_shipping)
                                                    <span style="white-space: nowrap;">{{date('Y-m-d', strtotime($item->free_shipping))}}</span>
                                                @else
                                                    <span class="text-danger">{{__('No free shipping')}}</span>
                                                @endif
                                            </td>


                                            <td width="30%">
                                                {{--<a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary"
                                                   title="Product Details Data"><i class="fa fa-eye"></i> </a>--}}

                                                <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info"
                                                   title="Edit Data"><i class="fa fa-pencil"></i> </a>

                                                <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger"
                                                   title="Delete Data" id="delete">
                                                    <i class="fa fa-trash"></i></a>

                                                <button onclick="openModal({{$item->id}})" type="button"
                                                        class="btn btn-success" data-target="#modal-center">
                                                    <i class="mdi mdi-library-plus"></i>
                                                </button>

                                                @if ($item->deleted_at)
                                                    <a href="{{ route('product.up',$item->id) }}"
                                                       class="btn btn-success"
                                                       title="Activate">
                                                        <i class="fa fa-arrow-up"></i></a>
                                                @else
                                                    <a href="{{ route('product.down',$item->id) }}"
                                                       class="btn btn-danger" title="Dactivate">
                                                        <i class="fa fa-arrow-down"></i></a>
                                                @endif

                                                <button onclick="openFreeShipping({{$item->id}})" type="button"
                                                        class="btn btn-primary" data-target="#modal-center-product">
                                                    <i class="fa fa-truck"></i>
                                                </button>

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
                    <h5 class="modal-title">{{__('Duplicate product')}}</h5>
                    <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('duplicate.product')}}" method="post">
                        <h5>{{__('Select Category')}} <span class="text-danger">*</span></h5>
                        <div class="controls">
                            @php
                                $categories = \App\Models\Category::orderBy('name_en', 'ASC')->get();
                            @endphp
                            <select name="category_id" class="form-control" required="">
                                @foreach($categories as $category)
                                    <option
                                        value="{{ $category->id }}">{{ $category->name_en }}
                                        - {{$category->name_ar}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
    <!-- /.modal -->

    <!-- free shipping Modal -->
    <div class="modal center-modal fade" id="modal-center-product" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Free shipping')}}</h5>
                    <button onclick="dismiss()" type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('product.free.shipping')}}" method="post">
                        <h5>{{__('Date')}} <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" type="date" name="date" class="form-control" required="">
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br>
                        <input type="hidden" name="product_id_shipping" value="">
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
    <!-- /. free shipping modal -->

    <script>
        function openModal(id) {
            $('input[name="product_id"]').val(id);
            $('#modal-center').modal('show');
        }

        function openFreeShipping(id) {
            $('input[name="product_id_shipping"]').val(id);
            $('#modal-center-product').modal('show');
        }

        function dismiss() {
            $('#modal-center').modal('hide');
            $('#modal-center-product').modal('hide');
        }
    </script>

@endsection
