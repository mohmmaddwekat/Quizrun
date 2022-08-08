<div class="register">
    <div class="content">
        <div class="right">
            <p class="fs-1 header">{{__('Register for a Teacher Account')}}</p>
            <form action="{{ route('teacher.auth.register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="exampleInputFile">{{ __('Profile') }}</label>
                    <div class="input-group image">
                        <input type="file" name="image" accept="image/*" onchange="readImage(this);"
                            class="custom-file-input  @error('image') is-invalid @enderror" id="exampleInputFile">
                        <label class="path custom-file-label" for="exampleInputFile">{{ __('Choose Image') }}</label>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div>
                    <label for="exampleInputFile">{{ __('Certificate') }}</label>
                    <div class="input-group image-two">
                        <input type="file" name="certificate" accept="image/*" onchange="readImageTwo(this);"
                            class="custom-file-input  @error('certificate') is-invalid @enderror" id="exampleInputFile">
                        <label class="path-two custom-file-label" for="exampleInputFile">{{ __('Choose Image') }}</label>
                        @error('certificate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
                <div>
                    <label for="inputName" class="form-label">{{__('Name')}}</label>
                    <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" id="inputName" placeholder="{{__('Enter Name')}}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="inputEmail" class="form-label">{{__('Email')}}</label>
                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" id="inputEmail" placeholder="{{__('Enter Email')}}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
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
                <div>
                    <label for="inputName" class="form-label">{{__('Skills')}}</label>
                    <textarea type="text" name="skills" class="form-control  @error('skills') is-invalid @enderror" rows="2" id="inputName"
                        placeholder="{{__('Enter Skills')}}">{{ old('skills') }}</textarea>
                    @error('skills')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="inputName" class="form-label">{{__('Experience')}}</label>
                    <textarea type="text" name="experience" class="form-control  @error('experience') is-invalid @enderror" rows="2"
                        id="inputName" placeholder="{{__('Enter Experience')}}">{{ old('experience') }}</textarea>
                    @error('experience')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="inputName" class="form-label">{{__('Education')}}</label>
                    <input type="text" name="education" class="form-control  @error('education') is-invalid @enderror"
                        value="{{ old('education') }}" id="inputName" placeholder="{{__('Enter Education')}}">
                    @error('education')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label>{{ __('Location') }}</label>
                    <select class="form-control @error('location') is-invalid @enderror"
                        name="location" data-selected-text-format="count" title="{{ __('Nothing selected') }}"
                        data-live-search="true">
                        @foreach ($country as $location)
                            <option value="{{ $location->id }}" @if (old('location') && old('location') == $location->id) selected @endif>
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
                <div>
                    <label for="inputPassword" class="form-label">{{ __('Password') }}</label>
                    <input type="password" name="password" class="form-control  @error('password') is-invalid @enderror"
                        id="inputPassword" placeholder="{{__('Enter Password')}}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" name="password_confirmation"
                        class="form-control  @error('password') is-invalid @enderror" id="password_confirmation"
                        placeholder="{{__('Enter Password Confirmation')}}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="footer">
                    <div>
                        <button type="submit" class="btn">{{__('Sign in')}}</button>
                    </div>
                    <p>{{__('Already have an account?')}}
                        <a href="{{ route('teacher.auth.login') }}">{{__('Log in')}}</a>
                    </p>
                </div>

            </form>
        </div>
        <div class="left">
            <img src="{{ url('assets/img/background-1.png') }}" class="img-fluid" alt="" srcset="">
        </div>

    </div>
</div>
