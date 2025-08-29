
  <nav class="navbar navbar-expand navbar-light navbar-bg">
      <!-- Sidebar toggle -->
      <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
      </a>

      <div class="navbar-collapse collapse justify-content-end">
          <ul class="navbar-nav navbar-align">

              <!-- User Profile -->
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="{{ asset('assets/images/profile/user-1.jpg') }}" class="avatar img-fluid rounded me-1" alt="{{ Auth::user()->name ?? 'User' }}" width="35" height="35">
                      <span class="text-dark">{{ Auth::user()->name ?? 'User' }}</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                   
                      <div class="dropdown-divider"></div>
                      <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         Logout
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>

          </ul>
      </div>
  </nav>

