@extends('layouts.app')

@section('title', $produk->nama_produk . ' - VeriaKriya')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-white px-3 py-2 rounded-pill shadow-sm d-inline-flex small">
        <li class="breadcrumb-item">
            <a href="{{ route('katalog.index') }}" class="text-success text-decoration-none">Katalog</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('katalog.index', ['kategori' => $produk->kategori_id]) }}" class="text-success text-decoration-none">
                {{ $produk->kategori->nama_kategori }}
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
    </ol>
</nav>

<!-- Kartu Detail Produk -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <div class="row g-0">
        <div class="col-lg-6 bg-light d-flex align-items-center justify-content-center">
            @if ($produk->gambar)
                <img src="{{ asset('storage/' . $produk->gambar) }}"
                     class="w-100 h-100"
                     style="object-fit: cover; max-height: 520px;"
                     alt="{{ $produk->nama_produk }}">
            @else
                <div class="py-5 text-center text-secondary">
                    <i class="bi bi-image" style="font-size: 4.5rem;"></i>
                    <p class="mt-2 mb-0">Foto Belum Diunggah</p>
                </div>
            @endif
        </div>

        <div class="col-lg-6">
            <div class="card-body p-4 p-lg-5 d-flex flex-column h-100">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="badge rounded-pill bg-success-subtle text-success fw-semibold px-3 py-2">
                        {{ $produk->kategori->nama_kategori }}
                    </span>
                    <span class="badge rounded-pill {{ $produk->stok > 0 ? 'bg-light text-dark border' : 'bg-danger' }} px-3 py-2">
                        <i class="bi bi-box-seam me-1"></i>
                        {{ $produk->stok > 0 ? "Stok: {$produk->stok} unit" : 'Stok Habis' }}
                    </span>
                </div>

                <h1 class="h2 fw-bold font-serif-brand mb-2">{{ $produk->nama_produk }}</h1>

                <div class="fs-2 fw-bold mb-4" style="color: var(--vk-primary);">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </div>

                <h6 class="fw-bold text-uppercase text-muted small letter-spacing-1">Deskripsi & Spesifikasi</h6>
                <p class="text-secondary mb-4" style="line-height: 1.8;">
                    {{ $produk->deskripsi }}
                </p>

                <!-- Keunggulan UMKM -->
                <div class="row g-2 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 rounded-3 bg-light border h-100 d-flex align-items-center gap-2">
                            <i class="bi bi-patch-check-fill text-success fs-4"></i>
                            <div class="small">
                                <div class="fw-bold">Buatan Tangan</div>
                                <span class="text-muted">Karya pengrajin lokal</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 rounded-3 bg-light border h-100 d-flex align-items-center gap-2">
                            <i class="bi bi-shield-check text-success fs-4"></i>
                            <div class="small">
                                <div class="fw-bold">Kualitas Terkurasi</div>
                                <span class="text-muted">Lolos pemeriksaan mutu</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                @php
                    $pesanWa = urlencode("Halo VeriaKriya, saya tertarik memesan produk *{$produk->nama_produk}* (Rp " . number_format($produk->harga, 0, ',', '.') . "). Apakah stok masih tersedia?");
                @endphp
                <div class="d-flex flex-wrap gap-2 mt-auto pt-3 border-top">
                    <a href="https://wa.me/6281234567890?text={{ $pesanWa }}"
                       target="_blank"
                       class="btn btn-vk-primary btn-lg rounded-pill px-4 fw-semibold flex-grow-1">
                        <i class="bi bi-whatsapp me-2"></i> Pesan via WhatsApp
                    </a>
                    <a href="{{ route('katalog.index') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Produk Sejenis -->
@if ($produkTerkait->isNotEmpty())
    <section class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="h4 fw-bold font-serif-brand mb-0">Produk Sejenis Lainnya</h3>
            <a href="{{ route('katalog.index', ['kategori' => $produk->kategori_id]) }}" class="text-success text-decoration-none fw-semibold small">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($produkTerkait as $item)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm card-produk">
                        <a href="{{ route('katalog.show', $item) }}" class="text-decoration-none">
                            <div class="img-wrapper" style="height: 190px;">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-image fs-2"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="card-body">
                            <h6 class="fw-bold mb-1">
                                <a href="{{ route('katalog.show', $item) }}" class="text-dark text-decoration-none">
                                    {{ $item->nama_produk }}
                                </a>
                            </h6>
                            <div class="fw-bold text-success">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endif
@endsection