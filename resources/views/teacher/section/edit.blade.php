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
                                  href="{{ route('teacher.section.index') }}">{{ __('Section') }}</a></li>
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
                  <form action="{{ route('teacher.section.update', $section->id) }}" method="post"
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
                                      <label for="exampleInputName1">{{ __('Title') }}</label>
                                      <input type="text" class="form-control @error('title') is-invalid @enderror"
                                          name="title" value="{{ old('title', $section->title) }}"
                                          id="exampleInputName1" placeholder="{{ __('Enter Title') }}" required>
                                      @error('title')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group has-validation">
                                      <label for="description">{{ __('Description') }}</label>
                                      <textarea class="form-control @error('description') is-invalid @enderror" type="description" name="description"
                                          id="description" rows="3"
                                          placeholder="{{ __('Enter Description') }}">{{ $section->description }}</textarea>
                                      @error('description')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label>{{ __('Courses') }}</label>
                                      <select class="form-control  selectpicker @error('course') is-invalid @enderror"
                                          name="course" data-selected-text-format="count"
                                          title="{{ __('Nothing selected') }}" data-live-search="true">
                                          @foreach ($courses as $course)
                                              @if ($section->course_id == $course->id)
                                                  <option value="{{ $course->id }}"
                                                      @if (old('course', $section->course_id) && old('course', $section->course_id) == $course->id) selected @endif>
                                                      {{ $course->name }}</option>
                                              @elseif ($course->section()->count() < $course->number_of_sections)
                                                  <option value="{{ $course->id }}"
                                                      @if (old('course', $section->course_id) && old('course', $section->course_id) == $course->id) selected @endif>
                                                      {{ $course->name }}</option>
                                              @endif
                                          @endforeach
                                      </select>
                                      @error('course')
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
