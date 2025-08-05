<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Divisi;
use App\Models\Jabatan; // 1. Tambahkan model Jabatan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    /**
     * Menampilkan daftar karyawan dengan filter dan search.
     */
    public function index(Request $request)
    {
        $divisi = Divisi::all();
        // 2. Tambahkan relasi 'jabatan' untuk efisiensi query
        $query = Karyawan::with(['divisi', 'jabatan']);

        if ($request->filled('search')) {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%');
        }

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
        $jabatan = Jabatan::all(); // 3. Ambil data jabatan
        return view('admin.karyawan.create', compact('divisi', 'jabatan')); // 4. Kirim data jabatan ke view
    }

    /**
     * Menyimpan karyawan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email',
            'nomor_telepon' => 'required|string|max:20',
            'nip' => 'required|string|max:50|unique:karyawan,nip',
            'divisi_id' => 'required|exists:divisi,id',
            'jabatan_id' => 'required|exists:jabatan,id', // 5. Tambahkan validasi untuk jabatan
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

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
        $jabatan = Jabatan::all(); // 6. Ambil data jabatan untuk form edit
        return view('admin.karyawan.edit', compact('karyawan', 'divisi', 'jabatan')); // 7. Kirim data jabatan ke view edit
    }

    /**
     * Memperbarui data karyawan di database.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawan,email,' . $karyawan->id,
            'nomor_telepon' => 'required|string|max:20',
            'nip' => 'required|string|max:50|unique:karyawan,nip,' . $karyawan->id,
            'divisi_id' => 'required|exists:divisi,id',
            'jabatan_id' => 'required|exists:jabatan,id', // 8. Tambahkan validasi jabatan untuk update
            'tanggal_masuk' => 'required|date',
            'alamat' => 'required|string',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('foto_profil');

        if ($request->hasFile('foto_profil')) {
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
     * Memperbarui status karyawan.
     */
    public function updateStatus(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'status_karyawan' => ['required', Rule::in(['Aktif', 'Cuti', 'Resign'])],
        ]);

        $karyawan->status_karyawan = $request->status_karyawan;
        $karyawan->save();

        return redirect()->route('karyawan.show', $karyawan->id)->with('success', 'Status karyawan berhasil diperbarui.');
    }

    /**
     * Menghapus data karyawan.
     */
    public function destroy(Karyawan $karyawan)
    {
        if ($karyawan->foto_profil) {
            Storage::delete('public/karyawan/' . $karyawan->foto_profil);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
