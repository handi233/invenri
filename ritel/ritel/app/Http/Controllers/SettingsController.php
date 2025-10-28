<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
     //aksi ambil data db users
    public function index (){
        $settings = DB::table('settings')->get(); 
        $instansi = DB::table('settings')->where('id', 1)->first();
        $logoinstansi = $instansi ? $instansi->background : null;
        return view('settings', compact('settings', 'logoinstansi'));
    }
   //aksi menghapus data barang from home
   public function del($id){
    DB::table('settings')->where('id', $id)->delete();
    return redirect()->route('settings')->with('sukses', 'Data Users berhasil dihapus.');
} 

     // Simpan data ke database
    public function update(Request $request,$id ){
        $request->validate([
            'nama_instansi' => 'required|string',
            'alamat_instansi' => 'required|string',
            'background' => 'required|string',
        ]);

        DB::table('settings')->where('id',$id)->update([
            'nama_instansi' => $request->nama_instansi,
            'alamat_instansi' => $request->alamat_instansi,
            'background' =>  $request->background,
        ]);

        return redirect()->route('settings')->with('sukses', 'User berhasil ditambahkan.');
    }
    
}

