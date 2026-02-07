<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPenjualan;
use App\Models\TransaksiPembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter berdasarkan tanggal
        $tanggal_dari = $request->input('tanggal_dari', now()->startOfMonth()->format('Y-m-d'));
        $tanggal_sampai = $request->input('tanggal_sampai', now()->format('Y-m-d'));
        $jenis_transaksi = $request->input('jenis_transaksi', 'penjualan');

        if ($jenis_transaksi === 'penjualan') {
            // Laporan Penjualan
            $transaksis = TransaksiPenjualan::with(['produk', 'user', 'diskon'])
                ->whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->orderBy('tanggal', 'desc')
                ->paginate(20);

            // Summary
            $total_transaksi = TransaksiPenjualan::whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->where('status', 'selesai')
                ->count();

            $total_penjualan = TransaksiPenjualan::whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->where('status', 'selesai')
                ->sum('total');

            $total_diskon = TransaksiPenjualan::whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->where('status', 'selesai')
                ->whereNotNull('diskon_id')
                ->get()
                ->sum(function ($transaksi) {
                    if ($transaksi->jenis_diskon === 'persen') {
                        return ($transaksi->harga_satuan * $transaksi->jumlah * $transaksi->nilai_diskon) / 100;
                    }
                    return $transaksi->nilai_diskon;
                });

            $summary = [
                'total_transaksi' => $total_transaksi,
                'total_penjualan' => $total_penjualan,
                'total_diskon' => $total_diskon,
                'total_kotor' => $total_penjualan + $total_diskon,
            ];
        } else {
            // Laporan Pembelian
            $transaksis = TransaksiPembelian::with(['produk', 'user'])
                ->whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->orderBy('tanggal', 'desc')
                ->paginate(20);

            // Summary
            $total_transaksi = TransaksiPembelian::whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->count();

            $total_pembelian = TransaksiPembelian::whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->get()
                ->sum(function ($transaksi) {
                    return $transaksi->harga_beli * $transaksi->jumlah;
                });

            $total_item = TransaksiPembelian::whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->sum('jumlah');

            $summary = [
                'total_transaksi' => $total_transaksi,
                'total_pembelian' => $total_pembelian,
                'total_item' => $total_item,
            ];
        }

        return view('manager.laporan.index', compact(
            'transaksis',
            'summary',
            'tanggal_dari',
            'tanggal_sampai',
            'jenis_transaksi'
        ));
    }

    /**
     * Export laporan to Excel/CSV
     */
    public function export(Request $request)
    {
        $tanggal_dari = $request->input('tanggal_dari', now()->startOfMonth()->format('Y-m-d'));
        $tanggal_sampai = $request->input('tanggal_sampai', now()->format('Y-m-d'));
        $jenis_transaksi = $request->input('jenis_transaksi', 'penjualan');

        $filename = "laporan_{$jenis_transaksi}_{$tanggal_dari}_sampai_{$tanggal_sampai}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        if ($jenis_transaksi === 'penjualan') {
            $transaksis = TransaksiPenjualan::with(['produk', 'user', 'diskon'])
                ->whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->orderBy('tanggal', 'desc')
                ->get();

            $callback = function () use ($transaksis) {
                $file = fopen('php://output', 'w');

                // Header CSV
                fputcsv($file, [
                    'ID Transaksi',
                    'Tanggal',
                    'Produk',
                    'Jumlah',
                    'Harga Satuan',
                    'Subtotal',
                    'Diskon',
                    'Total',
                    'Kasir',
                    'Status'
                ]);

                // Data
                foreach ($transaksis as $transaksi) {
                    $subtotal = $transaksi->harga_satuan * $transaksi->jumlah;
                    $diskon = $subtotal - $transaksi->total;

                    fputcsv($file, [
                        $transaksi->transaksi_id,
                        $transaksi->tanggal,
                        $transaksi->produk->nama_produk,
                        $transaksi->jumlah,
                        $transaksi->harga_satuan,
                        $subtotal,
                        $diskon,
                        $transaksi->total,
                        $transaksi->user->name,
                        $transaksi->status,
                    ]);
                }

                fclose($file);
            };
        } else {
            $transaksis = TransaksiPembelian::with(['produk', 'user'])
                ->whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->orderBy('tanggal', 'desc')
                ->get();

            $callback = function () use ($transaksis) {
                $file = fopen('php://output', 'w');

                // Header CSV
                fputcsv($file, [
                    'ID Pembelian',
                    'Tanggal',
                    'Produk',
                    'Supplier',
                    'Kontak Supplier',
                    'Jumlah',
                    'Harga Beli',
                    'Total',
                    'User',
                ]);

                // Data
                foreach ($transaksis as $transaksi) {
                    fputcsv($file, [
                        $transaksi->pembelian_id,
                        $transaksi->tanggal,
                        $transaksi->produk->nama_produk,
                        $transaksi->nama_supplier,
                        $transaksi->kontak_supplier,
                        $transaksi->jumlah,
                        $transaksi->harga_beli,
                        $transaksi->harga_beli * $transaksi->jumlah,
                        $transaksi->user->name,
                    ]);
                }

                fclose($file);
            };
        }

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Print laporan
     */
    public function print(Request $request)
    {
        $tanggal_dari = $request->input('tanggal_dari', now()->startOfMonth()->format('Y-m-d'));
        $tanggal_sampai = $request->input('tanggal_sampai', now()->format('Y-m-d'));
        $jenis_transaksi = $request->input('jenis_transaksi', 'penjualan');

        if ($jenis_transaksi === 'penjualan') {
            $transaksis = TransaksiPenjualan::with(['produk', 'user', 'diskon'])
                ->whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->where('status', 'selesai')
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_transaksi = $transaksis->count();
            $total_penjualan = $transaksis->sum('total');

            $summary = [
                'total_transaksi' => $total_transaksi,
                'total_penjualan' => $total_penjualan,
            ];
        } else {
            $transaksis = TransaksiPembelian::with(['produk', 'user'])
                ->whereBetween('tanggal', [$tanggal_dari, $tanggal_sampai])
                ->orderBy('tanggal', 'desc')
                ->get();

            $total_transaksi = $transaksis->count();
            $total_pembelian = $transaksis->sum(function ($t) {
                return $t->harga_beli * $t->jumlah;
            });

            $summary = [
                'total_transaksi' => $total_transaksi,
                'total_pembelian' => $total_pembelian,
            ];
        }

        return view('manager.laporan.print', compact(
            'transaksis',
            'summary',
            'tanggal_dari',
            'tanggal_sampai',
            'jenis_transaksi'
        ));
    }
}
