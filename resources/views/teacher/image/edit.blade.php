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
                                  href="{{ route('teacher.image.index') }}">{{ __('Group') }}</a></li>
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
                          <a href="{{ route('teacher.image.index') }}"
                              class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                      </div>
                  </div>
                  <form action="{{ route('teacher.image.update', $image->id) }}" method="post"
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
                                  <div class="form-group">
                                      <label for="exampleInputFile">{{ __('Image') }}</label>
                                      <div class="input-group image">
                                          <input type="file" name="image" accept="image/*" onchange="readImage(this);"
                                              class="custom-file-input  @error('image') is-invalid @enderror"
                                              id="exampleInputFile">
                                          <label class="path custom-file-label" for="exampleInputFile">
                                              @if ($image->image)
                                                  {{ $image->image }}
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
                                      <img @if (!$image->image) id="blah" @endif
                                          src="@if ($image->image) {{ url('/assets/uploads/' . $image->image) }} @endif"
                                          alt="" width="70px" height="100px" />
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label>{{ __('Sections') }}</label>
                                      <select
                                          class="form-control  selectpicker @error('section') is-invalid @enderror"
                                          name="section" data-selected-text-format="count"
                                          title="{{ __('Nothing selected') }}" data-live-search="true">
                                          @foreach ($sections as $section)
                                              <option value="{{ $section->id }}"
                                                  @if (old('section', $image->section_id) && old('section', $image->section_id) == $section->id) selected @endif>
                                                  {{ $section->title }}</option>
                                          @endforeach
                                      </select>
                                      @error('section')
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
