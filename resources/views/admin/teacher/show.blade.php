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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.teacher.index') }}">{{ __('Teacher') }}</a></li>
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
                        <a href="{{ route('admin.teacher.index') }}"
                            class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                    </div>
                </div>
                <form action="{{ route('admin.teacher.approval', $teacher->id) }}" method="post"
                    enctype="multipart/form-data">
                    <!-- /.card-header -->
                    @if ($errors->any())
                        @foreach ($errors as $error)
                            {{ $error }}
                        @endforeach
                    @else
                    @endif

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">


                                <div class="form-group">
                                    <label for="exampleInputFile">{{ __('Certificate') }}</label>
                                    @if ($teacher->certificate)
                                        <img src="{{ url("/assets/uploads/$teacher->certificate") }}"
                                            class="img-fluid" alt="" srcset="">
                                    @else
                                        <img src="{{ url('/assets/img/image-placeholder.png') }}"
                                            class="img-fluid" alt="" srcset="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isactive"
                                            name="isactive" @if (old('isactive') == 1) checked @endif>
                                        <label class="custom-control-label"
                                            for="isactive">{{ __('Account is blocked') }}</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                        <!-- /.row -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
