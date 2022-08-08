<div class="register">
    <div class="content">
        <div class="right">
            <p class="fs-1 header">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('student.auth.password.email') }}" method="POST">
                @csrf
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
                <div class="footer">
                    <div>
                        <button type="submit" class="btn">{{__('Password Reset')}}</button>
                    </div>
                    <p>{{__('Already have an account?')}}
                        <a href="{{ route('student.auth.login') }}">{{__('Log in')}}</a>
                    </p>
                </div>

            </form>
        </div>
        <div class="left">
            <img src="{{ url('assets/img/background-1.png') }}" class="img-fluid" alt="" srcset="">

        </div>

    </div>
</div>
