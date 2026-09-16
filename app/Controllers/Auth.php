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
        // Jika sudah login, arahkan berdasarkan role
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


        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

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
        |
        | Login dapat menggunakan:
        | - Username
        | - Email
        |
        */

        $user = $this->user
            ->groupStart()
                ->where('username', $username)
                ->orWhere('email', $username)
            ->groupEnd()
            ->first();


        /*
        |--------------------------------------------------------------------------
        | USER TIDAK DITEMUKAN
        |--------------------------------------------------------------------------
        */

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
        | CEK STATUS AKUN
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
        |
        | Password disimpan sebagai password asli di database.
        | Oleh karena itu tidak menggunakan password_verify().
        |
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
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        |
        | Mencegah session fixation setelah login berhasil.
        |
        */

        session()->regenerate(true);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SESSION
        |--------------------------------------------------------------------------
        */

        session()->set([
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email'],
            'role'     => $user['role'],
            'login'    => true,
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT BERDASARKAN ROLE
        |--------------------------------------------------------------------------
        */

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
        /*
        |--------------------------------------------------------------------------
        | SUPERADMIN
        |--------------------------------------------------------------------------
        */

        if ($role === 'superadmin') {

            return redirect()
                ->to('/admin/dashboard');
        }


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($role === 'admin') {

            return redirect()
                ->to('/admin/dashboard');
        }


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        if ($role === 'user') {

            return redirect()
                ->to('/admin/korsda/kegiatan');
        }


        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK VALID
        |--------------------------------------------------------------------------
        */

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