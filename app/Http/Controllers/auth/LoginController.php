<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('auth.login');
    }

    public function cek_login(Request $request)
    {
        //validasi inputan dari fore
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        //mengecek apakah data sudah benar atau belum
        //jika data sudah di validasi dan benar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //cek level hak akses
            $level = Auth::user()->role_id;
            //cek level hak akses
            //level 1 = admin
            if ($level == 1) {
                return redirect()->intended('/admin/home');
            }
            //cek level hak akses
            //level 2 = petugas
            elseif ($level == 2) {
                return redirect()->intended('/petugas/home');
            }
            return "anda berhasil";
        } else { //jika data salah
            Session::flash('status', 'failed');
            Session::flash('massage', 'username atau password salah');
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
