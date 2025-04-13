<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LevelModel extends Model
{

    use HasFactory;
    protected $table = 'm_level';
    protected $primaryKey = 'level_id';
    public $timestamps = false; 
    
    protected $fillable = ['level_kode', 'level_nama'];

    public function user(): BelongsTo {
        return $this->belongsTo(UserModel::class);
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
