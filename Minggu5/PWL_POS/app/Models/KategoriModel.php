<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori'; // Pastikan ini sesuai
    protected $primaryKey = 'kategori_id'; // Ubah dari 'id' ke 'kategori_id'
    public $timestamps = false; // Jika created_at dan updated_at tidak digunakan

    protected $fillable = [
        'kategori_id',
        'kategori_kode',
        'kategori_nama'
    ];

    public function barang(): HasMany {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
}

