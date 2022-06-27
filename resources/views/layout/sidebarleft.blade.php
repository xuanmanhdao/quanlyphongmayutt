 <!-- ========== Left Sidebar Start ========== -->
 <div class="left-side-menu">

     <!-- LOGO -->
     <a href="{{ route('phong.index') }}" class="logo text-center logo-light">
         <span class="logo-lg" style="color: beige; font-size: 30px;">
             FStack
         </span>
     </a>
     <div class="h-100" id="left-side-menu-container" data-simplebar>

         <!--- Sidemenu -->
         <ul class="metismenu side-nav">

             <li class="side-nav-title side-nav-item">Quản trị</li>

             @if (kiemTraAdmin())
                 <li class="side-nav-item">
                     <a href="{{ route('dashboard') }}" class="side-nav-link">
                         <i class="mdi mdi-monitor-dashboard"></i>
                         <span> Thống kê </span>
                         <span class="menu-arrow"></span>
                     </a>
                 </li>
             @endif


             <li class="side-nav-item">
                 <a href="{{ route('phong.index') }}" class="side-nav-link">
                     <i class="mdi mdi-folder-home"></i>
                     <span> Quản lý phòng </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <ul class="side-nav-second-level" aria-expanded="false">
                     <li>
                         <a href="{{ route('phong.create') }}">Thêm phòng</a>
                     </li>
                 </ul>
             </li>

             <li class="side-nav-item">
                 <a href="{{ route('giangvien.index') }}" class="side-nav-link">
                     <i class="mdi mdi-account-badge-horizontal"></i>
                     <span> Quản lý tài khoản </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <ul class="side-nav-second-level" aria-expanded="false">
                     <li>
                         <a href="{{ route('giangvien.create') }}">Thêm giảng viên</a>
                     </li>
                 </ul>
             </li>

             <li class="side-nav-item">
                 <a href="{{ route('lichmuonphong.index') }}" class="side-nav-link">
                     <i class="mdi mdi-calendar-month"></i>
                     <span> Quản lý lịch đăng ký </span>
                     <span class="menu-arrow"></span>
                 </a>
                 <ul class="side-nav-second-level" aria-expanded="false">
                     <li>
                         <a href="{{ route('lichmuonphong.create') }}">Giao lịch</a>
                     </li>
                 </ul>
             </li>


         </ul>

         <!-- Help Box -->
         <div class="help-box text-white text-center">
             {{-- <a href="javascript: void(0);" class="float-right close-btn text-white">
                 <i class="mdi mdi-close"></i>
             </a> --}}
             {{-- <img src="{{ asset('images/logoFStack.jpg') }}" height="90" alt="Helper Icon Image" /> --}}
             <img src="{{ asset('images/logo-utt-border.png') }}" height="90" alt="Helper Icon Image" />
             <h5 class="mt-3">Sản phẩm đang trong quá trình phát triển</h5>
             <p class="mb-3">Có sự cố vui lòng liên hệ đội kỹ thuật</p>
             {{-- <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Liên hệ</a> --}}
             <a href="{{ route('contact') }}" class="btn btn-outline-light btn-sm">Liên hệ</a>

         </div>
         <!-- end Help Box -->
         <!-- End Sidebar -->

         <div class="clearfix"></div>

     </div>
     <!-- Sidebar -left -->

 </div>
 <!-- Left Sidebar End -->
