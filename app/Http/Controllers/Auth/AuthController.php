<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Auth\User;
use App\Models\Karyawan\Karyawan;
use App\Models\Master\Bagian;
use App\Models\Master\Bank;

class AuthController extends Controller
{
    // Auth Index
    public function index()
    {
    	$title = 'Login';

    	return view('auth.auth', compact('title'));
    }

    // Register Karyawan
    public function register()
    {
        $title = 'Registrasi Karyawan';

        $bagian = Bagian::orderBy('nama_bagian')->get();

        $banks = Bank::orderBy('nama_bank')->get();

        return view('auth.register', compact('title', 'bagian', 'banks'));
    }

    // Edit Password
    public function editPassword()
    {
        $title = 'Update Password';

        return view('auth.editPassword', compact('title'));
    }

    // Update Password
    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {
        $user->update(['password' => bcrypt($request->password)]);

        return back()->with('success', 'Password berhasil diupdate.');
    }

    // Login Handler
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

    	$user = Karyawan::where('nik', $request->username)->first();

        $admin = User::where('username', $request->username)
                    ->where('role', 'Admin')
                    ->first();

        if ($admin && Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('dasbor.index');
        }

        if ($user && $user->status == 1 && Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('dasbor.index');
        }

        if (!$user || $user->status != 1) {
            return back()->with('error', 'Anda tidak memiliki akses atau belum terdaftar.');
        }

        return back()->with('error', 'Username atau password salah.');
    }

    // Logout Handler
    public function logout()
    {
    	Auth::logout();

    	return redirect('/');
    }
}
