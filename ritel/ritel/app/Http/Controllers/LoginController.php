<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class LoginController extends Controller
{
  public function LoginForm()
    {
        // Ambil data instansi dari tabel settings
        $setting = DB::table('settings')->first();

        return view('login', [
            'nama_instansi' => $setting->nama_instansi ?? 'Instansi Default',
            'alamat_instansi' => $setting->alamat_instansi ?? '',
            'background' => $setting->background ?? '',
        ]);
    }
    
    //aksi login 
       public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

          $user = User::where('username', $request->username)->first();
          if ($user && md5($request->password, $user->password)) {
            // Simpan sesi manual 
            Auth::login($user);
            session([
                'last_activity' => time()
            ]);

           return redirect('/home');
        }

        return back()->withErrors(['error' => 'Username atau password kamu salah !!'])->withInput();
    }
   public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login')->with('logout', true);
    }
}
