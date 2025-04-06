<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user(),
            'activeMenu' => 'profile',
            'breadcrumb' => (object)[
                'title' => 'Profil Pengguna',
                'list' => ['Home', 'Profil']
            ]
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
    
        $user = Auth::user();

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }
    
        $fotoPath = $request->file('foto')->store('foto_profil', 'public');
    
        DB::table('m_user')
            ->where('user_id', $user->user_id)
            ->update(['foto' => $fotoPath]);
    
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }    
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
            'activeMenu' => 'profile',
            'breadcrumb' => 'Profil',
            'breadcrumb' => (object)[
                'title' => 'Profil',
                'list' => ['Home', 'Profil']
            ]
        ]);
    }
}
