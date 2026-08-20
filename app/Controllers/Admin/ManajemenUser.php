<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ManajemenUser extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // =========================
    // DAFTAR USER
    // =========================
    public function index()
    {
        $data = [
            'title' => 'Manajemen User',
            'users' => $this->userModel
                ->orderBy('created_at', 'DESC')
                ->findAll(),
        ];

        return view('Admin/manajemen_user/index', $data);
    }


    // =========================
    // HAPUS USER
    // =========================
    public function delete($id)
    {
        // Jangan hapus akun sendiri
        if ($id == session()->get('id')) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/manajemen-user')
                ->with('error', 'User tidak ditemukan.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/manajemen-user')
            ->with('success', 'User berhasil dihapus.');
    }
}