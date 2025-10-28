<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $keluar = DB::table('brngkeluar')->get();
        $instansi = DB::table('settings')->where('id', 1)->first();
        $logoinstansi = $instansi ? $instansi->background : null;

        $barangs = DB::table('stokbrng')->get();
        return view('barangkeluar', compact('keluar', 'logoinstansi', 'barangs'));
    }

    // aksi menghapus data barang dari home
    public function del($id_keluar)
    {
        DB::table('brngkeluar')->where('id_keluar', $id_keluar)->delete();
        return redirect()->route('barangkeluar')->with('sukses', 'Data barang berhasil dihapus.');
    }

    // aksi input barang dari form
    public function baranginput(Request $request){
    if ($request->isMethod('post')) {
        $request->validate([
            'tgl' => 'required|date',
            'id_brng' => 'required|integer|exists:stokbrng,id_brng',
            'qty' => 'required|integer|min:1',
            'penerima' => 'required|string',
        ]);
         
        //Get table stok barang 

        $stokBarang = DB::table('stokbrng')->where('id_brng', $request->input('id_brng'))->first();

        if (!$stokBarang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan di stok.');
        }
          // Cek apakah stok cukup
        if ($stokBarang->stock < $request->input('qty')) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }


        DB::table('brngkeluar')->insert([
            'id_brng_keluar' => $stokBarang->id_brng,
            'tgl' => $request->input('tgl'),
            'nm_brng' => $stokBarang->nm_brng,
            'qty' => $request->input('qty'),
            'penerima' => $request->input('penerima'),
        ]);

         // Kurangi stok
         DB::table('stokbrng')->where('id_brng', $request->id_brng)->update([
        'stock' => $stokBarang->stock - $request->qty
    ]);
        return redirect()->route('barangkeluar')->with('sukses', 'Data barang keluar stok diperbaruhi.');
    }

    return redirect()->back()->with('error', 'Metode tidak valid.');
}
}
