<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function loginPetugas(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::guard('web')->user();

            switch ($user->role) {

                case 'admin':
                    return redirect()->route('admin.dashboard');

                case 'rt':
                    return redirect()->route('rt.dashboard');

                case 'rw':
                    return redirect()->route('rw.dashboard');

                case 'lurah':
                    return redirect()->route('lurah.dashboard');

                default:
                    Auth::guard('web')->logout();

                    return back()->with('warning', 'Role tidak dikenali.');
            }
        }

        return back()->with('warning', 'Email atau Password salah.');
    }

    public function loginWarga(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('warga')->attempt($credentials)) {

            $request->session()->regenerate();
            // dd($credentials);
            

            return redirect()->route('warga.dashboard');
        }

        return back()->with('warning', 'Email atau Password salah.');
    }

     public function logout() {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();

            return redirect('/');
        }
    }

    public function logoutWarga(){
        if (Auth::guard('warga')->check()) {
            Auth::guard('warga')->logout();

            return redirect('/sekip');
        }
    }
}
