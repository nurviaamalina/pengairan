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
    $username = $this->request->getPost('username');
    $email    = $this->request->getPost('email');
    $password = $this->request->getPost('password');
    $role     = $this->request->getPost('role');


    // =========================
    // VALIDASI ROLE
    // =========================
    if (!in_array($role, ['admin', 'user'])) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Silakan pilih role Admin atau User.');
    }


    // =========================
    // CEK USERNAME
    // =========================
    $cekUsername = $this->user
        ->where('username', $username)
        ->first();

    if ($cekUsername) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Username sudah digunakan.');
    }


    // =========================
    // CEK EMAIL
    // =========================
    $cekEmail = $this->user
        ->where('email', $email)
        ->first();

    if ($cekEmail) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Email sudah digunakan.');
    }


    // =========================
    // BATASI MAKSIMAL 5 ADMIN
    // =========================
    if ($role === 'admin') {

        $jumlahAdmin = $this->user
            ->where('role', 'admin')
            ->countAllResults();

        if ($jumlahAdmin >= 5) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Jumlah akun Admin sudah mencapai batas maksimal 5 akun.'
                );
        }
    }


    // =========================
    // SIMPAN USER
    // =========================
    $this->user->insert([
        'username' => $username,
        'email'    => $email,
        'password' => password_hash(
            $password,
            PASSWORD_DEFAULT
        ),
        'role'     => $role,
    ]);


    return redirect()->to('/login')
        ->with(
            'success',
            'Registrasi berhasil. Silakan login.'
        );
}

    // Proses Login
   public function prosesLogin()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Cari user berdasarkan username
    $user = $this->user
        ->where('username', $username)
        ->first();

    // Jika username tidak ditemukan
    if (!$user) {
        return redirect()->to('/login')
            ->with('error', 'Username tidak ditemukan.');
    }

    // Jika password salah
    if (!password_verify($password, $user['password'])) {
        return redirect()->to('/login')
            ->with('error', 'Password salah.');
    }

    // Deteksi role dari database
    $role = $user['role'];

    // Simpan data login ke session
    session()->set([
        'id'       => $user['id'],
        'username' => $user['username'],
        'role'     => $role,
        'login'    => true,
    ]);

    // Jika ADMIN
    if ($role === 'admin') {
        return redirect()->to('/admin/dashboard');
    }

    // Jika USER
    if ($role === 'user') {
        return redirect()->to('/admin/korsda/kegiatan');
    }

    // Jika role tidak valid
    session()->destroy();

    return redirect()->to('/login')
        ->with('error', 'Role tidak valid.');
}

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}