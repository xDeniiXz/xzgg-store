<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPenjualan;
use App\Models\Produk;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = in_array($request->get('sort_field'), ['tanggal', 'total', 'jumlah', 'harga_satuan', 'status', 'created_at'])
            ? $request->get('sort_field')
            : 'tanggal';
        $sortDir = $request->get('sort_dir') === 'desc' ? 'desc' : 'asc';
        $q = $request->get('q');

        $query = TransaksiPenjualan::with(['produk', 'user', 'diskon']);
        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('status', 'like', "%{$q}%");
            })->orWhereHas('produk', function ($p) use ($q) {
                $p->where('nama_produk', 'like', "%{$q}%");
            })->orWhereHas('user', function ($u) use ($q) {
                $u->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $penjualans = $query->orderBy($sortField, $sortDir)->paginate(15)->appends($request->query());

        return view('manager.penjualan.index', compact('penjualans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::where('stok', '>', 0)->get();
        $diskons = Diskon::where('status', 'aktif')->get();

        return view('manager.penjualan.create', compact('produks', 'diskons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,produk_id',
            'jumlah' => 'required|integer|min:1',
            'diskon_id' => 'nullable|exists:diskon,diskon_id',
            'tanggal' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Ambil data produk
            $produk = Produk::findOrFail($validated['produk_id']);

            // Cek stok
            if ($produk->stok < $validated['jumlah']) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $produk->stok);
            }

            // Hitung subtotal
            $harga_satuan = $produk->harga;
            $subtotal = $harga_satuan * $validated['jumlah'];

            // Inisialisasi diskon
            $nilai_diskon = 0;
            $jenis_diskon = null;
            $diskon_nominal = 0;

            // Jika ada diskon
            if ($request->filled('diskon_id')) {
                $diskon = Diskon::find($validated['diskon_id']);

                // Cek kuota diskon
                if ($diskon->kuota !== null && $diskon->kuota <= 0) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Kuota diskon sudah habis!');
                }

                $jenis_diskon = $diskon->jenis_diskon;
                $nilai_diskon = $diskon->nilai;

                // Hitung diskon
                if ($diskon->jenis_diskon === 'persen') {
                    $diskon_nominal = ($subtotal * $diskon->nilai) / 100;
                } else { // nominal
                    $diskon_nominal = $diskon->nilai;
                }

                // Kurangi kuota diskon jika ada
                if ($diskon->kuota !== null) {
                    $diskon->decrement('kuota', 1);
                }
            }

            // Hitung total
            $total = $subtotal - $diskon_nominal;

            // Simpan transaksi penjualan
            TransaksiPenjualan::create([
                'produk_id' => $validated['produk_id'],
                'user_id' => auth()->id(),
                'diskon_id' => $validated['diskon_id'],
                'jumlah' => $validated['jumlah'],
                'harga_satuan' => $harga_satuan,
                'jenis_diskon' => $jenis_diskon,
                'nilai_diskon' => $nilai_diskon,
                'total' => $total,
                'tanggal' => $validated['tanggal'],
                'status' => 'selesai',
            ]);

            // Kurangi stok produk
            $produk->decrement('stok', $validated['jumlah']);

            DB::commit();

            return redirect()->route('manager.penjualan.index')
                ->with('success', 'Transaksi penjualan berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan transaksi penjualan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiPenjualan $penjualan)
    {
        $penjualan->load(['produk', 'user', 'diskon']);
        return view('manager.penjualan.show', compact('penjualan'));
    }

    /**
     * Cancel transaction (ubah status jadi dibatalkan)
     */
    public function cancel(TransaksiPenjualan $penjualan)
    {
        if ($penjualan->status === 'dibatalkan') {
            return redirect()->back()
                ->with('error', 'Transaksi sudah dibatalkan sebelumnya!');
        }

        DB::beginTransaction();
        try {
            // Kembalikan stok produk
            $produk = Produk::find($penjualan->produk_id);
            $produk->increment('stok', $penjualan->jumlah);

            // Kembalikan kuota diskon jika ada
            if ($penjualan->diskon_id) {
                $diskon = Diskon::find($penjualan->diskon_id);
                if ($diskon && $diskon->kuota !== null) {
                    $diskon->increment('kuota', 1);
                }
            }

            // Update status transaksi
            $penjualan->update(['status' => 'dibatalkan']);

            DB::commit();

            return redirect()->route('manager.penjualan.index')
                ->with('success', 'Transaksi berhasil dibatalkan dan stok sudah dikembalikan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Gagal membatalkan transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiPenjualan $penjualan)
    {
        DB::beginTransaction();
        try {
            // Jika status masih selesai, kembalikan stok dulu
            if ($penjualan->status === 'selesai') {
                $produk = Produk::find($penjualan->produk_id);
                $produk->increment('stok', $penjualan->jumlah);

                // Kembalikan kuota diskon jika ada
                if ($penjualan->diskon_id) {
                    $diskon = Diskon::find($penjualan->diskon_id);
                    if ($diskon && $diskon->kuota !== null) {
                        $diskon->increment('kuota', 1);
                    }
                }
            }

            $penjualan->delete();

            DB::commit();

            return redirect()->route('manager.penjualan.index')
                ->with('success', 'Transaksi penjualan berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('manager.penjualan.index')
                ->with('error', 'Gagal menghapus transaksi penjualan: ' . $e->getMessage());
        }
    }
}
