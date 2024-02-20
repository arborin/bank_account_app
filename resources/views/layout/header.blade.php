 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="{{ route('accounts.index') }}" class="logo d-flex align-items-center">
             <img src="{{ asset('assets/img/logo.png') }}" alt="">
             <span class="d-none d-lg-block">ReportExport</span>
         </a>
         <i class="bi bi-list toggle-sidebar-btn"></i>
     </div><!-- End Logo -->


     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">
             <li class="nav-item dropdown pe-3">

                 <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#">
                     <span class="d-md-block">{{ date('d-m-Y') }}</span>
                 </a><!-- End Profile Iamge Icon -->
             </li><!-- End Profile Nav -->

         </ul>
     </nav><!-- End Icons Navigation -->

 </header><!-- End Header -->
