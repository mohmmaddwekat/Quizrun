  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
          <img src="{{ url('/assets/img/logo.png') }}" alt="QUIZRUN" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">QUIZRUN</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  @php
                      $path = Auth::guard('admin')->user()->image == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . Auth::guard('admin')->user()->image;
                  @endphp
                  <img src="{{ $path}}" class="img-circle elevation-2" alt="{{__('User Image')}}">
              </div>
              <div class="info">
                  <a href="" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
              </div>
          </div>
          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="{{ __('Search') }}"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-header">{{ __('Control Panel') }}</li>
                  <li class="nav-item">
                      <a href="{{ route('admin.dashboard') }}" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              {{ __('Dashboard') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-header">{{ __('People') }}</li>
                  <li class="nav-item">
                      <a href="{{ route('admin.teacher.index') }}" class="nav-link">
                          <i class="fas fa-user-tie"></i>
                          <p>
                              {{ __('Teacher') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.admins.index') }}" class="nav-link">
                          <i class="fa-solid fa-user-gear"></i>
                          <p>
                              {{ __('Admins') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.student.index') }}" class="nav-link">
                          <i class="fas fa-user"></i>
                          <p>
                              {{ __('Student') }}
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.category.index') }}" class="nav-link">
                        <i class="fa-solid fa-layer-group"></i>
                          <p>
                              {{ __('Category') }}
                          </p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->

      <div class="sidebar-custom">
          <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
          <a href="{{ route('admin.auth.logout') }}"
              class="btn btn-secondary hide-on-collapse pos-right">{{ __('Logout') }}</a>
      </div>
      <!-- /.sidebar-custom -->
  </aside>
