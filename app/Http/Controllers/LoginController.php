<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            "title" => "Login"
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => ["required", "email:dns"],
            "password" => ["required"]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put("email", $request->email);
            return redirect()->intended("/dashboard")->with('messageSuccess', 'Login Berhasil');
        } else {
            $request->session()->flash("messageError", "Email atau password salah!");
            return back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
