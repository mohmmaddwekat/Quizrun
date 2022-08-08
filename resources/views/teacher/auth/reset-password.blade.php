<div class="register">
    <div class="content">
        <div class="right">
            <p class="fs-1 header">{{__("Change the student's password")}}</h1>
                <form action="{{ route('teacher.auth.password.update') }}" method="POST">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <div>
                        <label for="inputEmail" class="form-label">{{__('Email')}}</label>
                        <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror"
                            value="{{ old('email', $request->email) }}" id="inputEmail" placeholder="{{__('Enter Email')}}"
                            autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
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
                        <button type="submit" class="btn">{{__('Reset Password')}}</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="left">
            <img src="{{ url('assets/img/background-1.png') }}" class="img-fluid" alt="" srcset="">

        </div>

    </div>
</div>
