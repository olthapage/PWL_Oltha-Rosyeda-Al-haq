<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenjualanDetailModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'detail_id';
    public $timestamps = true;

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'harga',
        'jumlah',
        'total',
    ];

    // Relasi ke model Penjualan (jika ada)
    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'penjualan_id');
    }

    // Relasi ke model Barang (jika ada)
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
}
