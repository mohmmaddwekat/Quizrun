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
                                  href="{{ route('teacher.group.index') }}">{{ __('Group') }}</a></li>
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
                          <a href="{{ route('teacher.group.index') }}"
                              class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                      </div>
                  </div>
                  <form action="{{ route('teacher.group.update', $group->id) }}" method="post"
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
                                          name="name" value="{{ old('name', $group->name) }}" id="exampleInputName1"
                                          placeholder="{{ __('Enter Name') }}" required>
                                      @error('name')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="exampleInputFile">{{ __('Image') }}</label>
                                      <div class="input-group image">
                                          <input type="file" name="image" accept="image/*" onchange="readImage(this);"
                                              class="custom-file-input  @error('image') is-invalid @enderror"
                                              id="exampleInputFile">
                                          <label class="path custom-file-label" for="exampleInputFile">
                                              @if ($group->image)
                                                  {{ $group->image }}
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
                                      <img @if (!$group->image) id="blah" @endif
                                          src="@if ($group->image) {{ url('/assets/uploads/' . $group->image) }} @endif"
                                          alt="" width="70px" height="100px" />
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group has-validation">
                                      <label for="description">{{ __('Description') }}</label>

                                      <textarea class="form-control @error('description') is-invalid @enderror" type="description" name="description"
                                          id="description" rows="3"
                                          placeholder="{{ __('Enter Description') }}">{{ old('description', $group->description) }}</textarea>
                                      @error('description')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label>{{ __('Categories') }}</label>
                                      <select
                                          class="form-control  selectpicker @error('categories') is-invalid @enderror"
                                          name="categories" data-selected-text-format="count"
                                          title="{{ __('Nothing selected') }}" data-live-search="true">
                                          @foreach ($categories as $category)
                                              <option value="{{ $category->id }}"
                                                  @if (old('categories', $group->category_id) && old('categories', $group->category_id) == $category->id) selected @endif>
                                                  {{ $category->name }}</option>
                                          @endforeach
                                      </select>
                                      @error('categories')
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
