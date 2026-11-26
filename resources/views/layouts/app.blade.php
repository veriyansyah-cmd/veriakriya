<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VeriaKriya - Galeri Kriya & Kerajinan UMKM Nusantara')</title>

    <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --vk-primary: #14532d;
            --vk-primary-hover: #166534;
            --vk-accent: #d97706;
            --vk-bg: #fafaf9;
            --vk-surface: #ffffff;
            --vk-text: #1c1917;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--vk-bg);
            color: var(--vk-text);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .font-serif-brand {
            font-family: 'Playfair Display', serif;
        }

        main {
            flex: 1;
        }

        /* Navbar Glassmorphism */
        .navbar-veria {
            background-color: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--vk-primary), #15803d);
            color: #fff;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-vk-primary {
            background-color: var(--vk-primary);
            border-color: var(--vk-primary);
            color: #fff;
            transition: all 0.2s ease;
        }

        .btn-vk-primary:hover {
            background-color: var(--vk-primary-hover);
            border-color: var(--vk-primary-hover);
            color: #fff;
            transform: translateY(-1px);
        }

        /* Hero Section */
        .hero-veria {
            background: linear-gradient(135deg, #052e16 0%, #14532d 55%, #166534 100%);
            border-radius: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .hero-veria::after {
            content: '';
            position: absolute;
            top: -40%;
            right: -10%;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(217, 119, 6, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Kartu Produk Profesional */
        .card-produk {
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.28s ease, box-shadow 0.28s ease;
            background: var(--vk-surface);
        }

        .card-produk:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 35px rgba(20, 83, 45, 0.1) !important;
        }

        .card-produk .img-wrapper {
            position: relative;
            height: 240px;
            overflow: hidden;
            background-color: #f5f5f4;
        }

        .card-produk img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .card-produk:hover img {
            transform: scale(1.06);
        }

        .badge-stok-overlay {
            position: absolute;
            top: 12px;
            right: 12px;
            backdrop-filter: blur(6px);
            font-weight: 600;
            font-size: 0.75rem;
        }

        .filter-pill {
            border-radius: 50rem;
            padding: 0.45rem 1.1rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-veria sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold fs-4 text-dark" href="{{ route('katalog.index') }}">
                <span class="brand-icon shadow-sm">
                    <i class="bi bi-flower1 fs-5"></i>
                </span>
                <span class="font-serif-brand" style="color: var(--vk-primary);">VeriaKriya</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link px-3 rounded-pill {{ request()->routeIs('katalog.*') ? 'fw-semibold text-success bg-success-subtle' : 'text-secondary' }}"
                           href="{{ route('katalog.index') }}">
                            <i class="bi bi-grid me-1"></i> Etalase Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-vk-primary rounded-pill px-4 py-2 fw-semibold shadow-sm"
                           href="{{ route('admin.produk.index') }}">
                            <i class="bi bi-sliders me-1"></i> Panel Admin UMKM
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 py-md-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-4 alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-md-6 text-center text-md-start">
                    <span class="font-serif-brand fw-bold fs-5" style="color: var(--vk-primary);">VeriaKriya</span>
                    <p class="text-muted small mb-0 mt-1">
                        Platform kurasi dan pemasaran kerajinan tangan asli pengrajin UMKM Nusantara.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end text-muted small">
                    &copy; {{ date('Y') }} VeriaKriya UMKM Indonesia. Hak Cipta Dilindungi.
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>