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
                            <h3 class="card-title">{{ __('All Admins') }} </h3>
                            <div class="card-tools">
                                <!-- Collapse Button -->
                                {{-- @if (auth('admin')->user()->can('create', 'App/Models/Admin/Admin')) --}}
                                <a href="{{ route('admin.admins.add') }}"
                                    class="btn btn-block btn-outline-primary">{{ __('Add Admin') }}</a>
                                {{-- @endif --}}
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
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        @if (auth()->guard('admin')->id() != $admin->id)
                                            <tr>
                                                <td></td>
                                                <td>{{ $admin->name }}</td>
                                                <td>{{ $admin->email }}</td>
                                                <td>
                                                    @if ($admin->image)
                                                        <img src="{{ url("/assets/uploads/$admin->image") }}" alt=""
                                                            srcset="" width="100px" height="50px">
                                                    @else
                                                        <img src="{{ url('/assets/img/image-placeholder.png') }}"
                                                            alt="" srcset="" width="100px" height="50px">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- @if (auth('admin')->user()->can('update', $admin)) --}}
                                                    <a href="{{ route('admin.admins.edit', $admin->id) }}"
                                                        type="button" class="btn btn-outline-warning"><i
                                                            class="fas fa-edit"></i></a>
                                                    {{-- @endif --}}
                                                    {{-- @if (auth('admin')->user()->can('delete', $admin)) --}}
                                                    <a href="{{ route('admin.admins.delete', $admin->id) }}"
                                                        type="button" class="btn btn-outline-danger"><i
                                                            class="fas fa-trash"></i></a>
                                                    {{-- @endif --}}
                                                </td>
                                            </tr>
                                        @endif
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
