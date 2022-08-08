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
                        <li class="breadcrumb-item"><a href="{{ route('student.home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $page_title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Courses') }} </h3>
                        <div class="card-tools">
                            <!-- Collapse Button -->
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-primary">{{ __('back') }}</a>
                                <a href="{{ route('student.message.index',$forum->id) }}"
                                    class="btn btn-outline-primary">{{ __('Forum') }}</a>
                                <a href="{{ route('student.group.member',$forum->group->id) }}" class="btn btn-outline-primary">{{ __('Members') }}</a>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Course Duration') }}</th>
                                    <th>{{ __('Number of Sections') }}</th>
                                    <th>{{ __('Course Progress') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td></td>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->course_duration }}</td>
                                        <td>{{ $course->number_of_sections }}</td>
                                        <td class="project_progress">
                                            @php
                                                $percentage = round(($course->section()->count() / $course->number_of_sections) * 100, 2);
                                                
                                            @endphp
                                            <div class="progress progress-sm">

                                                <div class="progress-bar  @if ($percentage == 100) bg-green @endif"
                                                    role="progressbar" aria-valuenow="{{ $percentage }}"
                                                    aria-valuemin="0" aria-valuemax="100"
                                                    style="width: {{ $percentage }}%">
                                                </div>
                                            </div>
                                            <small>
                                                {{ $percentage }}% Complete
                                            </small>
                                        </td>
                                        <td class="project-state">

                                            <span
                                                class="badge 
                                                @if ($percentage == 100) badge-success
                                                @elseif($percentage > 0 && $percentage < 100)
                                                    bg-primary
                                                @elseif($percentage == 0)
                                                    bg-secondary @endif ">

                                                @if ($percentage == 100)
                                                    Success
                                                @elseif($percentage > 0 && $percentage < 100)
                                                    in progress
                                                @elseif($percentage == 0)
                                                    did not start
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('student.course.index', $course->id) }}">
                                                <i class="fas fa-folder"></i>{{ __('View') }}
                                            </a>
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
    <!-- /.content -->
</div>
