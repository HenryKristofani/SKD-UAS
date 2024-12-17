<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'user_id',           // Associate reservation with user
        'nama_ketua',
        'nik_ketua',
        'ktp_ketua_path',
        'telepon_ketua',
        'alamat_ketua',
        'tanggal_reservasi',
        'anggota',
        'bukti_pembayaran',
        'status_reservasi'
    ];

    protected $casts = [
        'anggota' => 'array', // Automatically decode JSON to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}