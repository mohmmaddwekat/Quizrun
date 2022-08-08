<aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('teacher.home') }}" class="brand-link">
        <img src="{{ url('/assets/img/logo.png') }}" alt="QUIZRUN {{__('Logo')}}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">QUIZRUN</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @php
                    $path = Auth::guard('teacher')->user()->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . Auth::guard('teacher')->user()->image;
                @endphp
                <img src="{{ $path }}" class="img-circle elevation-2" alt="{{__('User Image')}}">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ Auth::guard('teacher')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">{{ __('Control Panel') }}</li>
                <li class="nav-item">
                    <a href="{{ route('teacher.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Home') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.group.index') }}" class="nav-link">
                        <i class="fa-solid fa-layer-group"></i> 
                        <p>
                            {{ __('Group') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.course.index') }}" class="nav-link">
                        <i class="fa-solid fa-book-open"></i>
                        <p>
                            {{ __('Courses') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.section.index') }}" class="nav-link">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <p>
                            {{ __('Sections') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.image.index') }}" class="nav-link">
                        <i class="fa-solid fa-image"></i>
                        <p>
                            {{ __('Image') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teacher.video.index') }}" class="nav-link">
                        <i class="fa-solid fa-video"></i>
                        <p>
                            {{ __('Video') }}
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    <div class="sidebar-custom">
        <a href="{{ route('admin.auth.logout') }}"
            class="btn btn-secondary hide-on-collapse pos-right">{{ __('Logout') }}</a>
    </div>
    <!-- /.sidebar-custom -->
</aside>
