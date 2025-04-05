<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        $level = LevelModel::all(); 
        return view('auth.register', compact('level'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'level_id' => 'required',
            'username' => 'required|unique:users,username',
            'nama' => 'required',
            'password' => 'required|min:6'
        ]);

        // Simpan user baru
        UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password)
        ]);
        
        return response()->json([
            'status' => true,
            'message' => 'User berhasil didaftarkan!',
            'redirect' => route('login') // Kalau mau redirect via JS
        ], 201);
    }
}
