<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;


class UsersController extends Controller{
 //aksi ambil data db users
    public function index (){
        $users = DB::table('users')->get(); 
        $instansi = DB::table('settings')->where('id', 1)->first();
        $logoinstansi = $instansi ? $instansi->background : null;
        return view('users', compact('users', 'logoinstansi'));
    }

   //aksi menghapus data barang from home
   public function del($id){
    $user = DB::table('users')->where('id', $id)->first();
    // Cek apakah usernya ada dan username-nya 'admin'
    if ($user && $user->username === 'admin') {
        return redirect()->route('users')->with('error', 'Username "admin" tidak dapat dihapus.');
    }

    DB::table('users')->where('id', $id)->delete();
    return redirect()->route('users')->with('success', 'Data Users berhasil dihapus.');
} 

     // Simpan data ke database
    public function input(Request $request)
    {
        $request->validate([
            'fullnama' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        DB::table('users')->insert([
            'fullnama' => $request->fullnama,
            'username' => $request->username,
            'password' =>  md5($request->password),
            'role' => null,
        ]);

        return redirect()->route('users')->with('sukses', 'User berhasil ditambahkan.');
    }
    
}

