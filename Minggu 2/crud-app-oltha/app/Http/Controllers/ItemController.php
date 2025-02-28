<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = stock::all(); //mengambil semua data stock yang ada di database
        return view('stocks.index', compact('stocks')); // mengembalikan data ke tampilan 'stocks.index'
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stocks.create'); // menampilkan halaman form untuk menambahkan stock baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memvalidasikan inputan agar 'name' dan 'description' tidak kosong
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        // menyimpan data yang baru ke dalam database (hanya 'name' dan 'description')
        stock::create($request->only(['name', 'description']));

        // redirect ke halaman daftar stok dengan pesan sukses (
        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return view('stocks.show', compact('stock')); // menampilkan halaman dengan detail dari stok yang dipilih
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        return view('stocks.edit', compact('stock')); // menampilkan halaman edit dengan data stok yang dipilih
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        // memvalidasikan inputan agar 'name' dan 'description' tidak kosong
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        // memperbarui data stok berdasarkan inputan pengguna
        $stock->update($request->only(['name', 'description']));

        // redirect ke halaman daftar stok dengan pesan sukses
        return redirect()->route('stocks.index')->with('success', 'Stocl updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete(); // menghapus data stok dari database

        // redirect ke halaman daftar stok dengan pesan suskse
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
        
    }
}
