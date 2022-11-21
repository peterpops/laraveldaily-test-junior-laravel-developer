<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', 'resources/js/bootstrap.js'])
        @inertiaHead
    </head>

    <body class="vendite">

<!-- Site wrapper -->
<div class="wrapper">
  <!-- teleport: side Navbar -->
  <div id="sidebar"></div>

  <!-- header -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <!-- teleport: header-title -->
        <h4 id="header-title" class="nav-link pl-0"></h4>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item" id="userdata"></li>

    </ul>
  </nav>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-2 pb-2">
    <!-- Main content -->
    <section class="content">
      @inertia
    </section>
  </div>

  <footer class="main-footer pt-2 pr-0 pb-2 pl-2">
    <strong>Copyright © 2022-{{ date('Y') }}.</strong> All rights reserved. <span class="font-italic">Version 22.11.0</span>
    <div class="float-right">
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark" style="display: block;">
    <!-- teleport: right-sidebar -->
    <div id="right-sidebar" class="p-0 control-sidebar-content" style="height:100%;"></div>
  </aside>
</div>
</body>
</html>
