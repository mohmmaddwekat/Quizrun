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
                            <a href="{{ url()->previous() }}"
                                class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <section class="content">
                            <div class="row">
                                <div class="col-12" id="accordion">
                                    <div class="card card-primary card-outline accordion" id="accordionPanelsStayOpenExample">
                                        @foreach ($sections as $key => $section)
                                            <div class="accordion-item">
                                                <div class="card-header" id="panelsStayOpen-heading{{ $key + 1 }}">
                                                    <h4 class="card-title w-100">
                                                        <a class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#panelsStayOpen-collapse{{ $key + 1 }}"
                                                        aria-expanded="true"
                                                        aria-controls="panelsStayOpen-collapse{{ $key + 1 }}">
                                                        {{ $key + 1 }}. {{ $section->title }}
                                                    </a>
                                                    </h4>
                                                </div>
                                                    

                                                <div id="panelsStayOpen-collapse{{ $key + 1 }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="panelsStayOpen-heading{{ $key + 1 }}">
                                                    <div class="accordion-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-6 col-sm-12">
                                                                    <blockquote>
                                                                        <p>{{ $section->description }}.</p>
                                                                    </blockquote>
                                                                    <div
                                                                        class="d-flex flex-row bd-highligh flex-wrap gap-3 mb-3 mt-4 bg-light bg-gradient p-2">
                                                                        @foreach ($section->image()->get() as $image)
                                                                            <div class="row mb-3 ">
                                                                                <div class="col">
                                                                                    @if ($image->image)
                                                                                        <img class="img-fluid"
                                                                                            src="{{ url("/assets/uploads/$image->image") }}"
                                                                                            alt="" width='250px'>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div
                                                                        class="d-flex flex-wrap flex-column mb-3  align-items-center">
                                                                        @foreach ($section->video()->get() as $video)
                                                                            @php
                                                                                $path = $video->poster == null ? '/assets/img/image-placeholder.PNG' : '/assets/uploads/' . $video->poster;
                                                                            @endphp
                                                                            <video id="video" class="img-fluid"
                                                                                poster="{{ url($path) }}" controls>
                                                                                <source
                                                                                    src="{{ url("/assets/uploads/$video->video") }}"
                                                                                    type="video/mp4">
                                                                            </video>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
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
