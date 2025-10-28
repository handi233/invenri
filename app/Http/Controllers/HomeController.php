<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class HomeController extends Controller{

//melihat data database
public function index(){
    $stock = DB::table('stokbrng')->get(); 
    
        $instansi = DB::table('settings')->where('id', 1)->first();
        $logoinstansi = $instansi ? $instansi->background : null;
        return view('home', compact('stock', 'logoinstansi'));
}



}