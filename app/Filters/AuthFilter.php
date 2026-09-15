<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        $session = session();

        // =====================================================
        // 1. JIKA SUDAH LOGIN
        // =====================================================

        if ($session->get('login') === true) {
            return;
        }


        // =====================================================
        // 2. CEK COOKIE "INGAT SAYA"
        // =====================================================

        $rememberToken = get_cookie('remember_token');


        if ($rememberToken) {

            $userModel = new UserModel();

            // Hash token dari cookie
            $hashedToken = hash(
                'sha256',
                $rememberToken
            );

            // Cari user berdasarkan token
            $user = $userModel
                ->where(
                    'remember_token',
                    $hashedToken
                )
                ->first();


            // =================================================
            // 3. TOKEN VALID
            // =================================================

            if ($user) {

                // Buat session login kembali
                $session->set([
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                    'login'    => true,
                ]);

                // Izinkan request dilanjutkan
                return;
            }


            // =================================================
            // 4. TOKEN TIDAK VALID
            // =================================================

            delete_cookie('remember_token');
        }


        // =====================================================
        // 5. BELUM LOGIN
        // =====================================================

        return redirect()->to('/login')
            ->with(
                'error',
                'Silakan login terlebih dahulu.'
            );
    }


    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak perlu melakukan apa-apa
    }
}