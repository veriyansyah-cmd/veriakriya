@extends('layouts.app')

@section('title', 'Panel Admin - Manajemen Produk VeriaKriya')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold font-serif-brand mb-1">Dashboard Produk UMKM</h1>
        <p class="text-muted small mb-0">Kelola inventaris, harga, kategori, dan foto katalog VeriaKriya.</p>
    </div>
    <a href="{{ route('admin.produk.create') }}" class="btn btn-vk-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Produk Baru
    </a>
</div>

<!-- Kartu Ringkasan Statistik -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 bg-success-subtle text-success p-3">
                    <i class="bi bi-box2-heart fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Total Produk</small>
                    <span class="h4 fw-bold mb-0">{{ $produks->count() }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 bg-primary-subtle text-primary p-3">
                    <i class="bi bi-tags fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Kategori Aktif</small>
                    <span class="h4 fw-bold mb-0">{{ $produks->pluck('kategori_id')->unique()->count() }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 bg-info-subtle text-info p-3">
                    <i class="bi bi-layers fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Total Stok Unit</small>
                    <span class="h4 fw-bold mb-0">{{ $produks->sum('stok') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-3 bg-warning-subtle text-warning p-3">
                    <i class="bi bi-exclamation-triangle fs-4"></i>
                </div>
                <div>
                    <small class="text-muted d-block">Stok Menipis (&lt;10)</small>
                    <span class="h4 fw-bold mb-0">{{ $produks->where('stok', '<', 10)->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Daftar Produk -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-3 px-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span class="fw-bold">Daftar Inventaris Produk</span>
        <div class="input-group input-group-sm" style="max-width: 260px;">
            <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
            <input type="text" id="filterTabelAdmin" class="form-control bg-light border-start-0" placeholder="Filter cepat nama/kategori...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" id="tabelProdukAdmin">
            <thead class="table-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" width="60">No</th>
                    <th width="85">Foto</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th width="175" class="text-center pe-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $index => $produk)
                    <tr>
                        <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                        <td>
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}"
                                     alt="{{ $produk->nama_produk }}"
                                     class="rounded-3 border shadow-sm"
                                     width="58" height="58"
                                     style="object-fit: cover;">
                            @else
                                <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted" style="width: 58px; height: 58px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $produk->nama_produk }}</div>
                            <small class="text-muted">{{ Str::limit($produk->deskripsi, 50) }}</small>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-success-subtle text-success px-3 py-1">
                                {{ $produk->kategori->nama_kategori }}
                            </span>
                        </td>
                        <td class="fw-semibold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                        <td>
                            @if ($produk->stok < 10)
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2">
                                    {{ $produk->stok }} unit
                                </span>
                            @else
                                <span class="badge bg-light text-dark border rounded-pill px-2">
                                    {{ $produk->stok }} unit
                                </span>
                            @endif
                        </td>
                        <td class="text-center pe-4">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('katalog.show', $produk) }}" class="btn btn-outline-secondary" title="Lihat di Publik">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.produk.edit', $produk) }}" class="btn btn-outline-warning text-dark" title="Edit Produk">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $produk) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-end" title="Hapus Produk">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada data produk UMKM.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('filterTabelAdmin')?.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('#tabelProdukAdmin tbody tr').forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
        });
    });
</script>
@endpush