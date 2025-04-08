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
}
