<div class="register">
    <div class="content">
        <div class="right">
            <div class="account">
                {{-- </div> --}}
                <p class="fs-1 header">{{ __('What is account type?') }}</h1>
                    <div class="type">
                    <a href="{{ route('teacher.auth.register') }}">
                        <div class="icon">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <div class="text">
                            {{ __('Teacher Account') }}
                        </div>
                        <div class="arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </a>
                    </div>
                    <div class="type">
                    <a href="{{ route('student.auth.register') }}">
                        <div class="icon">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="text">
                            {{ __('Student Account') }}
                        </div>
                        <div class="arrow">
                            <i class="fa-solid fa-angle-right"></i>
                        </div>
                    </a>
                    </div>
            </div>
        </div>
        <div class="left">
            <img src="{{ url('assets/img/background-9.png') }}" class="img-fluid" alt="" srcset="">

        </div>

    </div>
</div>
