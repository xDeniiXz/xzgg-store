<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::with('kategori')->latest()->paginate(15);
        return view('manager.barang.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('manager.barang.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::create($validated);

        return redirect()->route('manager.barang.index')
            ->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $barang)
    {
        $barang->load('kategori');
        return view('manager.barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $barang)
    {
        $kategoris = Kategori::all();
        return view('manager.barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $barang)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang->update($validated);

        return redirect()->route('manager.barang.index')
            ->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $barang)
    {
        // Cek apakah barang sudah digunakan di transaksi
        if ($barang->transaksiPenjualan()->exists() || $barang->transaksiPembelian()->exists()) {
            return redirect()->route('manager.barang.index')
                ->with('error', 'Barang tidak bisa dihapus karena sudah ada transaksi!');
        }

        $barang->delete();

        return redirect()->route('manager.barang.index')
            ->with('success', 'Barang berhasil dihapus!');
    }
}
