<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    // Display a list of all admins (optional)
    public function index()
    {
        $admins = Admin::all();
        return Inertia::render('Admin/Index', ['admins' => $admins]);
    }

    // Show the form for creating a new admin (optional)
    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    // Store a new admin in the database (optional)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admins.index')->with('message', 'Admin created successfully.');
    }

    // Show the form for editing the specified admin (optional)
    public function edit(Admin $admin)
    {
        return Inertia::render('Admin/Edit', ['admin' => $admin]);
    }

    // Update the specified admin in the database (optional)
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admins.index')->with('message', 'Admin updated successfully.');
    }

    // Delete the specified admin (optional)
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('message', 'Admin deleted successfully.');
    }

    // Display all reservations made by users
    public function showReservations()
    {
        // Mengambil semua reservasi yang sudah meng-upload bukti pembayaran dan status_reservasi 'pending'
        $reservasis = Reservasi::whereNotNull('bukti_pembayaran')
                                ->where('status_reservasi', 'pending')
                                ->with('user') // Mengambil data terkait dengan user yang terkait
                                ->get(); 
    
        // Mengirim data ke tampilan DashboardView
        return Inertia::render('DashboardView', ['reservasis' => $reservasis]);
    }
    
    

    // Delete a specific reservation (Action for admin)
    public function deleteReservation($id)
    {
        $reservation = Reservasi::findOrFail($id);
        $reservation->delete();
        return redirect()->route('admin.dashboard')->with('message', 'Reservation deleted successfully.');
    }

    // Show the form for editing a specific reservation (Action for admin)
    public function editReservation($id)
    {
        $reservation = Reservasi::findOrFail($id);
        return Inertia::render('EditReservasiView', ['reservation' => $reservation]);
    }
    
    // Update a specific reservation (Action for admin)
    public function updateReservation(Request $request, $id)
    {
        $reservation = Reservasi::findOrFail($id);
    
        // Validate only the fields that can be updated
        $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'nik_ketua' => 'required|string|max:20'
        ]);
    
        // Update only the specified fields
        $reservation->update([
            'nama_ketua' => $request->nama_ketua,
            'nik_ketua' => $request->nik_ketua
        ]);
    
        return redirect()->route('admin.dashboard')->with('message', 'Reservation updated successfully.');
    }
    
    // Show the details of a specific reservation (Action for admin)
    public function showReservationDetail($id)
    {
        $reservasi = Reservasi::with('user')->findOrFail($id); // Ambil data reservasi berdasarkan ID
        return Inertia::render('Dashboard/DetailKelompokView', [
            'reservasi' => $reservasi // Mengirim data reservasi, termasuk path bukti pembayaran
        ]);
    }
    

    // Fungsi untuk mendapatkan jumlah pendaki pada hari ini
    public function getPendakiHariIni()
    {
        // Menghitung jumlah pendaki pada hari ini
        $jumlahPendakiHariIni = Reservasi::whereDate('tanggal_reservasi', today())->count();
        return Inertia::render('KuotaView', [
            'jumlahPendakiHariIni' => $jumlahPendakiHariIni
        ]);
    }

    // Fungsi untuk mendapatkan kuota berdasarkan tanggal tertentu
    public function getKuotaByDate($date)
    {
        // Ambil seluruh data reservasi yang sesuai dengan tanggal yang dipilih
        $reservasis = Reservasi::whereDate('tanggal_reservasi', $date)->get();

        // Mengambil jumlah seluruh pendaki (termasuk ketua dan anggota)
        $kuota = 0;
        foreach ($reservasis as $reservasi) {
            // Jumlahkan ketua dan anggota
            $kuota += 1; // Ketua Kelompok
            $anggota = json_decode($reservasi->anggota, true);
            $kuota += count($anggota); // Anggota Kelompok
        }

        return response()->json(['kuota' => $kuota]);
    }

    // Fungsi untuk mendapatkan jumlah pendaki per tanggal yang dipilih
    public function getPendakiPerTanggal($tanggal)
    {
        // Ambil seluruh data reservasi yang sesuai dengan tanggal yang dipilih
        $reservasis = Reservasi::whereDate('tanggal_reservasi', $tanggal)->get();
    
        // Mengambil jumlah seluruh pendaki (termasuk ketua dan anggota)
        $pendaki = 0;
        $allMembers = [];  // Menyimpan semua anggota
        foreach ($reservasis as $reservasi) {
            // Tambahkan ketua
            $pendaki += 1;
            $allMembers[] = $reservasi->nama_ketua;
    
            // Ambil anggota yang ada dan tambahkan ke total pendaki
            $anggota = json_decode($reservasi->anggota, true);
            foreach ($anggota as $member) {
                $pendaki += 1;
                $allMembers[] = $member['nama'];
            }
        }
    
        return response()->json(['pendaki' => $pendaki, 'members' => $allMembers]);
    }
     
    
    public function konfirmasiReservasi($id)
    {
        try {
            // Mencari reservasi berdasarkan ID
            $reservasi = Reservasi::findOrFail($id);
    
            // Update status_reservasi menjadi 'confirmed'
            $reservasi->status_reservasi = 'confirmed';
            $reservasi->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Reservasi berhasil dikonfirmasi!',
                'data' => $reservasi
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saat mengonfirmasi reservasi: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengonfirmasi reservasi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function showConfirmedReservations()
    {
        $reservasis = Reservasi::where('status_reservasi', 'confirmed')->get(); // Filter berdasarkan status_reservasi
    
        return Inertia::render('TerkonfirmasiView', [
            'reservasis' => $reservasis,
        ]);
    }
    
    //mendapatkan informasi users
    public function getUser(Request $request)
    {
        return response()->json(Auth::user());
    }
    
    public function getJumlahPendaki($id)
    {
        // Ambil data reservasi berdasarkan ID
        $reservasi = Reservasi::findOrFail($id);
    
        // Menghitung jumlah pendaki (1 untuk ketua + jumlah anggota dalam json)
        $jumlahPendaki = 1; // Ketua kelompok (selalu ada)
        $anggota = json_decode($reservasi->anggota, true);
        $jumlahPendaki += count($anggota); // Menambahkan jumlah anggota
    
        return response()->json(['jumlah_pendaki' => $jumlahPendaki]);
    }
    









    public function listUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

// app/Http/Controllers/AdminController.php
public function blockUser($id)
{
    try {
        \Log::info("Attempting to block user with ID: $id");

        $user = User::findOrFail($id);

        \Log::info("User found: ", $user->toArray());

        $user->status = 'blokir'; // Ubah nilai menjadi 'blokir' sesuai ENUM di database
        $user->save();

        \Log::info("User blocked successfully.");

        return response()->json(['message' => 'User blocked successfully.'], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        \Log::error("User not found with ID: $id");
        return response()->json(['message' => 'User not found.'], 404);
    } catch (\Exception $e) {
        \Log::error("Error blocking user: " . $e->getMessage());
        return response()->json(['message' => 'An error occurred while blocking the user.'], 500);
    }
}

public function unblockUser($id)
{
    try {
        \Log::info("Attempting to unblock user with ID: $id");

        $user = User::findOrFail($id);

        \Log::info("User found: ", $user->toArray());

        $user->status = 'aktif'; // Ubah status kembali ke 'aktif'
        $user->save();

        \Log::info("User unblocked successfully.");

        return response()->json(['message' => 'User unblocked successfully.'], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        \Log::error("User not found with ID: $id");
        return response()->json(['message' => 'User not found.'], 404);
    } catch (\Exception $e) {
        \Log::error("Error unblocking user: " . $e->getMessage());
        return response()->json(['message' => 'An error occurred while unblocking the user.'], 500);
    }
}



    
}