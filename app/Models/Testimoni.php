<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id');
    }


    protected $table = 'testimonis'; // Sesuaikan dengan nama tabel Anda jika berbeda

    protected $fillable = [
        'nama_mobil',
        'merk',
        'model',
        'tahun',
        'foto',
        'harga',
        'detail',
        'no_hp',
        'status',
    ];

    // Jika Anda ingin menonaktifkan timestamps (created_at dan updated_at)
    public $timestamps = false;

}
