<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        $role = session()->get('role');

        if (!$role) {
            return redirect()->to('/login');
        }

        // Superadmin selalu boleh
        if ($role === 'superadmin') {
            return;
        }

        // Cek role yang diperbolehkan
        if (!empty($arguments)) {

            if (!in_array($role, $arguments)) {

                return redirect()
                    ->to('/admin/dashboard')
                    ->with(
                        'error',
                        'Anda tidak memiliki hak akses.'
                    );
            }
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak ada proses
    }
}