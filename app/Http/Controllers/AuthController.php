<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function showDaftar()
    {
        return view('daftar');
    }
    public function daftar(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/login');
    }
    public function login(Request $request)
{
    $data = [
        'email' => $request->email,
        'password' => $request->password
    ];

    if (Auth::attempt($data)) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    return back()->with('error', 'Email atau password salah');
}
    public function dashboard(Request $request)
{
    $search = $request->search;

    $users = User::where('id', '!=', auth()->id())
        ->where('name', 'like', "%$search%")
        ->get();

    return view('dashboard', compact('users'));
}
}
