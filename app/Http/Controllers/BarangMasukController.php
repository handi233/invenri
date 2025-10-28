<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {
        $masuk = DB::table('brngmasuk')->get();
        $instansi = DB::table('settings')->where('id', 1)->first();
        $logoinstansi = $instansi ? $instansi->background : null;

        $barangs = DB::table('stokbrng')->get();
        return view('barangmasuk', compact('masuk', 'logoinstansi', 'barangs'));
    }

    // aksi menghapus data barang dari home
    public function del($id_masuk)
    {
        DB::table('brngmasuk')->where('id_masuk', $id_masuk)->delete();
        return redirect()->route('barangmasuk')->with('sukses', 'Data barang berhasil dihapus.');
    }

    // aksi input barang dari form
    public function baranginput(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'id_brng_masuk' => 'required|integer',
                'tgl' => 'required|date',
                'ket' => 'required|string',
                'qty' => 'required|numeric|min:1',
            ]);


            // Insert data ke tabel brngmasuk
            DB::table('brngmasuk')->insert([
                'id_brng_masuk' => $request->input('id_brng_masuk'),
                'tgl' => $request->input('tgl'),
                'nm_brng' => $request->input('nm_brng'),
                'ket' => $request->input('ket'),
                'qty' => $request->input('qty'),
            ]);
            //    Update / insert ke stokbrng
            $existing = DB::table('stokbrng')->where('id_brng', $request->id_brng_masuk)->first();
            if ($existing) {
                DB::table('stokbrng')
                    ->where('id_brng', $request->id_brng_masuk)
                    ->increment('stock', $request->qty);
            } else {
                DB::table('stokbrng')->insert([
                    'id_stock_brng' => $request->id_brng_masuk,
                    'nm_brng' => $request->nm_brng,
                    'deskripsi' => $request->ket,
                    'stock' => $request->qty,
                ]);
            }


            return redirect()->route('barangmasuk')->with('sukses', 'Data barang berhasil ditambahkan dan stok diupdate.');
        }

        return redirect()->back()->with('error', 'Metode tidak valid.');
    }
}
