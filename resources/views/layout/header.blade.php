 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="{{ route('accounts.index') }}" class="logo d-flex align-items-center">
             <img src="{{ asset('assets/img/logo.png') }}" alt="">
             <span class="d-none d-lg-block">Bulk Payment System</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->


     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">
             {{-- <li class="nav-item dropdown pe-3">
                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#">
                     <span class="d-md-block text-secondary"></span>
                 </a>
             </li> --}}

             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"
                     aria-expanded="true">
                     <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                 </a><!-- End Profile Iamge Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                     style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-16px, 38px);"
                     data-popper-placement="bottom-end">
                     <li class="dropdown-header">
                         <h6>{{ Auth::user()->email }}</h6>
                         <span>Administrator</span>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li>
                         <a class="dropdown-item d-flex align-items-center"
                             href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">
                             <i class="bi bi-person"></i>
                             <span>My Profile</span>
                         </a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>


                     <li>
                         <form action="/logout" method="post">
                             @csrf
                             <button class="dropdown-item d-flex align-items-center" href="#">
                                 <i class="bi bi-box-arrow-right"></i>
                                 <span>Sign Out</span>
                             </button>
                         </form>
                     </li>

                 </ul><!-- End Profile Dropdown Items -->
             </li>

         </ul>
     </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
