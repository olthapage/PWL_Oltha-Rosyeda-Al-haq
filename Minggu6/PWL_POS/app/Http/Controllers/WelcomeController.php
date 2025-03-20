<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller // controller WelcomeController memiliki method hello() dan mengembalikan teks "Hello World" ketika di panggil melalui route
{
    public function hello() {
        return 'Hello World';
       }

    public function greeting(){
        return view('blog.hello', ['name' => 'Oltha'])
        ->with('name','Oltha')
        ->with('occupation','Student');
        }
       
       
}


