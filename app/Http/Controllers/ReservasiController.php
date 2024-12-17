<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ReservasiController extends Controller
{
    // Retrieve all reservations
    public function index()
    {
        $reservasis = Reservasi::where('user_id', auth()->id())->get();
        return response()->json($reservasis, 200);
    }

    // Show details of a specific reservation
    public function show($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->anggota = json_decode($reservasi->anggota, true); // Decode anggota ke dalam array
        return response()->json($reservasi, 200);
    }

    // Store a new reservation
    public function store(Request $request)
    {
        $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'nik_ketua' => 'required|string|max:20',
            'telepon_ketua' => 'required|string|max:15',
            'alamat_ketua' => 'required|string',
            'tanggal_reservasi' => 'required|date', // Validate that the date is required
            'anggota' => 'required|array|max:4',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.nik' => 'required|string|max:20',
            'ktp_ketua' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ktpPath = $request->file('ktp_ketua')->store('ktp_images', 'public');

        Reservasi::create([
            'user_id' => auth()->id(),
            'nama_ketua' => $request->nama_ketua,
            'nik_ketua' => $request->nik_ketua,
            'telepon_ketua' => $request->telepon_ketua,
            'alamat_ketua' => $request->alamat_ketua,
            'tanggal_reservasi' => $request->tanggal_reservasi, // Store the reservation date
            'anggota' => json_encode($request->anggota), // Store anggota as JSON
            'ktp_ketua_path' => $ktpPath,
        ]);

        return response()->json(['message' => 'Reservasi berhasil disimpan'], 200);
    }

    // Delete a reservation
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Delete the KTP image from storage
        Storage::disk('public')->delete($reservasi->ktp_ketua_path);

        // Delete the reservation record
        $reservasi->delete();

        return response()->json(['message' => 'Reservasi berhasil dihapus'], 200);
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        try {
            // Ambil ID reservasi secara otomatis berdasarkan user login
            $reservasi = Reservasi::where('user_id', auth()->id())->latest()->first();
    
            if (!$reservasi) {
                return response()->json([
                    'message' => 'Reservasi tidak ditemukan untuk pengguna ini.',
                ], 404);
            }
    
            // Validasi file
            $request->validate([
                'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);
    
            // Simpan file
            $file = $request->file('bukti_pembayaran');
            $path = $file->store('bukti_pembayaran', 'public');
    
            // Update reservasi dengan bukti pembayaran
            $reservasi->bukti_pembayaran = $path;
            $reservasi->save();
    
            return response()->json([
                'message' => 'Bukti pembayaran berhasil diunggah!',
                'path' => $path,
            ], 200);
    
        } catch (\Exception $e) {
            \Log::error('Error saat mengunggah bukti pembayaran: ' . $e->getMessage());
    
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengunggah bukti pembayaran.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }       
}