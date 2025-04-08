<?php
 
 namespace App\Http\Controllers;
 
 use Illuminate\Http\Request;
 use App\Models\UserModel;
 use Illuminate\Support\Facades\Hash;
 
 class UserController extends Controller {
    public function index() {
    // implementasi POS jobsheet 3
        // tambah data user dengan Eloquent Model
        //  $data = [
        //     //  'username' => 'customer-1',
        //     //  'nama' => 'Pelanggan',
        //     //  'password' => Hash::make('12345'),
        //     //  'level_id' => 4
        //     'nama' => 'Pelanggan Pertama',
        //  ];
        // //  UserModel::insert($data); // tambahkan data ke tabel m_user
        // UserModel::where('username', 'customer-1')->update($data); // update data user

        //  //coba akses model UserModel
        //  $user = UserModel::all(); // ambil semua data dari tabel m_user
        //  return view('user', ['data' => $user]);

    // implementasi POS jobsheet 4
        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager2',
        //     'nama' => 'Barack Manager 2',
        //     'password' => Hash::make('manager2')
        // ];
        // UserModel::insert($data);

        
        // $user = UserModel::where('level_id', 1)->first(); 
        // $user = UserModel::findOr(1, ['username', 'nama'], function() {
        //     abort(404);
        // }); 
        $user = UserModel::firstOrCreate(
            [
                'username' => 'admin3',
                'nama' => 'Rayhan Admin 3',
                'password' => Hash::make('admin3'),
                'level_id' => 1
            ],
        );
        // $user->save();
        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);
         $user->username = 'admin4';
         
        //  $user->isDirty(); //true
        //  $user->isDirty('username'); //true
        //  $user->isDirty('nama'); //false
        //  $user->isDirty(['nama', 'username']); //true
 
        //  $user->isClean(); //false
        //  $user->isClean('username'); //false
        //  $user->isClean('nama'); // true
        //  $user->isClean(['nama', 'username']); //false
 
         $user->save();

         $user->wasChanged(); // true
         $user->wasChanged('username'); // true
         $user->wasChanged(['username', 'level_id']); // true
         $user->wasChanged('nama'); // false
         dd($user->wasChanged(['nama', 'username']));
    }
 }
