<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showLogin() {
        return view('pages.login');
    }

    public function showRegister() {
        return view('pages.register');
    }

    public function register(Request $request){
        $validate = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $validate['password'] = Hash::make($validate['password']);

        User::create($validate);

        return redirect()->route('view.login');
    }

    public function login(Request $request) {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(auth()->attempt($validate)) {
            $request = session()->regenerate();
            return redirect()->route('main');
        }

        return back()->withErrors(['email' => 'Неверные данные']);
    }

    public function logout() {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('main');
    }
}
