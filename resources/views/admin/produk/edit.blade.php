@extends('layouts.app')

@section('title', 'Edit Produk - Admin VeriaKriya')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.produk.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Produk
    </a>
    <h1 class="h3 fw-bold font-serif-brand mt-1">Edit Produk: {{ $produk->nama_produk }}</h1>
</div>

<form action="{{ route('admin.produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Informasi Dasar Produk</h5>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk"
                           class="form-control form-control-lg @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk', $produk->nama_produk) }}">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label fw-semibold">Kategori Kerajinan</label>
                    <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi Lengkap</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5"
                              class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Harga & Inventaris</h5>

                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga Jual (Rp)</label>
                    <input type="number" name="harga" id="harga"
                           class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga', $produk->harga) }}">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="stok" class="form-label fw-semibold">Stok Tersedia (Unit)</label>
                    <input type="number" name="stok" id="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok', $produk->stok) }}">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Foto Produk</h5>

                <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center overflow-hidden mb-3" style="height: 200px;">
                    @if ($produk->gambar)
                        <img id="previewGambar" src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-100 h-100" style="object-fit: cover;">
                    @else
                        <img id="previewGambar" src="#" alt="Preview Foto" class="w-100 h-100 d-none" style="object-fit: cover;">
                        <div id="placeholderPreview" class="text-center text-muted p-3">
                            <i class="bi bi-image fs-1"></i>
                            <div class="small mt-1">Belum ada foto</div>
                        </div>
                    @endif
                </div>

                <label for="gambar" class="form-label small fw-semibold">Ganti Foto (Opsional)</label>
                <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/webp"
                       class="form-control @error('gambar') is-invalid @enderror">
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-vk-primary rounded-pill py-2 fw-semibold">
                        <i class="bi bi-save me-1"></i> Perbarui Produk
                    </button>
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-light rounded-pill py-2">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    document.getElementById('gambar')?.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const preview = document.getElementById('previewGambar');
            const placeholder = document.getElementById('placeholderPreview');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            if (placeholder) placeholder.classList.add('d-none');
        }
    });
</script>
@endpush