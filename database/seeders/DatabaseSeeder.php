<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $semuaFile = Storage::disk('public')->files('produk');
        $daftarFoto = array_values(array_filter($semuaFile, function ($file) {
            return preg_match('/\.(jpg|jpeg|png|webp)$/i', $file);
        }));

        $anyaman = Kategori::create([
            'nama_kategori' => 'Anyaman & Bambu',
            'deskripsi'     => 'Kerajinan tangan berbahan serat alam seperti pandan, rotan, dan bambu pilihan.',
        ]);

        $tekstil = Kategori::create([
            'nama_kategori' => 'Tenun & Batik',
            'deskripsi'     => 'Kain tradisional buatan tangan pengrajin lokal dengan pewarna alami.',
        ]);

        $gerabah = Kategori::create([
            'nama_kategori' => 'Gerabah & Kulit',
            'deskripsi'     => 'Produk kriya tanah liat bakar dan kerajinan kulit sapi asli.',
        ]);

        $produks = [
            [
                'kategori_id' => $anyaman->id,
                'nama_produk' => 'Tas Anyaman Pandan Etnik',
                'harga'       => 145000,
                'stok'        => 15,
                'deskripsi'   => 'Tas jinjing anyaman daun pandan kering dengan lapisan kain furing katun dan pegangan kayu mahoni yang kuat.',
                'gambar'      => $this->cariFoto($daftarFoto, ['tas', 'pandan']),
            ],
            [
                'kategori_id' => $anyaman->id,
                'nama_produk' => 'Lampu Hias Gantung Bambu',
                'harga'       => 185000,
                'stok'        => 8,
                'deskripsi'   => 'Kap lampu gantung berbahan bambu apus yang dianyam presisi, memberikan nuansa hangat untuk ruang tamu maupun kafe.',
                'gambar'      => $this->cariFoto($daftarFoto, ['lampu', 'bambu']),
            ],
            [
                'kategori_id' => $tekstil->id,
                'nama_produk' => 'Kain Tenun Ikat Troso',
                'harga'       => 275000,
                'stok'        => 12,
                'deskripsi'   => 'Kain tenun ikat tradisional ukuran 240x120 cm yang ditenun menggunakan alat tenun bukan mesin (ATBM).',
                'gambar'      => $this->cariFoto($daftarFoto, ['tenun', 'troso', 'kain']),
            ],
            [
                'kategori_id' => $tekstil->id,
                'nama_produk' => 'Selendang Batik Tulis Pewarna Alam',
                'harga'       => 210000,
                'stok'        => 10,
                'deskripsi'   => 'Selendang katun primisima dengan motif flora Nusantara menggunakan pewarna alami dari ekstrak daun indigo dan kulit kayu.',
                'gambar'      => $this->cariFoto($daftarFoto, ['batik', 'selendang']),
            ],
            [
                'kategori_id' => $gerabah->id,
                'nama_produk' => 'Set Teko & Cangkir Gerabah Kasongan',
                'harga'       => 165000,
                'stok'        => 9,
                'deskripsi'   => 'Satu set teko dan 4 cangkir tanah liat bakar halus yang menjaga suhu minuman tetap hangat lebih lama.',
                'gambar'      => $this->cariFoto($daftarFoto, ['gerabah', 'teko', 'cangkir', 'kasongan']),
            ],
            [
                'kategori_id' => $gerabah->id,
                'nama_produk' => 'Dompet Kulit Sapi Jahit Tangan',
                'harga'       => 195000,
                'stok'        => 20,
                'deskripsi'   => 'Dompet lipat pria berbahan kulit sapi pull-up asli dengan teknik jahitan tangan (hand-stitched) yang tahan lama.',
                'gambar'      => $this->cariFoto($daftarFoto, ['dompet', 'kulit']),
            ],
        ];

        foreach ($produks as $item) {
            Produk::create($item);
        }
    }

    private function cariFoto(array $daftarFoto, array $kataKunci): ?string
    {
        foreach ($daftarFoto as $file) {
            $namaFile = strtolower(basename($file));
            foreach ($kataKunci as $keyword) {
                if (str_contains($namaFile, $keyword)) {
                    return $file;
                }
            }
        }

        return null;
    }
}