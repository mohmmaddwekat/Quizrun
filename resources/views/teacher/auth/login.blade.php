<div class="register">
    <div class="content">
        <div class="right">
            <p class="fs-1 header">{{__('Login for a Teacher Account')}}</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        {{ __('Login details are not valid') }}
                    </div>
                </div>
            @endif
            @if (session('erorr'))
                <div class="alert alert-danger" role="alert">
                    {{ session('erorr') }}
                </div>
            @endif
            <form action="{{ route('teacher.auth.login') }}" method="POST">
                @csrf
                <div>
                    <label for="inputEmail" class="form-label">{{__('Email')}}</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                        placeholder="{{__('Enter Email')}}">
                </div>
                <div>
                    <label for="inputPassword" class="form-label">{{__('Password')}}</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                        placeholder="{{__('Enter Password')}}">
                </div>
                <div class="remember d-flex justify-content-between">
                    <div>
                        <label for="remember_me">
                            <input id="remember_me" type="checkbox" class="" name="remember">
                            <span class="">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div>
                        <a class="" href="{{ route('student.auth.password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                </div>
                <div class="footer">
                    <div>
                        <button type="submit" class="btn">{{__('Log in')}}</button>
                    </div>
                    <p>{{__("Don't have an account?")}}
                        <a href="{{ route('teacher.auth.register') }}"> {{__('Sign up')}} </a>{{__('for free')}}
                    </p>
                </div>

            </form>
        </div>
        <div class="left">
            <img src="{{ url('assets/img/background-1.png') }}" class="img-fluid" alt="" srcset="">

        </div>

    </div>
</div>
