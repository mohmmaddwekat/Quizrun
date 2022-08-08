<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $page_title }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ $page_title }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-user-tie"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('Admins') }}</span>
                            <span class="info-box-number">
                                {{ $count_admin }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-layer-group"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('Groups') }}</span>
                            <span class="info-box-number">{{ $count_group }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-chalkboard-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('Teachers') }}</span>
                            <span class="info-box-number">{{ $count_teacher }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('Students') }}</span>
                            <span class="info-box-number">{{ $count_student }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
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
                                                    <img src="{{ url("/assets/uploads/$teacher->image") }}" alt=""
                                                        srcset="" width="100px" height="50px">
                                                @else
                                                    <img src="{{ url('/assets/img/image-placeholder.png') }}" alt=""
                                                        srcset="" width="100px" height="50px">
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
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
