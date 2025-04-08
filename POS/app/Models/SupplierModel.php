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
}
