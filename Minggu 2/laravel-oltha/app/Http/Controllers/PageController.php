<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return 'Selamat Datang';
       }

    public function about() {
        return 'Oltha Rosyeda Al haq, 2341720145';
    }

    public function articles($id) {
        return 'Halaman Artikel dengan ID'.$id;
    }
}
