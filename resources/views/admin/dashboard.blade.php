<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | Portal Berita</title>
    <link rel="stylesheet" href="{{ asset('adminlte4/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        <!-- Navbar -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span class="ms-2">{{ auth()->user()->name ?? 'Admin' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><span class="dropdown-item-text">{{ auth()->user()->email ?? '' }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('auth.logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand"> <a href="{{ route('admin.dashboard') }}" class="brand-link"> <span class="brand-text fw-light">Portal Admin</span> </a> </div>
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column">
                        <li class="nav-item"> 
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i> <p>Dashboard</p> </a> 
                        </li>
                        <li class="nav-item"> 
                            <a href="{{ route('admin.categories.index') }}" class="nav-link"> <i class="nav-icon bi bi-list-ul"></i> <p>Kategori</p> </a> 
                        </li>
                        <li class="nav-item"> 
                            <a href="{{ route('admin.news.create') }}" class="nav-link"> <i class="nav-icon bi bi-newspaper"></i> <p>Post Berita</p> </a> 
                        </li>
                        <li class="nav-item"> 
                            <a href="{{ route('admin.news.index') }}" class="nav-link"> <i class="nav-icon bi bi-table"></i> <p>Daftar Berita</p> </a> 
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <main class="app-main">
            <div class="container-fluid p-4">
                @yield('content') 
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", showConfirmButton: false, timer: 2000 });
        @endif
    </script>
    <script src="{{ asset('adminlte4/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>