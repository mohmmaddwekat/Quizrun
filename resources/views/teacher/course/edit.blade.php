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
                                  href="{{ route('teacher.course.index') }}">{{ __('Courses') }}</a></li>
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
                          <a href="{{ route('teacher.course.index') }}"
                              class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                      </div>
                  </div>
                  <form action="{{ route('teacher.course.update', $course->id) }}" method="post"
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
                              <div class="col-md-6">
                                  <div class="form-group has-validation">
                                      <label for="exampleInputName1">{{ __('Name') }}</label>
                                      <input type="text" class="form-control @error('name') is-invalid @enderror"
                                          name="name" value="{{ old('name', $course->name) }}" id="exampleInputName1"
                                          placeholder="{{ __('Enter Name') }}" required>
                                      @error('name')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group has-validation">
                                      <label for="exampleInputName1">{{ __('Course Duration') }}</label>
                                      <input type="text" class="form-control @error('course_duration') is-invalid @enderror"
                                          name="course_duration" value="{{ old('course_duration', $course->course_duration) }}" id="exampleInputName1"
                                          placeholder="{{ __('Enter Course Duration') }}" required>
                                      @error('course_duration')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  
                              </div>
                              <div class="col-md-6">
                                <div class="form-group has-validation">
                                    <label for="exampleInputName1">{{ __('Number of Sections') }}</label>
                                    <input type="text"
                                        class="form-control @error('number_of_sections') is-invalid @enderror"
                                        name="number_of_sections"
                                        value="{{ old('number_of_sections', $course->number_of_sections) }}"
                                        id="exampleInputName1" placeholder="{{ __('Enter Number of Sections') }}"
                                        required>
                                    @error('number_of_sections')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                  <div class="form-group">
                                      <label>{{ __('Groups') }}</label>
                                      <select
                                          class="form-control  selectpicker @error('group') is-invalid @enderror"
                                          name="group" data-selected-text-format="count"
                                          title="{{ __('Nothing selected') }}" data-live-search="true">
                                          @foreach ($groups as $group)
                                              <option value="{{ $group->id }}"
                                                  @if (old('group', $course->group_id) && old('group', $course->group_id) == $group->id) selected @endif>
                                                  {{ $group->name }}</option>
                                          @endforeach
                                      </select>
                                      @error('group')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
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
