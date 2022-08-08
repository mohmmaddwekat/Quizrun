  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="" class="nav-link">{{ __('Home') }}</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link " id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false"
                  href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge unread">{{ $unread }}</span>
              </a>
              <div class="notifications dropdown-menu dropdown-menu-lg dropdown-menu-right"
                  aria-labelledby="dropdownMenuButton4">
                  @foreach ($notifications as $key => $notification)
                      <div>
                          @if ($key < 4)
                              <a href="{{ route('teacher.notification.read', $notification->id) }}"
                                  class="dropdown-item">
                                  <!-- Message Start -->
                                  <div class="media">
                                      @php
                                          $path = $notification->data['sender']['image'] == null ? '/assets/img/avatar-placeholder.png' : '/assets/uploads/' . $notification->data['sender']['image'];
                                      @endphp
                                      <img src="{{ $path }}" alt="User Avatar"
                                          class="img-size-50 mr-3 img-circle">
                                      <div class="media-body">
                                          <h3 class="dropdown-item-title">
                                              {{ $notification->data['title'] }}
                                          </h3>
                                          <p class="text-sm text-truncate">

                                              {{ $notification->data['body'] }}</p>
                                          <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                              {{ $notification->created_at->diffForHumans() }}</p>
                                      </div>
                                  </div>
                                  <!-- Message End -->
                              </a>
                              <div class="dropdown-divider"></div>
                          @endif
                      </div>
                  @endforeach
                  <a href="{{ route('student.notification.show') }}"
                      class="dropdown-item dropdown-footer">{{ __('See All Notifications') }}</a>
              </div>
          </li>
          <!-- Language Dropdown Menu -->
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
          <!-- Theme Item -->
          <li class="nav-item">
              <a class="nav-link" data-slide="true" href="#">
                  <div class="custom-control  custom-switch">
                      <input type="checkbox" class="custom-control-input" id="customSwitch1"
                          @if ($theme == 'dark-mode') checked @endif>
                      <label class="custom-control-label" for="customSwitch1"></label>
                  </div>
              </a>
          </li>
          <!-- Logout  Dropdown Menu-->
          <li class="nav-item dropdown">
              <a class="nav-link " id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                  href="#">
                  <i class="fas fa-sign-in-alt"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                  <a href="{{ route('teacher.auth.logout') }}" class="dropdown-item">
                      <i class="fas fa-user-circle"></i>
                      <span class="float-right text-muted text-sm">{{ __('Logout') }}</span>
                  </a>


              </div>
          </li>

      </ul>
  </nav>

  <script>
      var intervalId = window.setInterval(function() {
          $.ajax({
              headers: {
                  "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
              },
              url: "/teacher/notification/",
              // contentType: "application/json; charset=utf-8",
              type: "GET",
              dataType: "json",
              success: function(results) {
                  if (results.length) {
                      $(".unread").html(results[1]);
                      $(".notifications").html(results[0]);
                  }
              },
          });
      }, 1000);
  </script>
