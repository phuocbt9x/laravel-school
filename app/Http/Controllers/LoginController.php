<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $check = Auth::attempt($request->only('email', 'password'), $request->remember);
        if ($check) {
            return redirect()->route('homepage');
        }
        return redirect()->route('login.index')
            ->withErrors(['error' => 'Tài khoản mật khẩu không chính xác']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
