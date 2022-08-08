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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @php
                                    $path = $student->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $student->image;
                                @endphp
                                <img src="{{ $path }}" class="profile-user-img img-fluid img-circle"
                                    alt="{{__('User profile picture')}}">
                            </div>
                            <h3 class="profile-username text-center">{{ $student->name }}</h3>
                            <p class="text-muted text-center">{{ $student->job }}</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> {{ __('Information about him') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> {{ __('Education') }}</strong>

                            <p class="text-muted">
                                {{ $student->education }}
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> {{__('Location')}}</strong>

                            <p class="text-muted">{{ $student->location }}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> {{ __('Skills') }}</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">{{ $student->skills }}</span>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="{{ url()->previous() }}"
                                    class="btn btn-outline-secondary">{{ __('back') }}</a>
                            </div>
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-group-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-group" type="button" role="tab"
                                        aria-controls="pills-group" aria-selected="false">{{__('Group')}}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-details-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-details" type="button" role="tab"
                                        aria-controls="pills-details" aria-selected="false">{{__('Details')}}</a>
                                </li>
                            </ul>

                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <!-- /.tab-pane -->
                                <div class="tab-pane fade show active" id="pills-group" role="tabpanel"
                                    aria-labelledby="pills-group-tab">
                                    <!-- The Group -->
                                    <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Description') }}</th>
                                                    <th>{{ __('Image') }}</th>
                                                    <th>{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($student->groups()->get() as $group)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ $group->name }}</td>
                                                        <td>{{ $group->description }}</td>
                                                        <td>
                                                            @if ($group->image)
                                                                <img src="{{ url("/assets/uploads/$group->image") }}"
                                                                    alt="" srcset="" width="100px" height="50px">
                                                            @else
                                                                <img src="{{ url('/assets/img/image-placeholder.png') }}"
                                                                    alt="" srcset="" width="100px" height="50px">
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $group_user = $group
                                                                    ->users()
                                                                    ->pluck('id')
                                                                    ->toArray();
                                                            @endphp
                                                            @if (!in_array(auth('student')->id(), $group_user))
                                                                <button class="btn btn-outline-primary join"
                                                                    onclick="joinGroup({{ $group->id }})">{{__('Join')}}</button>
                                                            @else
                                                                <a href="{{ route('student.group.index', $group->id) }}"
                                                                    class="btn btn-outline-primary">{{__('Go')}}</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane fade" id="pills-details" role="tabpanel"
                                    aria-labelledby="pills-details-tab">
                                    <div class="form-group row">
                                        <label for="exampleInputName1"
                                            class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputName1"
                                            class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->email }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName"
                                            class="col-sm-2 col-form-label">{{ __('Job') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->job }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName"
                                            class="col-sm-2 col-form-label">{{ __('Skills') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->skills }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName"
                                            class="col-sm-2 col-form-label">{{ __('Education') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->education }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName"
                                            class="col-sm-2 col-form-label">{{ __('Experience') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->experience }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName"
                                            class="col-sm-2 col-form-label">{{ __('Location') }}</label>
                                        <div class="col-sm-10">
                                            <p>{{ $student->location }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    function joinGroup(id) {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "group/join/" + id,
            type: "POST",
            groupType: "json",
            success: function(result) {
                console.log(result);
                if (result) {
                    $('.join').css("display", "none")
                    Toast.fire({
                        icon: "{{__('Success')}}",
                        title: "{{__('The request to join has been successfully sent.')}}"
                    })
                } else {
                    Toast.fire({
                        icon: "{{__('Error')}}",
                        title: "{{__('The request was not sent, a problem occurred.')}}"
                    })
                }
            },
        });
    }
</script>