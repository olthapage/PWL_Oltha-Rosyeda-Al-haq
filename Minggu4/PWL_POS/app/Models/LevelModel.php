<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LevelModel extends Model
{

    use HasFactory;
    protected $table = 'm_level';
    protected $primaryKey = 'user_id';

    public function user(): BelongsTo {
        return $this->belongsTo(UserModel::class);
    }
}
