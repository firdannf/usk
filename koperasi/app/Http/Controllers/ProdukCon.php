<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProdukCon extends Controller
{
    public function home()
    {
        $produk = DB::table('barang')->get();
        return view('utama', ['barang' => $produk]);
    }

    public function index()
    {
        $produk = DB::table('barang')->get();
        return view('produk', ['barang' => $produk]);
    }

    public function input()
    {
        return view('tambahproduk');
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbproduk
        $file = $request->file('gambar');
        $filename = $request->kode . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        DB::table('barang')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $filename
        ]);
        // alihkan halaman ke route produk
        Session::flash('message', 'Input Berhasil.');
        return redirect('/produk/tampil');
    }

    public function update($id)
    {
        // mengambil data produk berdasarkan id yang dipilih
        $produk = DB::table('barang')->where('kode', $id)->get();
        // passing data produk yang didapat ke view edit.blade.php
        return redirect('/produk/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data produk

        DB::table('barang')->where('kode', $request->kode)->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
           
        ]);

        // alihkan halaman ke halaman produk
        return redirect('/produk/tampil');
    }

    public function delete($id)
    {
        // mengambil data produk berdasarkan id yang dipilih
        DB::table('barang')->where('kode', $id)->delete();
        // passing data produk yang didapat ke view edit.blade.php
        return redirect('/produk/tampil');
    }
}
