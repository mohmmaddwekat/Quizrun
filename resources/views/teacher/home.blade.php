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
              <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-spinner"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{__('Rate for Courses')}}</span>
                <span class="info-box-number">
                  {{$percentage}}
                  <small>%</small>
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
                <span class="info-box-text">{{__('Groups')}}</span>
                <span class="info-box-number">{{$count_group}}</span>
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
              <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-book-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{__('Courses for Groups')}}</span>
                <span class="info-box-number">{{$count_course}}</span>
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
                <span class="info-box-text">{{__('New Members')}}</span>
                <span class="info-box-number">{{$members}}</span>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('All Groups') }} </h3>
                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <a href="{{ route('teacher.group.add') }}"
                            class="btn btn-block btn-outline-primary">{{ __('Add Group') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Image') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    <td></td>
                                    <td>{{ $group->name }}</td>
                                    <td>
                                        @if ($group->image)
                                            <img src="{{ url("/assets/uploads/$group->image") }}" alt=""
                                                srcset="" width="70px" height="100px">
                                        @else
                                            <img src="{{ url('/assets/img/image-placeholder.png') }}" alt=""
                                                srcset="" width="70px" height="100px">
                                        @endif
                                    </td>
                                    <td>{{ $group->description }}</td>
                                    <td>{{ $group->category->name }}</td>
                                    <td>
                                        <a href="{{ route('teacher.message.index', $group->forum->id) }}" type="button"
                                            class="btn btn-outline-warning"><i class="fa-solid fa-comments"></i>
                                        </a>
                                        <a href="{{ route('teacher.group.member', $group->id) }}" type="button"
                                            class="btn btn-outline-warning"><i class="fa-solid fa-users"></i>
                                        </a>
                                        <a href="{{ route('teacher.group.edit', $group->id) }}" type="button"
                                            class="btn btn-outline-warning"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('teacher.group.delete', $group->forum->id) }}"
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
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>