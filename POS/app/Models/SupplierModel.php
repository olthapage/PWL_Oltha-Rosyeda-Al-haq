<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierModel extends Model
{
    use HasFactory;

    protected $table = 'm_supplier'; // Nama tabel
    protected $primaryKey = 'supplier_id'; // Primary key
    public $timestamps = false;

    protected $fillable = ['supplier_id','supplier_kode', 'supplier_nama', 'supplier_alamat'];

    public function stok(): HasMany
    {
        return $this->hasMany(StokModel::class, 'supplier_id', 'supplier_id');
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
