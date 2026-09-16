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

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        if (session()->get('login') === true) {
            return $this->redirectByRole(
                session()->get('role')
            );
        }

        return view('auth/login');
    }

    /**
     * Proses login
     */
    public function prosesLogin()
    {
        $username = trim(
            (string) $this->request->getPost('username')
        );

        $password = (string) $this->request->getPost('password');

        // Validasi input
        if ($username === '' || $password === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username dan password wajib diisi.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CARI USER
        |--------------------------------------------------------------------------
        */

        $user = $this->user
            ->where('username', $username)
            ->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username atau password salah.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK AKUN AKTIF
        |--------------------------------------------------------------------------
        */

        if ((int) $user['active'] !== 1) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Akun Anda tidak aktif. Silakan hubungi administrator.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK PASSWORD
        |--------------------------------------------------------------------------
        | Password menggunakan plaintext
        |--------------------------------------------------------------------------
        */

        if ($password !== $user['password']) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Username atau password salah.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | CEK ROLE
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $user['role'],
            ['superadmin', 'admin', 'user'],
            true
        )) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Role akun tidak valid.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LOGIN BERHASIL
        |--------------------------------------------------------------------------
        */

        session()->regenerate(true);

        session()->set([
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email'],
            'role'     => $user['role'],
            'active'   => $user['active'],
            'login'    => true,
        ]);

        return $this->redirectByRole(
            $user['role']
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT BERDASARKAN ROLE
    |--------------------------------------------------------------------------
    */

    private function redirectByRole($role)
    {
        if ($role === 'superadmin') {
            return redirect()
                ->to('/admin/dashboard');
        }

        if ($role === 'admin') {
            return redirect()
                ->to('/admin/dashboard');
        }

        if ($role === 'user') {
            return redirect()
                ->to('/admin/korsda/kegiatan');
        }

        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'error',
                'Role akun tidak valid.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session()->destroy();

        return redirect()
            ->to('/login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}