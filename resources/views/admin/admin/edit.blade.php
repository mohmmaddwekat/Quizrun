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
                                  href="{{ route('admin.admins.index') }}">{{ __('Admins') }}</a>
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
                          <a href="{{ route('admin.admins.index') }}"
                              class="btn btn-block btn-outline-secondary">{{ __('back') }}</a>
                      </div>
                  </div>
                  <form action="{{ route('admin.admins.update', $admin->id) }}" method="post"
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
                                          name="name" value="{{ old('name', $admin->name) }}" id="exampleInputName1"
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
                                          name="email" value="{{ old('email', $admin->email) }}"
                                          id="exampleInputName1" placeholder="{{ __('Enter Email') }}" required>
                                      @error('email')
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
                                              @if ($admin->image)
                                                  {{ $admin->image }}
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
                                      <img @if (!$admin->image) id="blah" @endif
                                          src="@if ($admin->image) {{ url('/assets/uploads/' . $admin->image) }} @endif"
                                          alt="" width="70px" height="100px" />
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group has-validation">
                                      <label for="exampleInputName1">{{ __('Password') }}</label>
                                      <input type="password"
                                          class="form-control @error('password') is-invalid @enderror" type="password"
                                          name="password" id="Password" placeholder="{{ __('Enter Password') }}"
                                          autocomplete="new-password">
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
                                          placeholder="{{ __('Enter Password Confirmation') }}">
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
