<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        @if (session('Error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i>{{ __('Error') }}</h5>
                {{ session('Error') }}
            </div>
        @endif
        @if (session('Success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>{{ __('Success') }}</h5>
                {{ session('Success') }}
            </div>
        @endif
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $page_title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('All Teachers') }} </h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.teacher.add') }}"
                                    class="btn btn-block btn-outline-primary">{{ __('Add Teacher') }}</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Active') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                            <tr>
                                                <td></td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>
                                                    @if ($teacher->image)
                                                        <img src="{{ url("/assets/uploads/$teacher->image") }}"
                                                            alt="" srcset="" width="100px" height="50px">
                                                    @else
                                                        <img src="{{ url('/assets/img/image-placeholder.png') }}"
                                                            alt="" srcset="" width="100px" height="50px">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $teacher->isactive == 0 ? __('false') : __('true') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.teacher.edit', $teacher->id) }}"
                                                        type="button" class="btn btn-outline-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin.teacher.delete', $teacher->id) }}"
                                                        type="button" class="btn btn-outline-danger"><i
                                                            class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
