<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class PembelianCon extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'Guest') {
            $pembelian = DB::table('transaksi')->get();
            return view('pembelian', ['transaksi' => $pembelian]);
        } else {
            $pembelian = DB::table('transaksi')->where('kode_pembelian', Auth::user()->id)->get();
            return view('pembelian', ['transaksi' => $pembelian]);
        }
    }

    public function input()
    {
        return view('tambahpembelian');
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbpembelian
        DB::table('transaksi')->insert([
           
            'kode_produk' =>$request->kode_produk,
            'banyak' => $request->banyak,
            'bayar' => $request->harga * $request->banyak,
            'kode_pembeli' => Auth()->user()->id,
            'status' => 'verifikasi'
        ]);
        // alihkan halaman ke route pembelian
        Session::flash('message', 'Input Berhasil.');
        return redirect('/pembelian/tampil');
    }

    public function update($id)
    {
        // mengambil data pembelian berdasarkan id yang dipilih
        $pembelian = DB::table('transaksi')->where('kode_pembelian', $id)->get();
        // passing data pembelian yang didapat ke view edit.blade.php
        return redirect('/pembelian/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data pembelian

        DB::table('transaksi')->where('kode_pembelian', $request->kode_pembelian)->update([
            'status' => $request->status
        ]);

        // alihkan halaman ke halaman pembelian
        return redirect('/pembelian/tampil');
    }

    public function delete($id)
    {
        // mengambil data pembelian berdasarkan id yang dipilih
        DB::table('transaksi')->where('kode_pembelian', $id)->delete();
        // passing data pembelian yang didapat ke view edit.blade.php
        return redirect('/pembelian/tampil');
    }
}