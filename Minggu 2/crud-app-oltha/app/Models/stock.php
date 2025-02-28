<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    // Untuk menentukan atribut yang bisa diisi dengan banyak
    protected $fillable = ['name', 'description'];
}
