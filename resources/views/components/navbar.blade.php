<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- Other CSS files as needed -->
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <i class="bi bi-list toggle-sidebar-btn"></i>
    <a href="#" class="logo d-flex align-items-center"></a>
  </div><!-- End Logo -->

  <h2 class="d-none d-lg-block">Mathematics-challenges</h2>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon -->

      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{ asset('assets/img/OPIS.A.jpg') }}" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">ADMIN-MTC</span>
        </a><!-- End Profile Image Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>OPIS.A</h6>
            <span>Admin-MTC</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          
          <li>
            <hr class="dropdown-divider">
          </li>
          
          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-in-right"></i>
              <span>Login</span>
            </a>
          </li><!-- End Login Page Nav -->

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('userhome') }}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- Bootstrap JS and dependencies (e.g., Popper.js) -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
