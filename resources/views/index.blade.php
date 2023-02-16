<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- CSS -->
  @include('layouts.css')
  <!-- End CSS -->
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <!-- Sidebar -->
  @include('layouts.sidebar')
  <!-- End Sidebar -->
  <main class="main-content position-relative border-radius-lg ">
  <!-- Navbar -->
  @include('layouts.navbar')
  <!-- End Navbar -->
  <!-- Pages -->
  @yield('content')
  <!-- End Pages -->
  <!-- Footer -->
  @include('layouts.footer')
  <!-- End Footer -->
  </main>
  <!-- Config -->
  @include('layouts.config')
  <!-- End Config -->
  <!--   Core JS Files   -->
  @include('layouts.js')
  <!-- End JS -->
</body>

</html>