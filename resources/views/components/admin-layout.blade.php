<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/plugins/bootstrap-icons/bootstrap-icons.min.css') }}">
    
    <!-- ApexCharts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous">
    
    <!-- jsvectormap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css" crossorigin="anonymous">
    <!-- end plugin styles -->

    <!-- Static AdminLTE assets served from public/adminlte -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/plugins/overlayscrollbars/overlayscrollbars.min.css') }}">
    <!-- additional plugin styles (bootstrap-icons, apexcharts, jsvectormap) remain CDN-loaded -->

    <style>
        :root {
            --lte-primary: #0d6efd;
        }
    </style>
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Header/Navbar -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ route('index') }}" class="nav-link">
                            <i class="bi bi-house"></i> Website
                        </a>
                    </li>
                </ul>
                
                <!-- Right navbar links -->
                <ul class="navbar-nav ms-auto">
                    <!-- User Menu -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('images/adminlte/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset('images/adminlte/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    {{ Auth::user()->name }} - Administrator
                                    <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat float-end">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Header/Navbar -->

        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!-- Sidebar Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link">
                    <img src="{{ asset('images/adminlte/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">Admin Panel</span>
                </a>
            </div>
            <!-- End Sidebar Brand -->

            <!-- Sidebar Wrapper -->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview" role="menu">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer2"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header">УПРАВЛІННЯ</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>
                                    Users
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>All Users</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Add New User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark"></i>
                                <p>
                                    Posts
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>All Posts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Create Post</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-chat-dots"></i>
                                <p>
                                    Comments
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Pending</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Approved</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">ІНШЕ</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-calendar"></i>
                                <p>Calendar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Sidebar Wrapper -->
        </aside>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <main class="app-main">
            <!-- Page Header -->
            @isset($header)
                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">{{ $header }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            <!-- Page Content -->
            <div class="app-content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </div>
        </main>
        <!-- End Content Wrapper -->

        <!-- Footer -->
        <footer class="app-footer">
            <strong>Copyright &copy; 2026 <a href="#">Your Website</a>.</strong> All rights reserved.
            <div class="float-end d-none d-sm-inline">
                <b>Version</b> 4.0.0
            </div>
        </footer>
    </div>

    <!-- Bootstrap (bundled in Vite) -->
    
    <!-- OverlayScrollbars (local copy) -->
    <script src="{{ asset('adminlte/dist/plugins/overlayscrollbars/overlayscrollbars.browser.es6.min.js') }}" crossorigin="anonymous"></script>
    
    <!-- AdminLTE JS -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
    
    <!-- jsvectormap -->
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/jsvectormap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/jquery.vmap.world.js" crossorigin="anonymous"></script>

    <script>
        // Set theme on page load
        const htmlTag = document.documentElement;
        if (localStorage.getItem('theme') === 'dark') {
            htmlTag.setAttribute('data-bs-theme', 'dark');
        }
    </script>
</body>
</html>
