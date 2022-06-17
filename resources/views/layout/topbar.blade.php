  <!-- Topbar Start -->
  <div class="navbar-custom">
       <button class="button-menu-mobile open-left disable-btn">
          <i class="mdi mdi-menu"></i>
      </button>
      {{--
      <div class="app-search dropdown d-none d-lg-inline-block">
          <form>
              <div class="input-group">
                  <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                  <span class="mdi mdi-magnify search-icon"></span>
                  <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Search</button>
                  </div>
              </div>
          </form>
      </div> --}}

      {{-- account --}}
      <ul class="list-unstyled topbar-right-menu float-right mb-0">
          <li class="dropdown notification-list">
              <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" href="#" role="button"
                  aria-haspopup="false" aria-expanded="false">
                  <span class="account-user-avatar">
                      <img src="{{ asset('images/logoFStack.jpg') }}" alt="user-image" class="rounded-circle">
                  </span>
                  <span>
                      <span class="account-user-name">{{ session()->get('MaGiangVien') }}</span>
                      <span class="account-position"><?php
                      if (session()->get('Quyen') === 0) {
                          echo 'Người quản lý';
                      } elseif (session()->get('Quyen') === 1) {
                          echo 'Giảng viên';
                      } elseif (session()->get('Quyen') === 2) {
                          echo 'Tài khoản bị khóa';
                      } else {
                          echo 'Quyền ảo';
                      }
                      ?></span>
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                  style="">
                  <!-- item-->
                  <div class=" dropdown-header noti-title">
                      <h6 class="text-overflow m-0">Chào mừng !</h6>
                  </div>

                  <!-- item-->
                  {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                      <i class="mdi mdi-lifebuoy mr-1"></i>
                      <span>Trợ giúp</span>
                  </a> --}}

                  <a href="{{ route('doimatkhau') }}" class="dropdown-item notify-item">
                      <i class="mdi mdi-lock-reset mr-1"></i>
                      <span>Đổi mật khẩu</span>
                  </a>

                  <!-- item-->
                  <a href="{{ route('dangxuat') }}" class="dropdown-item notify-item">
                      <i class="mdi mdi-logout mr-1"></i>
                      <span>Đăng xuất</span>
                  </a>

              </div>
          </li>
      </ul>
  </div>
  <!-- end Topbar -->
