<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials=$request->validate([
                        'email' => 'required|email:dns',
                        'password' => 'required',
                    ],
                    [
                        'email.required' => 'Email harus diisi',
                        'email.email' => 'Format email tidak valid',
                        'password.required' => 'Password harus diisi',
                    ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //---------set role default----------
            $role = UserRole::where('user_id', Auth::user()->id)->limit(1)->first();
            if($role){//-----jika role ditemukan
                session()->put('current_role', $role->role->kode);
            }else{
                return back()->with('error', 'Role tidak ditemukan');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout successful');
    }

    public function dashboard()
    {
        $current_role = session('current_role');
        return view('dashboard');
    }

    public function anggota()
    {
        echo "ini halaman anggota";
    }

    public function admin()
    {
        echo "ini halaman admin";
    }
}
