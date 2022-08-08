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
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <a href="{{ url()->previous() }}"
                            class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">{{ __('Image') }}</label>
                                @if ($group->image)
                                    <p>
                                        <img height="150px" width="150px"
                                            src="{{ url("/assets/uploads/$group->image") }}" class="img-fluid"
                                            alt="" srcset="">
                                    @else
                                        <img src="{{ url('/assets/img/image-placeholder.png') }}"
                                            class="img-fluid" alt="" srcset="">
                                @endif
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">{{ __('name') }}</label>
                                <p>{{ $group->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">{{ __('Description') }}</label>
                                <p>{{ $group->description }}</p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">{{ __('Category') }}</label>
                                <p>{{ $group->category->name }}</p>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                    <!-- /.row -->
                </div>
                <div class="card-footer">
                    @php
                        $group_user = $group
                            ->users()
                            ->pluck('id')
                            ->toArray();
                    @endphp
                    @if (!in_array(auth('student')->id(), $group_user))
                        <button class="btn btn-outline-primary join"
                            onclick="joinGroup({{ $group->id }})">Join</button>
                    @else
                        <a href="{{ route('student.group.index', $group->id) }}"
                            class="btn btn-outline-primary">Go</a>
                    @endif
                </div>
            </div>
        </div>
    </section>
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
            url: "/student/group/join/" + id,
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