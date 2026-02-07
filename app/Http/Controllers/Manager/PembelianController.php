<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPembelian;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelians = TransaksiPembelian::with(['produk', 'user'])
            ->latest('tanggal')
            ->paginate(15);

        return view('manager.pembelian.index', compact('pembelians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::all();
        return view('manager.pembelian.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'nama_supplier' => 'required|string|max:100',
            'kontak_supplier' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Simpan transaksi pembelian
            $pembelian = TransaksiPembelian::create([
                'produk_id' => $validated['produk_id'],
                'user_id' => auth()->id(),
                'nama_supplier' => $validated['nama_supplier'],
                'kontak_supplier' => $validated['kontak_supplier'],
                'jumlah' => $validated['jumlah'],
                'harga_beli' => $validated['harga_beli'],
                'tanggal' => $validated['tanggal'],
            ]);

            // Update stok produk (tambah)
            $produk = Produk::find($validated['produk_id']);
            $produk->increment('stok', $validated['jumlah']);

            DB::commit();

            return redirect()->route('manager.pembelian.index')
                ->with('success', 'Transaksi pembelian berhasil disimpan dan stok sudah bertambah!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan transaksi pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiPembelian $pembelian)
    {
        $pembelian->load(['produk', 'user']);
        return view('manager.pembelian.show', compact('pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiPembelian $pembelian)
    {
        $produks = Produk::all();
        return view('manager.pembelian.edit', compact('pembelian', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiPembelian $pembelian)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'nama_supplier' => 'required|string|max:100',
            'kontak_supplier' => 'required|string|max:50',
            'jumlah' => 'required|integer|min:1',
            'harga_beli' => 'required|integer|min:0',
            'tanggal' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Kembalikan stok lama
            $produkLama = Produk::find($pembelian->produk_id);
            $produkLama->decrement('stok', $pembelian->jumlah);

            // Update transaksi pembelian
            $pembelian->update($validated);

            // Tambah stok baru
            $produkBaru = Produk::find($validated['produk_id']);
            $produkBaru->increment('stok', $validated['jumlah']);

            DB::commit();

            return redirect()->route('manager.pembelian.index')
                ->with('success', 'Transaksi pembelian berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate transaksi pembelian: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiPembelian $pembelian)
    {
        DB::beginTransaction();
        try {
            // Kurangi stok produk
            $produk = Produk::find($pembelian->produk_id);

            // Cek apakah stok mencukupi untuk dikurangi
            if ($produk->stok < $pembelian->jumlah) {
                return redirect()->route('manager.pembelian.index')
                    ->with('error', 'Tidak bisa hapus transaksi, stok produk tidak mencukupi!');
            }

            $produk->decrement('stok', $pembelian->jumlah);

            // Hapus transaksi
            $pembelian->delete();

            DB::commit();

            return redirect()->route('manager.pembelian.index')
                ->with('success', 'Transaksi pembelian berhasil dihapus dan stok sudah dikurangi!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('manager.pembelian.index')
                ->with('error', 'Gagal menghapus transaksi pembelian: ' . $e->getMessage());
        }
    }
}
