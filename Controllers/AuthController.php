<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function tampilRegistrasi() 
    {
        return view('session.registrasi');
    }

    // Menyimpan data registrasi
    public function submitRegistrasi(Request $request) 
    {
        $user = new User();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect()->route('login.index')->with('success', 'Registrasi berhasil, silahkan login.');
    }

    // Menampilkan form login
    public function tampilLogin() {
        return view('session.login');
    }

    // Memproses login
    public function submitLogin(Request $request) {
        $data = $request->only('email', 'password');

        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Login berhasil.');
        } else {
            return redirect()->back()->with('error', 'Email atau password anda salah.');
        }
    }

    // Keluar dari sesi login
    public function logout() {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
