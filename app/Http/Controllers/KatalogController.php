<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::withCount('produks')->get();

        $query = Produk::with('kategori')->latest();

        if ($request->filled('kategori')) {
            $query->where('kategori_id',$request->kategori);
        }

        if ($request->filled('cari')) {
            $kataKunci =$request->cari;
            $query->where(function ($q) use ($kataKunci) {
                $q->where('nama_produk', 'like', "\%{$kataKunci}%")
                  ->orWhere('deskripsi', 'like', "%{$kataKunci}%");
            });
        }

        $produks =$query->get();

        return view('public.index', compact('produks', 'kategoris'));
    }

    public function show(Produk $produk)
    {
        $produk->load('kategori');

        $produkTerkait = Produk::with('kategori')
            ->where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->latest()
            ->take(3)
            ->get();

        return view('public.show', compact('produk', 'produkTerkait'));
    }
}