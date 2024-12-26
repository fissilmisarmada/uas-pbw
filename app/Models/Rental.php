<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'vehicle_id', 'rental_date', 'return_date', 'total_price', 'status'
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Memeriksa apakah rental sudah selesai
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Menghitung total harga rental berdasarkan durasi
    public function calculateTotalPrice()
    {
        $vehicle = $this->vehicle;  // Ambil kendaraan yang disewa
        $rentalDuration = $this->rental_date->diffInDays($this->return_date); // Durasi dalam hari
        $totalPrice = $vehicle->price_per_day * $rentalDuration; // Total harga = harga per hari * durasi
        return $totalPrice;
    }

    // Mengupdate status rental
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    // Memeriksa apakah kendaraan tersedia untuk rental
    public static function isVehicleAvailable($vehicleId, $rentalDate, $returnDate)
    {
        // Cek apakah kendaraan sudah terdaftar untuk rental dalam rentang waktu yang sama
        return !self::where('vehicle_id', $vehicleId)
                    ->where(function ($query) use ($rentalDate, $returnDate) {
                        $query->whereBetween('rental_date', [$rentalDate, $returnDate])
                              ->orWhereBetween('return_date', [$rentalDate, $returnDate]);
                    })
                    ->exists();
    }

    // Memperbarui total harga berdasarkan kendaraan yang dipilih dan durasi sewa
    public function updateTotalPrice()
    {
        $this->total_price = $this->calculateTotalPrice();
        $this->save();
    }
}
