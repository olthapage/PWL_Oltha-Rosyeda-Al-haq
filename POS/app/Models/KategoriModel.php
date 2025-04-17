<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriModel extends Model
{
    use HasFactory;

    protected $table = 'm_kategori'; 
    protected $primaryKey = 'kategori_id'; 
    public $timestamps = true; 

    protected $fillable = [
        'kategori_id',
        'kategori_kode',
        'kategori_nama'
    ];

    public function barang(): HasMany {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
    /**
     * Mendapatkan nama role
     */
    public function getRoleName(): string
    {
        return $this->level->level_nama;
    }

    /**
     * Cek apakah user memiliki role tertentu
     */
    public function hasRole($role): bool
    {
        return $this->level->level_kode == $role;
    }
    /**
     * Mendapatkan kode role
     */
    public function getRole()
    {
        return $this->level->level_kode;
    }
}

