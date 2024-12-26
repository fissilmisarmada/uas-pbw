<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Rental; // Import Model Rental
use Illuminate\Support\Str; // Import Str


class RentalController extends Controller
{
    // Menampilkan form pengajuan rental
    public function showRequestForm()
    {
        // Mengambil data kendaraan yang tersedia untuk ditampilkan di form
        $vehicles = Vehicle::where('is_available', true)->get();

        // Mengembalikan view dengan data kendaraan
        return view('rental.request', compact('vehicles'));
    }

    // Menghandle pengajuan rental
    public function submit(Request $request)
    {
        // Validasi data input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'vehicle_id' => 'required|exists:vehicles,id',
            'rental_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:rental_date',
        ]);

        // Mencari atau membuat user berdasarkan email
        $user = User::where('email', $validated['email'])->first();
        if (!$user) {
            // Jika user tidak ditemukan, buat user baru
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt(str::random(10)), // Sandi default
            ]);
        }

        // Ambil kendaraan yang dipilih
        $vehicle = Vehicle::find($validated['vehicle_id']);

        // Cek jika kendaraan tersedia
        if (!$vehicle->is_available) {
            return redirect()->back()->with('error', 'Kendaraan tidak tersedia.');
        }

        // Tandai kendaraan sebagai sedang dirental
        $vehicle->update(['is_available' => false]);

        // Hitung total harga (misalnya berdasarkan harga per hari)
        $rental_date = \Carbon\Carbon::parse($validated['rental_date']);
        $return_date = \Carbon\Carbon::parse($validated['return_date'] ?? $validated['rental_date']);
        $days_rented = $rental_date->diffInDays($return_date);
        $total_price = $vehicle->price_per_day * $days_rented;

        // Simpan pengajuan rental ke dalam tabel rentals
        $rental = Rental::create([
            'user_id' => $user->id,
            'vehicle_id' => $vehicle->id,
            'rental_date' => $validated['rental_date'],
            'return_date' => $validated['return_date'],
            'total_price' => $total_price,
            'status' => 'ongoing', // Status default
        ]);

        // Kembalikan respon sukses setelah pengajuan berhasil
        return redirect()->route('home')->with('success', 'Pengajuan rental berhasil!');
    }
}
