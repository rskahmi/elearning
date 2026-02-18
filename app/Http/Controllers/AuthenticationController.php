<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Events\TestUser;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;


class AuthenticationController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return view('authentication.login');
        }
        return redirect()->route('resume');
    }

    public function registrasi()
    {
        if (!Auth::check()) {
            return view('authentication.registrasi');
        }

        return redirect()->route('resume');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('auth')->with('alert', [
                'type' => 'error',
                'title' => 'Login Gagal',
                'text' => 'Akun tidak ditemukan',
            ]);
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('auth')->with('alert', [
                'type' => 'error',
                'title' => 'Login Gagal',
                'text' => 'Email atau password salah',
            ]);
        }
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'mahasiswa') {
            return redirect()->route('course.index')->with('alert', [
                'type' => 'success',
                'title' => 'Login Berhasil',
                'text' => 'Selamat datang Mahasiswa',
            ]);
        }
        else if ($user->role === 'dosen') {
            return redirect()->route('course.index')->with('alert', [
                'type' => 'success',
                'title' => 'Login Berhasil',
                'text' => 'Selamat Datang Dosen',
            ]);
        }

        // return redirect('/dashboard')->with('alert', [
        //     'type' => 'success',
        //     'title' => 'Login Berhasil',
        //     'text' => 'Selamat datang',
        // ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('auth')->with('alert', [
            'type' => 'success',
            'title' => 'Logout',
            'text' => 'Logout berhasil dilakukan'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "role" => $request->role,
            ]);
            if($user) {
                event(new TestUser($user));
                $this->forgetUser();

                return redirect()->route('auth')
                ->with(
                        'alert',
                        [
                            'type' => 'success',
                            'title' => 'Insert Pengguna',
                            'text' => 'Anda Berhasil Daftar!'
                        ]
                    );
            }
        } catch (Exception $e) {
            return redirect()->route('auth')
                ->with(
                    'alert',
                    [
                        'type' => 'error',
                        'title' => 'Insert Pengguna',
                        'text' => $e -> getMessage()
                    ]
                );
        }
    }
}
