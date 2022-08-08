<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $page_title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('teacher.section.index') }}">{{ __('Sections') }}</a>
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
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <a href="{{ route('teacher.section.index') }}"
                            class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                    </div>
                </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName1">{{ __('Name') }}</label>
                                    <div>
                                        <p>{{$student->name}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">{{ __('Email') }}</label>
                                    <div>
                                        <p>{{$student->email}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">{{ __('Job') }}</label>
                                    <div>
                                        <p>{{$student->job}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">{{ __('Skills') }}</label>
                                    <div>
                                        <p>{{$student->skills}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">{{ __('Education') }}</label>
                                    <div>
                                        <p>{{$student->education}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">{{ __('Location') }}</label>
                                    <div>
                                        <p>{{$student->location}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->
                            <!-- /.row -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('teacher.student.accept',[$student->id,$group->id,$notification_id])}}" class="btn btn-warning">{{ __('Accept') }}</a>
                        <a href="{{route('teacher.student.reject',[$student->id,$group->id,$notification_id])}}" class="btn btn-danger">{{ __('Reject') }}</a>
                    </div>
            </div>
        </div>
    </section>
</div>
