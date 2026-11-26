@extends('layouts.app')

@section('title', 'Tambah Produk - Admin VeriaKriya')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.produk.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Produk
    </a>
    <h1 class="h3 fw-bold font-serif-brand mt-1">Tambah Produk UMKM Baru</h1>
</div>

<form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Utama -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Informasi Dasar Produk</h5>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk"
                           class="form-control form-control-lg @error('nama_produk') is-invalid @enderror"
                           value="{{ old('nama_produk') }}" placeholder="Contoh: Tas Anyaman Pandan Etnik">
                    @error('nama_produk')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label fw-semibold">Kategori Kerajinan</label>
                    <select name="kategori_id" id="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
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
                              class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Jelaskan bahan baku, dimensi ukuran, proses pembuatan, dan keunikan produk...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Harga, Stok & Live Preview Foto -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3">Harga & Inventaris</h5>

                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga Jual (Rp)</label>
                    <input type="number" name="harga" id="harga"
                           class="form-control @error('harga') is-invalid @enderror"
                           value="{{ old('harga') }}" placeholder="150000">
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-0">
                    <label for="stok" class="form-label fw-semibold">Stok Tersedia (Unit)</label>
                    <input type="number" name="stok" id="stok"
                           class="form-control @error('stok') is-invalid @enderror"
                           value="{{ old('stok') }}" placeholder="10">
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3">Foto Produk</h5>

                <div class="border rounded-3 bg-light d-flex align-items-center justify-content-center overflow-hidden mb-3" style="height: 200px;">
                    <img id="previewGambar" src="#" alt="Preview Foto" class="w-100 h-100 d-none" style="object-fit: cover;">
                    <div id="placeholderPreview" class="text-center text-muted p-3">
                        <i class="bi bi-cloud-arrow-up fs-1"></i>
                        <div class="small mt-1">Pratinjau foto akan muncul di sini</div>
                    </div>
                </div>

                <input type="file" name="gambar" id="gambar" accept="image/jpeg,image/png,image/webp"
                       class="form-control @error('gambar') is-invalid @enderror">
                <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP (Maks. 2 MB)</small>
                @error('gambar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-vk-primary rounded-pill py-2 fw-semibold">
                        <i class="bi bi-check-lg me-1"></i> Simpan Produk
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
            placeholder.classList.add('d-none');
        }
    });
</script>
@endpush