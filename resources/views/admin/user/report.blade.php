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
                        <div class="box-header with-border" style="display: flex;">
                            <h3 class="box-title">{{__('Report')}}</h3>
                            <button type="button" id="export_button" class="btn btn-success"
                                    style="margin: auto;">{{__('Export')}} <i class="fa fa-file-excel-o"></i></button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Email')}}</th>
                                        <th>{{__('Number')}}</th>
                                        <th>{{__('Amount')}}</th>
                                        <th>{{__('Orders number')}}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td> {{ $item->name }}  </td>
                                            <td> {{ $item->email }}  </td>
                                            <td> {{ $item->phone }} </td>
                                            <td> {{ $item->sum }}  </td>
                                            <td> {{ $item->count }}  </td>

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

    <script>
        function html_table_to_excel(type) {
            var data = document.getElementById('example1');
            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            XLSX.write(file, {bookType: type, bookSST: true, type: 'base64'});
            XLSX.writeFile(file, 'file.' + type);
        }

        const export_button = document.getElementById('export_button');

        export_button.addEventListener('click', () => {
            html_table_to_excel('xlsx');
        });
    </script>


@endsection
