<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HelpController extends Controller
{
     public function index (){
         
        $instansi = DB::table('settings')->where('id', 1)->first();
        $logoinstansi = $instansi ? $instansi->background : null;
        return view('help', compact('logoinstansi'));;
    
    }
}