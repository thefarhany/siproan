<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('title')

  <!-- PWA  -->
  <meta name="theme-color" content="#6777ef" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="manifest" href="{{ asset('manifest.json') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">

  <!-- Favicon -->
  <!-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}"> -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('site.webmanifest') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <!-- Sidebar -->
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="h4 text-center">Siproan</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="{{ route('dashboard-siwas') }}" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('data-pekerjaan') }}" class="nav-link">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>Data Pekerjaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Jenis Pembayaran
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('pekerjaan-reguler') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reguler</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pekerjaan-swakelola') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SWAKELOLA</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pekerjaan-sbsn') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SBSN</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pekerjaan-hibah') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Hibah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pekerjaan-blu') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>BLU</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="{{ route('cetak-data') }}" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>Cetak Data</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('lapjusik-siwas') }}" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Lapjusik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('dokumentasi') }}" class="nav-link">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>Dokumentasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('about') }}" class="nav-link">
                <i class="nav-icon fas fa-info-circle"></i>
                <p>About</p>
              </a>
            </li>
            <li class="nav-item">
              <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>

          </ul>
        </nav>
      </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </section>
    </div>

    <footer class="main-footer">
      <strong>Copyright &copy; 2024</strong>
      Aplikasi Laporan SIWAS.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.2.0
      </div>
    </footer>
  </div>

  <script src="{{ asset('/sw.js') }}"></script>
  <script>
    if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("/sw.js").then(
        (registration) => {
          console.log("Service worker registration succeeded:", registration);
        },
        (error) => {
          console.error(`Service worker registration failed: ${error}`);
        },
      );
    } else {
      console.error("Service workers are not supported.");
    }
  </script>

  <!-- jQuery -->
  <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE -->
  <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
</body>

</html>