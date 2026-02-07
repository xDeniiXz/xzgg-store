<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortField = in_array($request->get('sort_field'), ['name', 'email', 'role', 'created_at'])
            ? $request->get('sort_field')
            : 'name';
        $sortDir = $request->get('sort_dir') === 'desc' ? 'desc' : 'asc';
        $q = $request->get('q');

        $query = User::query();
        if ($q) {
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('role', 'like', "%{$q}%");
            });
        }
        $users = $query->orderBy($sortField, $sortDir)->paginate(10)->appends($request->query());

        return view('manager.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:super_admin,admin,operator'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('manager.users.index')
            ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('manager.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('manager.users.index')
                ->with('error', 'Tidak dapat mengedit akun sendiri!');
        }
        return view('manager.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('manager.users.index')
                ->with('error', 'Tidak dapat mengedit akun sendiri!');
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:super_admin,admin,operator'],
        ]);

        $user->update($validated);

        // Update password jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('manager.users.index')
            ->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Tidak bisa hapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('manager.users.index')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('manager.users.index')
            ->with('success', 'User berhasil dihapus!');
    }
}
