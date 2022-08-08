<nav class="navbar navbar-expand-lg nav-public">
    <div class="container-fluid">
        <a class="navbar-brand logo img-fluid" href="#"><img src="{{ url('assets/img/QUIZRUN.png') }}" alt=""
                srcset=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" aria-current="page" href="{{route('home')}}">{{__('Home')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('register')}}">{{__('Register')}}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" href="#">
                        @if (session('lang') == 'en')
                            <i class="flag-icon flag-icon-us"></i>
                        @else
                            <i class="flag-icon flag-icon-eg mr-2"></i>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0">
                        <a href="{{ url()->current() . '?lang=en' }}"
                            class="dropdown-item @if (session('lang') == 'en') active @endif">
                            <i class="flag-icon flag-icon-us mr-2"></i> {{ __('English') }}
                        </a>
                        <a href="{{ url()->current() . '?lang=ar' }}"
                            class="dropdown-item @if (session('lang') == 'ar') active @endif">
                            <i class="flag-icon flag-icon-eg mr-2"></i> {{ __('Arabic') }}
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
