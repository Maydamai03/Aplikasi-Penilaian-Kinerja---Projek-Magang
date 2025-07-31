<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class KelolaAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->latest()->get();
        return view('superadmin.kelola-admin.index', compact('admins'));
    }

    public function create()
    {
        return view('superadmin.kelola-admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect()->route('kelola-admin.index')->with('success', 'Akun admin berhasil dibuat.');
    }

    public function edit(User $kelola_admin)
    {
        return view('superadmin.kelola-admin.edit', ['admin' => $kelola_admin]);
    }

    public function update(Request $request, User $kelola_admin)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $kelola_admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $kelola_admin->name = $request->name;
        $kelola_admin->email = $request->email;
        if ($request->filled('password')) {
            $kelola_admin->password = Hash::make($request->password);
        }
        $kelola_admin->save();

        return redirect()->route('kelola-admin.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(User $kelola_admin)
    {
        $kelola_admin->delete();
        return redirect()->route('kelola-admin.index')->with('success', 'Akun admin berhasil dihapus.');
    }
}
