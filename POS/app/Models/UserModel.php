<?php

namespace App\Models;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; 
    protected $primaryKey = 'user_id'; 
    protected $fillable = ['username', 'nama', 'password', 'level_id'];

    protected $hidden = ['password'];

    protected $casts = ['password' => 'hashed'];
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
 }