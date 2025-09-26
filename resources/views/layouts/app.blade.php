<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Property Management') }} - @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <style>
            .sidebar {
                min-height: 100vh;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .sidebar .nav-link {
                color: rgba(255, 255, 255, 0.8);
                padding: 12px 20px;
                border-radius: 8px;
                margin: 2px 0;
                transition: all 0.3s ease;
            }

            .sidebar .nav-link:hover,
            .sidebar .nav-link.active {
                color: white;
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
            }

            .main-content {
                background-color: #f8f9fa;
                min-height: 100vh;
            }

            .card {
                border: none;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            }

            .stats-card {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .navbar-brand {
                font-weight: 600;
            }

            .btn-custom {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                color: white;
            }

            .btn-custom:hover {
                background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
                color: white;
            }
        </style>
        @yield('styles')
    </head>

    <body>
        <div class="container-fluid p-0">
            <div class="row g-0">
                <!-- Sidebar -->
                <div class="col-md-2 sidebar">
                    <div class="p-3">
                        <h4 class="mb-4">
                            <i class="fas fa-building"></i>
                            Flat Bill Management
                        </h4>

                        <nav class="nav flex-column">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>

                            @if (auth()->user()->isAdmin())
                                <a class="nav-link {{ request()->routeIs('admin.house-owners.*') ? 'active' : '' }}"
                                    href="{{ route('admin.house-owners.index') }}">
                                    <i class="fas fa-users me-2"></i>
                                    House Owners
                                </a>
                                <a class="nav-link {{ request()->routeIs('admin.tenants.*') ? 'active' : '' }}"
                                    href="{{ route('admin.tenants.index') }}">
                                    <i class="fas fa-user-friends me-2"></i>
                                    All Tenants
                                </a>
                            @else
                                <a class="nav-link {{ request()->routeIs('flats.*') ? 'active' : '' }}"
                                    href="{{ route('flats.index') }}">
                                    <i class="fas fa-home me-2"></i>
                                    My Flats
                                </a>

                                {{-- <a class="nav-link {{ request()->routeIs('bills.*') ? 'active' : '' }}" href="{{ route('bills.index') }}">
                                <i class="fas fa-file-invoice me-2"></i>
                                Bills
                            </a>
                            <a class="nav-link {{ request()->routeIs('bill-categories.*') ? 'active' : '' }}" href="{{ route('bill-categories.index') }}">
                                <i class="fas fa-tags me-2"></i>
                                Bill Categories
                            </a> --}}
                            @endif
                            <a class="nav-link {{ request()->routeIs('bill-category.*') ? 'active' : '' }}"
                                href="{{ route('bill-category.index') }}">
                                <i class="fas fa-tags me-2"></i>
                                Bill Category
                            </a>
                            <a class="nav-link {{ request()->routeIs('bills.*') ? 'active' : '' }}"
                                href="{{ route('bills.index') }}">
                                <i class="fas fa-file-invoice me-2"></i>
                                Bills
                            </a>
                            <hr class="my-3 opacity-25">

                            {{-- <a class="nav-link" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user-cog me-2"></i>
                            Profile
                        </a> --}}

                            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                                    <i class="fas fa-sign-out-alt me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-10 main-content">
                    <!-- Top Navigation -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                        <div class="container-fluid">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    @yield('breadcrumb')
                                </ol>
                            </nav>

                            <div class="navbar-nav ms-auto">
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                        role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle fa-lg me-2"></i>
                                        {{ auth()->user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        {{-- <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-cog me-2"></i>Profile
                                    </a></li> --}}
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!-- Page Content -->
                    <div class="p-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @yield('scripts')
    </body>

</html>
