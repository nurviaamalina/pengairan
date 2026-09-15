<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $user;

    public function __construct()
    {
        helper(['cookie', 'form']);

        $this->user = new UserModel();
    }


    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        // Jika sudah login
        if (session()->get('login')) {

            if (session()->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }

            return redirect()->to('/admin/korsda/kegiatan');
        }

        return view('auth/login');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function prosesLogin()
    {
        $username = trim($this->request->getPost('username'));
        $password = $this->request->getPost('password');

        // Validasi input
        if ($username === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username dan password wajib diisi.');
        }

        // Cari user berdasarkan username
        $user = $this->user
            ->where('username', $username)
            ->first();

        if (!$user) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        // Cek password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        // Cek role
        if (!in_array($user['role'], ['admin', 'user'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Role pengguna tidak valid.');
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN BERHASIL
        |--------------------------------------------------------------------------
        */

        session()->regenerate();

        session()->set([
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email'] ?? null,
            'role'     => $user['role'],
            'login'    => true
        ]);


        /*
        |--------------------------------------------------------------------------
        | REMEMBER ME
        |--------------------------------------------------------------------------
        */

        $remember = $this->request->getPost('remember');

        if ($remember) {

            // Buat token random
            $token = bin2hex(random_bytes(32));

            // Simpan hash token ke database
            $this->user->update($user['id'], [
                'remember_token' => hash('sha256', $token)
            ]);

            // Simpan token asli di browser
            set_cookie([
                'name'     => 'remember_token',
                'value'    => $token,
                'expire'   => 60 * 60 * 24 * 30,
                'httponly' => true,
                'secure'   => false,
                'samesite' => 'Lax',
                'path'     => '/'
            ]);

        } else {

            // Hapus cookie
            delete_cookie('remember_token');

            // Hapus token dari database
            $this->user->update($user['id'], [
                'remember_token' => null
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT SESUAI ROLE
        |--------------------------------------------------------------------------
        */

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to('/admin/korsda/kegiatan');
    }


    /*
    |--------------------------------------------------------------------------
    | AUTO LOGIN DARI REMEMBER ME
    |--------------------------------------------------------------------------
    */

    public function autoLogin()
    {
        $token = get_cookie('remember_token');

        if (!$token) {
            return false;
        }

        // Hash token dari cookie
        $tokenHash = hash('sha256', $token);

        // Cari user
        $user = $this->user
            ->where('remember_token', $tokenHash)
            ->first();

        if (!$user) {

            delete_cookie('remember_token');

            return false;
        }

        // Pastikan role valid
        if (!in_array($user['role'], ['admin', 'user'])) {

            delete_cookie('remember_token');

            return false;
        }

        // Regenerasi session
        session()->regenerate();

        session()->set([
            'id'       => $user['id'],
            'username' => $user['username'],
            'email'    => $user['email'] ?? null,
            'role'     => $user['role'],
            'login'    => true
        ]);

        return true;
    }


    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        // Jika sudah login
        if (session()->get('login')) {

            if (session()->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            }

            return redirect()->to('/admin/korsda/kegiatan');
        }

        return view('auth/register');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER
    |--------------------------------------------------------------------------
    */

    public function prosesRegister()
    {
        $username = trim($this->request->getPost('username'));
        $email    = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');


        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        if (!in_array($role, ['admin', 'user'])) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Role tidak valid.');
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI USERNAME
        |--------------------------------------------------------------------------
        */

        if ($username === '') {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Username wajib diisi.');
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI EMAIL
        |--------------------------------------------------------------------------
        */

        if (
            $email === '' ||
            !filter_var($email, FILTER_VALIDATE_EMAIL)
        ) {

            return redirect()->back()
                ->withInput()
                ->with('error', 'Email tidak valid.');
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI PASSWORD
        |--------------------------------------------------------------------------
        */

        if ($password === '' || strlen($password) < 6) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Password minimal 6 karakter.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK USERNAME
        |--------------------------------------------------------------------------
        */

        $existingUsername = $this->user
            ->where('username', $username)
            ->first();

        if ($existingUsername) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username sudah digunakan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK EMAIL
        |--------------------------------------------------------------------------
        */

        $existingEmail = $this->user
            ->where('email', $email)
            ->first();

        if ($existingEmail) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email sudah digunakan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | BATAS ADMIN
        |--------------------------------------------------------------------------
        */

        if ($role === 'admin') {

            $jumlahAdmin = $this->user
                ->where('role', 'admin')
                ->countAllResults();

            if ($jumlahAdmin >= 5) {

                return redirect()->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Jumlah akun admin sudah mencapai batas.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN USER
        |--------------------------------------------------------------------------
        */

        $this->user->insert([
            'username'       => $username,
            'email'          => $email,
            'password'       => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),
            'role'           => $role,
            'remember_token' => null,
            'reset_token'    => null,
            'reset_expires'  => null,
            'otp_code'       => null,
            'otp_expires'    => null
        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()->to('/login')
            ->with(
                'success',
                'Registrasi berhasil. Silakan login.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        $userId = session()->get('id');

        // Hapus remember token dari database
        if ($userId) {

            $this->user->update($userId, [
                'remember_token' => null
            ]);
        }

        // Hapus cookie
        delete_cookie('remember_token');

        // Hapus session
        session()->destroy();

        return redirect()->to('/login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | LUPA PASSWORD
    |--------------------------------------------------------------------------
    */

    public function lupaPassword()
    {
        // Kalau sudah login
        if (session()->get('login')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('auth/lupa-password');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LUPA PASSWORD
    |--------------------------------------------------------------------------
    */

    public function prosesLupaPassword()
    {
        $email = trim($this->request->getPost('email'));


        /*
        |--------------------------------------------------------------------------
        | VALIDASI EMAIL
        |--------------------------------------------------------------------------
        */

        if ($email === '') {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email wajib diisi.'
                );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CARI USER
        |--------------------------------------------------------------------------
        */

        $user = $this->user
            ->where('email', $email)
            ->first();

        if (!$user) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE OTP 6 DIGIT
        |--------------------------------------------------------------------------
        */

        $otp = (string) random_int(
            100000,
            999999
        );

        // OTP berlaku selama 10 menit
        $otpExpires = date(
            'Y-m-d H:i:s',
            time() + (10 * 60)
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN OTP KE DATABASE
        |--------------------------------------------------------------------------
        */

        $updated = $this->user->update(
            $user['id'],
            [
                'otp_code'    => $otp,
                'otp_expires' => $otpExpires
            ]
        );

        if (!$updated) {

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Kode OTP gagal dibuat.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GMAIL SMTP
        |--------------------------------------------------------------------------
        */

        $emailService = \Config\Services::email();

        // Email penerima
        $emailService->setTo(
            $user['email']
        );

        // Email pengirim
        $emailService->setFrom(
            env('email.fromEmail'),
            env(
                'email.fromName',
                'Dinas Pengairan Banyuwangi'
            )
        );

        // Subject email
        $emailService->setSubject(
            'Kode OTP Reset Kata Sandi'
        );


        /*
        |--------------------------------------------------------------------------
        | ISI EMAIL - HANYA INFORMASI OTP
        |--------------------------------------------------------------------------
        */

        $message = '
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Kode OTP</title>
        </head>

        <body style="
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 30px;
        ">

            <p>Kode OTP Anda:</p>

            <h1 style="
                font-size: 40px;
                letter-spacing: 10px;
                margin: 20px 0;
            ">
                ' . $otp . '
            </h1>

            <p>
                Kode OTP berlaku selama
                <strong>10 menit</strong>.
            </p>

        </body>
        </html>
        ';

        // Gunakan format HTML
        $emailService->setMailType('html');

        // Masukkan isi email
        $emailService->setMessage($message);


        /*
        |--------------------------------------------------------------------------
        | KIRIM EMAIL
        |--------------------------------------------------------------------------
        */

        if (!$emailService->send()) {

            // Hapus OTP jika email gagal dikirim
            $this->user->update(
                $user['id'],
                [
                    'otp_code'    => null,
                    'otp_expires' => null
                ]
            );

            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email OTP gagal dikirim. Periksa konfigurasi Gmail SMTP.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN SESSION RESET PASSWORD
        |--------------------------------------------------------------------------
        */

        session()->set([
            'reset_user_id' => $user['id'],
            'otp_verified'  => false
        ]);


        /*
        |--------------------------------------------------------------------------
        | KE HALAMAN VERIFIKASI OTP
        |--------------------------------------------------------------------------
        */

        return redirect()->to('/verifikasi-otp')
            ->with(
                'success',
                'Kode OTP telah dikirim ke email Anda.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN VERIFIKASI OTP
    |--------------------------------------------------------------------------
    */

    public function verifikasiOtp()
    {
        $resetUserId = session()->get(
            'reset_user_id'
        );

        if (!$resetUserId) {

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Silakan masukkan email terlebih dahulu.'
                );
        }

        return view('auth/verifikasi-otp');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES VERIFIKASI OTP
    |--------------------------------------------------------------------------
    */

    public function prosesVerifikasiOtp()
    {
        $resetUserId = session()->get(
            'reset_user_id'
        );

        if (!$resetUserId) {

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Sesi reset password sudah tidak tersedia.'
                );
        }

        $otp = trim(
            $this->request->getPost('otp')
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI OTP
        |--------------------------------------------------------------------------
        */

        if ($otp === '') {

            return redirect()->back()
                ->with(
                    'error',
                    'Kode OTP wajib diisi.'
                );
        }

        if (!preg_match('/^[0-9]{6}$/', $otp)) {

            return redirect()->back()
                ->with(
                    'error',
                    'Kode OTP harus terdiri dari 6 digit angka.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CARI USER
        |--------------------------------------------------------------------------
        */

        $user = $this->user->find(
            $resetUserId
        );

        if (!$user) {

            session()->remove([
                'reset_user_id',
                'otp_verified'
            ]);

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK OTP TERSEDIA
        |--------------------------------------------------------------------------
        */

        if (empty($user['otp_code'])) {

            return redirect()->back()
                ->with(
                    'error',
                    'Kode OTP tidak tersedia. Silakan minta OTP baru.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CEK OTP EXPIRED
        |--------------------------------------------------------------------------
        */

        if (
            empty($user['otp_expires']) ||
            strtotime($user['otp_expires']) < time()
        ) {

            // Hapus OTP yang sudah expired
            $this->user->update(
                $user['id'],
                [
                    'otp_code'    => null,
                    'otp_expires' => null
                ]
            );

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Kode OTP sudah kedaluwarsa. Silakan minta OTP baru.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | BANDINGKAN OTP
        |--------------------------------------------------------------------------
        */

        if (
            !hash_equals(
                (string) $user['otp_code'],
                $otp
            )
        ) {

            return redirect()->back()
                ->with(
                    'error',
                    'Kode OTP salah.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | OTP BENAR
        |--------------------------------------------------------------------------
        */

        session()->set([
            'reset_user_id' => $user['id'],
            'otp_verified'  => true
        ]);


        /*
        |--------------------------------------------------------------------------
        | KE RESET PASSWORD
        |--------------------------------------------------------------------------
        */

        return redirect()->to('/reset-password')
            ->with(
                'success',
                'Kode OTP berhasil diverifikasi.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword()
    {
        $resetUserId = session()->get(
            'reset_user_id'
        );

        $otpVerified = session()->get(
            'otp_verified'
        );


        /*
        |--------------------------------------------------------------------------
        | CEK SESSION
        |--------------------------------------------------------------------------
        */

        if (
            !$resetUserId ||
            !$otpVerified
        ) {

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Silakan verifikasi OTP terlebih dahulu.'
                );
        }

        return view(
            'auth/reset-password'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function prosesResetPassword()
    {
        $resetUserId = session()->get(
            'reset_user_id'
        );

        $otpVerified = session()->get(
            'otp_verified'
        );


        /*
        |--------------------------------------------------------------------------
        | CEK SESSION
        |--------------------------------------------------------------------------
        */

        if (
            !$resetUserId ||
            !$otpVerified
        ) {

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Sesi reset password tidak valid.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | AMBIL PASSWORD
        |--------------------------------------------------------------------------
        */

        $password = $this->request->getPost(
            'password'
        );

        $confirmPassword = $this->request->getPost(
            'confirm_password'
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI PASSWORD
        |--------------------------------------------------------------------------
        */

        if ($password === '') {

            return redirect()->back()
                ->with(
                    'error',
                    'Password wajib diisi.'
                );
        }

        if (strlen($password) < 6) {

            return redirect()->back()
                ->with(
                    'error',
                    'Password minimal 6 karakter.'
                );
        }

        if ($confirmPassword === '') {

            return redirect()->back()
                ->with(
                    'error',
                    'Konfirmasi password wajib diisi.'
                );
        }

        if ($password !== $confirmPassword) {

            return redirect()->back()
                ->with(
                    'error',
                    'Konfirmasi password tidak cocok.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CARI USER
        |--------------------------------------------------------------------------
        */

        $user = $this->user->find(
            $resetUserId
        );

        if (!$user) {

            session()->remove([
                'reset_user_id',
                'otp_verified'
            ]);

            return redirect()->to('/lupa-password')
                ->with(
                    'error',
                    'Data pengguna tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        $updated = $this->user->update(
            $user['id'],
            [

                // Password baru
                'password' => password_hash(
                    $password,
                    PASSWORD_DEFAULT
                ),

                // OTP hanya dapat digunakan sekali
                'otp_code'    => null,
                'otp_expires' => null,

                // Cabut Remember Me lama
                'remember_token' => null
            ]
        );


        if (!$updated) {

            return redirect()->back()
                ->with(
                    'error',
                    'Password gagal diperbarui.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | HAPUS REMEMBER ME COOKIE
        |--------------------------------------------------------------------------
        */

        delete_cookie(
            'remember_token'
        );


        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION RESET
        |--------------------------------------------------------------------------
        */

        session()->remove([
            'reset_user_id',
            'otp_verified'
        ]);


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()->to('/login')
            ->with(
                'success',
                'Password berhasil diubah. Silakan login dengan password baru.'
            );
    }
}