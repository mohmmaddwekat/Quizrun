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
                            href="{{ route('teacher.group.index') }}">{{ __('Group') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $page_title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-header">
                <h3 class="card-title">{{ __('All Members') }} </h3>
                <div class="card-tools">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                </div>
            </div>
            <div class="card-body pb-0">
                <div class="row">
                    @foreach ($teachers as $teacher)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    {{__('Teacher')}}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $teacher->name }}</b></h2>
                                            <p class="text-muted text-sm"><b>{{__('Job')}}: </b> {{ $teacher->job }} </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fa-solid fa-envelope"></i></span> {{__('Email')}}:
                                                    {{ $teacher->email }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            @php
                                                $path = $teacher->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $teacher->image;
                                            @endphp
                                            <img src="{{ $path }}" alt="user-avatar"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{route('teacher.profile.edit',$teacher->id)}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-user"></i> {{__('View Profile')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($students as $student)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                    {{__('Student')}}
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $student->name }}</b></h2>
                                            <p class="text-muted text-sm"><b>{{__('Job')}}: </b> {{ $student->job }} </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><span class="fa-li"><i
                                                            class="fa-solid fa-envelope"></i></span> {{__('Email')}}:
                                                    {{ $student->email }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            @php
                                                $path = $student->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $student->image;
                                            @endphp
                                            <img src="{{ $path }}" alt="{{__('user Avatar')}}"
                                                class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{route('teacher.profile.student.index',[$student->id,$group->id])}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-user"></i> {{__('View Profile')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                {{ $students->links() }}
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
