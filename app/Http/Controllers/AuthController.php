<?php

namespace App\Http\Controllers;

use App\Models\UserSiproan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function login_proses(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'Siwas') {
                return redirect()->route('dashboard-siwas');
            } elseif ($user->role === 'Denzibang') {
                return redirect()->route('dashboard-denzibang');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Role tidak valid');
            }
        }

        return redirect()->route('login')->with('error', 'Login gagal');
    }

    public function register()
    {
        return view('register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:user_siproans,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $data['nama_lengkap'] = $request->nama_lengkap;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['role'] = $request->role;

        UserSiproan::create($data);

        return redirect()->route('login');
    }
}
