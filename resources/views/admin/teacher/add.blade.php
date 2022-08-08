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
                  <form action="{{ route('admin.teacher.save') }}" method="post" enctype="multipart/form-data">
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
                                          name="name" value="{{ old('name') }}" id="exampleInputName1"
                                          placeholder="{{ __('Enter Name') }}" required>
                                      @error('name')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group has-validation">
                                      <label for="exampleInputName1">{{ __('Email') }}</label>
                                      <input type="email" class="form-control @error('email') is-invalid @enderror"
                                          name="email" value="{{ old('email') }}" id="exampleInputName1"
                                          placeholder="{{ __('Enter Email') }}" required>
                                      @error('email')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="inputName" class="form-label">{{__('Job')}}</label>
                                      <input type="text" name="job"
                                          class="form-control  @error('job') is-invalid @enderror"
                                          value="{{ old('job') }}" id="inputName" placeholder="{{__('Enter Job')}}">
                                      @error('job')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="inputName" class="form-label">{{__('Skills')}}</label>
                                      <textarea type="text" name="skills" class="form-control  @error('skills') is-invalid @enderror" rows="2" id="inputName"
                                          placeholder="{{__('Enter Skills')}}">{{ old('skills') }}</textarea>
                                      @error('skills')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="inputName" class="form-label">{{__('Experience')}}</label>
                                      <textarea type="text" name="experience" class="form-control  @error('experience') is-invalid @enderror" rows="2"
                                          id="inputName"
                                          placeholder="{{__('Enter Experience')}}">{{ old('experience') }}</textarea>
                                      @error('experience')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName" class="form-label">{{__('Education')}}</label>
                                    <input type="text" name="education"
                                        class="form-control  @error('education') is-invalid @enderror"
                                        value="{{ old('education') }}" id="inputName"
                                        placeholder="{{__('Enter Education')}}">
                                    @error('education')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Location') }}</label>
                                    <select class="form-control  selectpicker @error('location') is-invalid @enderror"
                                        name="location" data-selected-text-format="count"
                                        title="{{ __('Nothing selected') }}" data-live-search="true">
                                        @foreach ($country as $location)
                                            <option value="{{ $location->id }}"
                                                @if (old('location') && old('location') == $location->id) selected @endif>
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
                                <div class="form-group">
                                    <label for="exampleInputFile">{{ __('Image') }}</label>
                                    <div class="input-group image">
                                        <input type="file" name="image" accept="image/*" onchange="readImage(this);"
                                            class="custom-file-input  @error('image') is-invalid @enderror"
                                            id="exampleInputFile">
                                        <label class="path custom-file-label"
                                            for="exampleInputFile">{{ __('Choose Image') }}</label>
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <img id="blah" src="#" alt="" width="70px" height="100px" />
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="isactive"
                                            name="isactive" @if (old('isactive') == 1) checked @endif>
                                        <label class="custom-control-label"
                                            for="isactive">{{ __('Account is blocked') }}</label>
                                    </div>
                                </div>
                                  <div class="form-group has-validation">
                                      <label for="exampleInputName1">{{ __('Password') }}</label>
                                      <input type="password"
                                          class="form-control @error('password') is-invalid @enderror" type="password"
                                          name="password" id="Password" placeholder="{{ __('Enter Password') }}"
                                          required autocomplete="new-password">
                                      @error('password')
                                          <div class="invalid-feedback">
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div>
                                  <div class="form-group has-validation">
                                      <label for="exampleInputName1">{{ __('Confirm Password') }}</label>
                                      <input type="password"
                                          class="form-control @error('password_confirmation') is-invalid @enderror"
                                          name="password_confirmation" id="exampleInputName1"
                                          placeholder="{{ __('Enter Password Confirmation') }}" required>
                                      @error('password_confirmation')
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
