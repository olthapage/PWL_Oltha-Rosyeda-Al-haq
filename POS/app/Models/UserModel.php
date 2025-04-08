<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 
 class UserModel extends Model
 {
    use HasFactory;
 
    protected $table = 'm_user'; // mendifinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id'; // mendefinisikan primary key dari tabel yang digunakan

    // implementasi POS jobsheet 4
    protected $fillable = ['username', 'nama', 'password', 'level_id'];
 }