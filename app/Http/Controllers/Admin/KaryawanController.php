<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule; // <-- Jangan lupa tambahkan ini di atas


class KaryawanController extends Controller
{
    /**
     * Menampilkan daftar karyawan dengan filter dan search.
     */
    public function index(Request $request)
    {
        $divisi = Divisi::all();
        $query = Karyawan::with('divisi');

        // Filter berdasarkan nama atau NIP
        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan divisi
        if ($request->filled('divisi_id')) {
            $query->where('divisi_id', $request->divisi_id);
        }

        $karyawan = $query->latest()->paginate(10);

        return view('admin.karyawan.index', compact('karyawan', 'divisi'));
    }

    /**
     * Menampilkan form untuk menambah karyawan baru.
     */
    public function create()
    {
        $divisi = Divisi::all();
        return view('admin.karyawan.create', compact('divisi'));
    }

    /**
     * Menyimpan karyawan baru ke database.
     */
   public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|unique:karyawan,email',
        'nomor_telepon' => 'required|string|max:20',
        'nip' => 'required|string|max:50|unique:karyawan,nip',
        'divisi_id' => 'required|exists:divisi,id',
        'tanggal_masuk' => 'required|date', // <-- TAMBAHKAN INI
        'alamat' => 'required|string',
        'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

        $data = $request->all();

        // Handle upload foto profil
        if ($request->hasFile('foto_profil')) {
            $path = $request->file('foto_profil')->store('public/karyawan');
            $data['foto_profil'] = basename($path);
        }

        Karyawan::create($data);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function show(Karyawan $karyawan)
{
    return view('admin.karyawan.show', compact('karyawan'));
}

/**
 * Menampilkan form untuk mengedit data karyawan.
 */
public function edit(Karyawan $karyawan)
{
    $divisi = Divisi::all();
    return view('admin.karyawan.edit', compact('karyawan', 'divisi'));
}

/**
 * Memperbarui data karyawan di database.
 */
public function update(Request $request, Karyawan $karyawan)
{
    // Validasi input
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'email' => 'required|email|unique:karyawan,email,' . $karyawan->id,
        'nomor_telepon' => 'required|string|max:20',
        'nip' => 'required|string|max:50|unique:karyawan,nip,' . $karyawan->id,
        'divisi_id' => 'required|exists:divisi,id',
        'tanggal_masuk' => 'required|date',
        'alamat' => 'required|string',
        'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except('foto_profil');

    // Handle upload foto profil jika ada file baru
    if ($request->hasFile('foto_profil')) {
        // Hapus foto lama jika ada
        if ($karyawan->foto_profil) {
            Storage::delete('public/karyawan/' . $karyawan->foto_profil);
        }
        $path = $request->file('foto_profil')->store('public/karyawan');
        $data['foto_profil'] = basename($path);
    }

    $karyawan->update($data);

    return redirect()->route('karyawan.show', $karyawan->id)->with('success', 'Profil karyawan berhasil diperbarui.');
}

/**
 * Memperbarui status karyawan lgsg dari detail info karyawan.
 */
public function updateStatus(Request $request, Karyawan $karyawan)
{
    // Validasi bahwa status yang dikirim adalah salah satu dari pilihan yang ada
    $request->validate([
        'status_karyawan' => ['required', Rule::in(['Aktif', 'Cuti', 'Resign'])],
    ]);

    // Update statusnya
    $karyawan->status_karyawan = $request->status_karyawan;
    $karyawan->save();

    // Redirect kembali ke halaman detail dengan pesan sukses
    return redirect()->route('karyawan.show', $karyawan->id)->with('success', 'Status karyawan berhasil diperbarui.');
}

    /**
     * Menghapus data karyawan.
     */
    public function destroy(Karyawan $karyawan)
    {
        // Hapus foto profil lama jika ada
        if ($karyawan->foto_profil) {
            Storage::delete('public/karyawan/' . $karyawan->foto_profil);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
