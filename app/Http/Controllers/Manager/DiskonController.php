<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diskons = Diskon::latest()->paginate(10);
        return view('manager.diskon.index', compact('diskons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.diskon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_diskon' => 'required|string|max:100',
            'jenis_diskon' => 'required|in:persen,nominal',
            'nilai' => 'required|integer|min:0',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Diskon::create($validated);

        return redirect()->route('manager.diskon.index')
            ->with('success', 'Diskon berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diskon $diskon)
    {
        return view('manager.diskon.show', compact('diskon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diskon $diskon)
    {
        return view('manager.diskon.edit', compact('diskon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diskon $diskon)
    {
        $validated = $request->validate([
            'nama_diskon' => 'required|string|max:100',
            'jenis_diskon' => 'required|in:persen,nominal',
            'nilai' => 'required|integer|min:0',
            'kuota' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $diskon->update($validated);

        return redirect()->route('manager.diskon.index')
            ->with('success', 'Diskon berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diskon $diskon)
    {
        $diskon->delete();

        return redirect()->route('manager.diskon.index')
            ->with('success', 'Diskon berhasil dihapus!');
    }
}
