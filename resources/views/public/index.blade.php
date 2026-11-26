@extends('layouts.app')

@section('title', 'VeriaKriya - Katalog Produk Kerajinan UMKM Nusantara')

@section('content')
<!-- Hero Banner -->
<section class="hero-veria text-white p-4 p-md-5 mb-5 shadow">
    <div class="row align-items-center gy-4 position-relative" style="z-index: 1;">
        <div class="col-lg-8">
            <span class="badge rounded-pill px-3 py-2 mb-3 fw-semibold" style="background-color: rgba(217, 119, 6, 0.25); color: #fcd34d; border: 1px solid rgba(252, 211, 77, 0.3);">
                <i class="bi bi-award-fill me-1"></i> 100% Karya Pengrajin Lokal Indonesia
            </span>
            <h1 class="display-5 fw-bold font-serif-brand mb-3">
                Sentuhan Hangat Kriya Nusantara untuk Ruang Anda
            </h1>
            <p class="lead text-white-50 mb-4" style="max-width: 620px;">
                Setiap produk dibuat dengan ketelitian tinggi menggunakan bahan alami pilihan langsung dari sentra UMKM daerah.
            </p>
            <div class="d-flex flex-wrap gap-4 pt-2 border-top border-white border-opacity-10">
                <div>
                    <div class="fw-bold fs-5">{{ $produks->count() }}+ Produk</div>
                    <small class="text-white-50">Terkurasi Siap Kirim</small>
                </div>
                <div>
                    <div class="fw-bold fs-5">{{ $kategoris->count() }} Kategori</div>
                    <small class="text-white-50">Anyaman, Tenun & Gerabah</small>
                </div>
                <div>
                    <div class="fw-bold fs-5">Asli UMKM</div>
                    <small class="text-white-50">Dukung Ekonomi Lokal</small>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="#katalog-produk" class="btn btn-light btn-lg rounded-pill px-4 fw-semibold text-success shadow-sm">
                Jelajahi Katalog <i class="bi bi-arrow-down-circle ms-1"></i>
            </a>
        </div>
    </div>
</section>

<!-- Filter & Pencarian -->
<section id="katalog-produk" class="mb-4">
    <div class="row g-3 align-items-center justify-content-between mb-4">
        <div class="col-lg-5">
            <h2 class="h3 fw-bold font-serif-brand mb-1">Koleksi Produk Unggulan</h2>
            <p class="text-muted small mb-0">Pilih kategori atau cari kerajinan sesuai kebutuhan Anda.</p>
        </div>

        <div class="col-lg-5">
            <form action="{{ route('katalog.index') }}" method="GET">
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white border">
                    <span class="input-group-text bg-white border-0 ps-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="cari" class="form-control border-0 shadow-none"
                           placeholder="Cari tas pandan, tenun, gerabah..."
                           value="{{ request('cari') }}">
                    @if (request('cari'))
                        <a href="{{ route('katalog.index', request()->only('kategori')) }}" class="btn btn-link text-muted text-decoration-none">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    @endif
                    <button class="btn btn-vk-primary px-4 fw-semibold" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pills Kategori -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="{{ route('katalog.index', request()->only('cari')) }}"
           class="btn filter-pill {{ !request('kategori') ? 'btn-vk-primary shadow-sm' : 'btn-white bg-white border text-secondary' }}">
            Semua Kategori
        </a>
        @foreach ($kategoris as $kategori)
            <a href="{{ route('katalog.index', array_merge(request()->only('cari'), ['kategori' => $kategori->id])) }}"
               class="btn filter-pill {{ request('kategori') == $kategori->id ? 'btn-vk-primary shadow-sm' : 'btn-white bg-white border text-secondary' }}">
                {{ $kategori->nama_kategori }}
                <span class="badge rounded-pill ms-1 {{ request('kategori') == $kategori->id ? 'bg-white text-success' : 'bg-light text-dark' }}">
                    {{ $kategori->produks_count }}
                </span>
            </a>
        @endforeach
    </div>
</section>

<!-- Grid Produk -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
    @forelse ($produks as $produk)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm card-produk">
                <a href="{{ route('katalog.show', $produk) }}" class="text-decoration-none">
                    <div class="img-wrapper">
                        @if ($produk->gambar)
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-secondary">
                                <i class="bi bi-image fs-1 opacity-50"></i>
                                <span class="small mt-1">{{ $produk->nama_produk }}</span>
                            </div>
                        @endif

                        @if ($produk->stok > 5)
                            <span class="badge bg-white text-success shadow-sm badge-stok-overlay px-3 py-2 rounded-pill">
                                <i class="bi bi-check-circle-fill me-1"></i> Tersedia ({{ $produk->stok }})
                            </span>
                        @elseif ($produk->stok > 0)
                            <span class="badge bg-warning text-dark shadow-sm badge-stok-overlay px-3 py-2 rounded-pill">
                                <i class="bi bi-exclamation-circle-fill me-1"></i> Sisa {{ $produk->stok }}
                            </span>
                        @else
                            <span class="badge bg-danger text-white shadow-sm badge-stok-overlay px-3 py-2 rounded-pill">
                                Stok Habis
                            </span>
                        @endif
                    </div>
                </a>

                <div class="card-body p-4 d-flex flex-column">
                    <div class="mb-2">
                        <span class="badge rounded-pill bg-success-subtle text-success fw-semibold px-3 py-1">
                            {{ $produk->kategori->nama_kategori }}
                        </span>
                    </div>

                    <h5 class="card-title fw-bold mb-2">
                        <a href="{{ route('katalog.show', $produk) }}" class="text-dark text-decoration-none">
                            {{ $produk->nama_produk }}
                        </a>
                    </h5>

                    <p class="card-text text-muted small flex-grow-1" style="line-height: 1.6;">
                        {{ Str::limit($produk->deskripsi, 95) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.72rem;">Harga Satuan</small>
                            <span class="fw-bold fs-5" style="color: var(--vk-primary);">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                        </div>
                        <a href="{{ route('katalog.show', $produk) }}" class="btn btn-vk-primary rounded-pill px-3 py-2 btn-sm fw-semibold">
                            Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="bg-white rounded-4 p-5 text-center shadow-sm border">
                <i class="bi bi-search fs-1 text-muted opacity-50"></i>
                <h5 class="fw-bold mt-3">Produk tidak ditemukan</h5>
                <p class="text-muted small mb-3">Coba ubah kata kunci pencarian atau pilih kategori lainnya.</p>
                <a href="{{ route('katalog.index') }}" class="btn btn-vk-primary rounded-pill px-4">Reset Filter</a>
            </div>
        </div>
    @endforelse
</div>
@endsection