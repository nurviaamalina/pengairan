<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class KorsdaFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek login
        if (!session()->get('login')) {
            return redirect()->to('/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil role
        $role = session()->get('role');

        // Hanya admin dan user
        if ($role !== 'admin' && $role !== 'user') {
            return redirect()->to('/login')
                ->with('error', 'Anda tidak memiliki akses.');
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
    }
}