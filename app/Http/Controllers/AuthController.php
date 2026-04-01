<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // ============================================================
    // LOGIN & REGISTER USER (PELANGGAN)
    // ============================================================
    public function showLoginUser() {
        if (Session::has('pelanggan_id') && Session::get('role') === 'user') {
            return redirect()->route('user.beranda');
        }
        return view('auth.login-user');
    }

    public function loginUser(Request $request) {
        $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        
        $user = DB::table('pelanggan')
            ->where('email', $request->email)
            ->where('role', 'user')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['Email atau kata sandi salah.'])->withInput();
        }

        Session::put('pelanggan_id',   $user->PelangganID);
        Session::put('nama_pelanggan', $user->NamaPelanggan);
        Session::put('role',           'user');

        return redirect()->route('user.beranda')->with('success', 'Selamat datang!');
    }

    // ============================================================
    // LOGIN ADMIN (MENGGUNAKAN TABEL PELANGGAN)
    // ============================================================
    public function showLoginAdmin() {
        // Jika sudah login sebagai admin, langsung lempar ke dashboard
        if (Session::has('admin_id') && Session::get('role') === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login-admin'); 
    }

    public function loginAdmin(Request $request) {
        $request->validate([
            'email'    => 'required|email', // Admin pakai email karena di tabel pelanggan
            'password' => 'required'
        ]);

        // Cari di tabel pelanggan yang role-nya 'admin'
        $admin = DB::table('pelanggan')
                    ->where('email', $request->email)
                    ->where('role', 'admin')
                    ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Set session Admin
            Session::put('admin_id',     $admin->PelangganID);
            Session::put('nama_petugas',  $admin->NamaPelanggan);
            Session::put('role',          'admin');

            return redirect()->route('admin.dashboard')->with('success', 'Halo Admin!');
        }

        return back()->withErrors(['error' => 'Email atau Password Admin salah!'])->withInput();
    }

    // ============================================================
    // LOGOUT (OTOMATIS DETEKSI ROLE)
    // ============================================================
    public function logout() {
        $role = Session::get('role');
        Session::flush();
        
        if ($role === 'admin') {
            return redirect()->route('admin.login');
        }
        return redirect()->route('/');
    }

    // ============================================================
    // PROFIL USER
    // ============================================================
    public function profil() {
        $pelangganId = Session::get('pelanggan_id');
        if (!$pelangganId) return redirect()->route('user.login');

        $pelanggan = DB::table('pelanggan')->where('PelangganID', $pelangganId)->first();
        return view('admin.user.profil', compact('pelanggan'));
    }

    public function updateProfil(Request $request) {
        $pelangganId = Session::get('pelanggan_id');
        $request->validate([
            'NamaPelanggan' => 'required|string|max:255',
            'NomorTelepon'  => 'required|string|max:15',
            'Alamat'        => 'nullable|string',
        ]);

        DB::table('pelanggan')->where('PelangganID', $pelangganId)->update([
            'NamaPelanggan' => $request->NamaPelanggan,
            'NomorTelepon'  => $request->NomorTelepon,
            'Alamat'        => $request->Alamat,
            'updated_at'    => now(),
        ]);

        Session::put('nama_pelanggan', $request->NamaPelanggan);
        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}