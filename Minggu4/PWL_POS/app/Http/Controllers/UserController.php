<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function index() {

        // praktikum 1
        /*$data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'Manager 3',
            'password' => Hash::make('12345')
        ];
        UserModel::insert($data);
        
        $user = UserModel::all(); 
        return view('user', ['data' => $user]);*/

        // praktikum 2.1
        /*$user = UserModel::firstWhere('level_id', 1);
        return view('user', ['data' => $user]);

        $user = UserModel::findOr(1, ['username', 'nama'], function () {
            abort(404);
        });
        return view('user', ['data' => $user]);*/

        /*$user = UserModel::findOr(20, ['username', 'nama'], function () {
            abort(404);
        });
        return view('user', ['data' => $user]);*/

        // praktikum 2.2
        /*$user = UserModel::findOrFail(1);
        return view('user', ['data' => $user]);

        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user', ['data' => $user]);*/

        // praktikum 2.3
        /*$user = UserModel::where('level_id', 2)->count();
        dd($user);
        return view('user', ['data' => $user]);

        $user = UserModel::where('level_id', 2)->count();
        return view('user', ['data' => $user]);*/

        // praktikum 2.4
        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2

            ],
        );
        $user->save();
        return view('user', ['data' => $user]);





        



    }
}