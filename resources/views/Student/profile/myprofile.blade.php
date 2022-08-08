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
                            <h3 class="card-title">{{ __('About Me') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> {{ __('Education') }}</strong>
                            <p class="text-muted">
                                {{ $student->education }}
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> {{ __('Location') }}</strong>
                            @foreach ($country as $location)
                                <p class="text-muted">
                                    @if (old('location', $student->location_id) && old('location', $student->location_id) == $location->id)
                                    {{ $location->name }}
                                    @endif
                                </p>
                            @endforeach
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
                                                            <a href="{{ route('student.group.index', $group->id) }}"
                                                                class="btn btn-outline-primary">{{__('Go')}}</a>
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
                                    <form class="form-horizontal"
                                        action="{{ route('student.profile.update', $student->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="exampleInputName1"
                                                class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name', $student->name) }}" id="exampleInputName1"
                                                    placeholder="{{ __('Enter Name') }}" required>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputName1"
                                                class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email', $student->email) }}"
                                                    id="exampleInputName1" placeholder="{{ __('Enter Email') }}"
                                                    required>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Job') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="job"
                                                    class="form-control  @error('job') is-invalid @enderror"
                                                    value="{{ old('job', $student->job) }}" id="inputName"
                                                    placeholder="{{__('Enter Job')}}">
                                                @error('job')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Image') }}</label>
                                            <div class="col-sm-10">
                                                <div class="input-group image">
                                                    <input type="file" name="image" accept="image/*"
                                                        onchange="readImage(this);"
                                                        class="custom-file-input  @error('image') is-invalid @enderror"
                                                        id="exampleInputFile">
                                                    <label class="path custom-file-label" for="exampleInputFile">
                                                        @if ($student->image)
                                                            {{ $student->image }}
                                                        @else
                                                            {{ __('Choose Image') }}
                                                        @endif
                                                    </label>
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Skills') }}</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" name="skills" class="form-control  @error('skills') is-invalid @enderror" rows="2" id="inputName"
                                                    placeholder="{{__('Enter Skills')}}">{{ old('skills', $student->skills) }}</textarea>
                                                @error('skills')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Education') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="education"
                                                    class="form-control  @error('education') is-invalid @enderror"
                                                    value="{{ old('education', $student->education) }}"
                                                    id="inputName" placeholder="{{__('Enter Education')}}">
                                                @error('education')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Location') }}</label>
                                            <div class="col-sm-10">
                                                <select
                                                    class="form-control selectpicker @error('location') is-invalid @enderror"
                                                    name="location" data-selected-text-format="count"
                                                    title="{{ __('Nothing selected') }}" data-live-search="true">
                                                    @foreach ($country as $location)
                                                        <option value="{{ $location->id }}"
                                                            @if (old('location', $student->location_id) && old('location', $student->location_id) == $location->id) selected @endif>
                                                            {{ $location->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('location')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Password') }}</label>
                                            <div class="col-sm-10">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    type="password" name="password" id="Password"
                                                    placeholder="{{ __('Enter Password') }}"
                                                    autocomplete="new-password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('Confirm Password') }}</label>
                                            <div class="col-sm-10">
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation" id="exampleInputName1"
                                                    placeholder="{{ __('Enter Password Confirmation') }}">
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">{{__('Submit')}}</button>
                                            </div>
                                        </div>
                                    </form>
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
