<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    // Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Menampilkan halaman register
    public function register()
    {
        return view('auth/register');
    }

    // Proses Register
    public function prosesRegister()
    {
        $password = $this->request->getPost('password');
        $confirm  = $this->request->getPost('confirm_password');

        if ($password !== $confirm) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak sesuai.');
        }

        $cek = $this->user
            ->where('username', $this->request->getPost('username'))
            ->orWhere('email', $this->request->getPost('email'))
            ->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Username atau Email sudah digunakan.');
        }

        $this->user->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/login')
                         ->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Proses Login
    public function prosesLogin()
{
    $user = $this->user
        ->where('username', $this->request->getPost('username'))
        ->first();

    if (!$user) {
        return redirect()->to('/login')
            ->with('error', 'Username tidak ditemukan.');
    }

    if (!password_verify($this->request->getPost('password'), $user['password'])) {
        return redirect()->to('/login')
            ->with('error', 'Password salah.');
    }

    session()->set([
        'id'       => $user['id'],
        'username' => $user['username'],
        'login'    => true,
    ]);

    return redirect()->to('/admin/dashboard');
}

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}