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
                            <h3 class="box-title">{{__('Users')}} <span
                                    class="badge badge-pill badge-danger"> {{ count($users) }} </span></h3>
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
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('Detailed Address')}}</th>
                                        @if (auth()->user()->role === 'admin')
                                            <th>{{__('Role')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Action')}}</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            @if (auth()->user()->role === 'admin')
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    @if($user->email_verified_at !== NULL)
                                                        <span
                                                            class="badge badge-pill badge-success">{{$user->email_verified_at->diffForHumans()}}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-pill badge-danger">{{__('Email not verified')}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group-vertical" style="display: inline-flex; width: 100%;">
                                                        @if ($user->role !== 'admin')
                                                            <a href="{{route('SetAdmin',$user->id)}}"
                                                               class="btn btn-success btn-md">{{__('Set admin')}}
                                                                <i
                                                                    class="fa fa-arrow-up"></i></a>
                                                        @endif

                                                        @if ($user->role !== 'normal')
                                                            <a href="{{route('SetNormal',$user->id)}}"
                                                               class="btn btn-danger btn-md">{{__('Set normal')}}
                                                                <i
                                                                    class="fa fa-arrow-down"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
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
                <!-- /.end col-12 -->


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
