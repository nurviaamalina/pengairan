<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ManajemenUser extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $role = session()->get('role');

        // Superadmin melihat semua akun
        if ($role === 'superadmin') {
            $users = $this->user
                ->orderBy('id', 'DESC')
                ->findAll();
        }

        // Admin hanya melihat user biasa
        elseif ($role === 'admin') {
            $users = $this->user
                ->where('role', 'user')
                ->orderBy('id', 'DESC')
                ->findAll();
        }

        // User tidak boleh masuk
        else {
            return redirect()->to('/admin/korsda/kegiatan')
                ->with(
                    'error',
                    'Anda tidak memiliki akses ke Manajemen User.'
                );
        }

        return view('admin/manajemen-user/index', [
            'title' => 'Manajemen User',
            'users' => $users
        ]);
    }

    /**
     * Halaman tambah user
     */
    public function create()
    {
        $role = session()->get('role');

        if (!in_array($role, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/korsda/kegiatan')
                ->with('error', 'Anda tidak memiliki akses.');
        }

        return view('admin/manajemen-user/create', [
            'title' => 'Tambah User'
        ]);
    }

    /**
     * Proses tambah user
     */
    public function store()
    {
        $roleLogin = session()->get('role');

        if (!in_array($roleLogin, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/korsda/kegiatan')
                ->with('error', 'Anda tidak memiliki akses.');
        }

        $username = trim((string) $this->request->getPost('username'));
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $role     = (string) $this->request->getPost('role');
        $active   = (int) $this->request->getPost('active');

        // Validasi dasar
        if ($username === '' || $email === '' || $password === '') {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username, email, dan password wajib diisi.'
                );
        }

        // Admin hanya boleh membuat user
        if ($roleLogin === 'admin') {
            $role = 'user';
        }

        // Superadmin hanya boleh membuat admin/user
        if (
            $roleLogin === 'superadmin' &&
            !in_array($role, ['admin', 'user'])
        ) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Role yang dipilih tidak valid.'
                );
        }

        // Cek username
        $cekUsername = $this->user
            ->where('username', $username)
            ->first();

        if ($cekUsername) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username sudah digunakan.'
                );
        }

        // Cek email
        $cekEmail = $this->user
            ->where('email', $email)
            ->first();

        if ($cekEmail) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email sudah digunakan.'
                );
        }

        // Data user
        $data = [
            'username' => $username,
            'email'    => $email,
            'password' => $password,
            'role'     => $role,
            'active'   => $active
        ];

        if (!$this->user->insert($data)) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'User gagal ditambahkan.'
                );
        }

        return redirect()
            ->to('/admin/manajemen-user')
            ->with(
                'success',
                'User berhasil ditambahkan.'
            );
    }

    /**
     * Halaman edit user
     */
    public function edit($id)
    {
        $roleLogin = session()->get('role');

        if (!in_array($roleLogin, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/korsda/kegiatan')
                ->with('error', 'Anda tidak memiliki akses.');
        }

        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'User tidak ditemukan.'
                );
        }

        // Admin hanya boleh mengedit user biasa
        if (
            $roleLogin === 'admin' &&
            $user['role'] !== 'user'
        ) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'Admin hanya dapat mengedit user biasa.'
                );
        }

        return view('admin/manajemen-user/edit', [
            'title' => 'Edit User',
            'user'  => $user
        ]);
    }

    /**
     * Proses update user
     */
    public function update($id)
    {
        $roleLogin = session()->get('role');

        if (!in_array($roleLogin, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/korsda/kegiatan')
                ->with('error', 'Anda tidak memiliki akses.');
        }

        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'User tidak ditemukan.'
                );
        }

        // Admin hanya boleh mengubah user biasa
        if (
            $roleLogin === 'admin' &&
            $user['role'] !== 'user'
        ) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'Admin hanya dapat mengedit user biasa.'
                );
        }

        $username = trim((string) $this->request->getPost('username'));
        $email    = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');
        $role     = (string) $this->request->getPost('role');
        $active   = (int) $this->request->getPost('active');

        // Username dan email wajib diisi
        if ($username === '' || $email === '') {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username dan email wajib diisi.'
                );
        }

        // Admin tidak dapat mengubah role
        if ($roleLogin === 'admin') {
            $role = 'user';
        }

        // Superadmin hanya dapat memilih admin/user
        if (
            $roleLogin === 'superadmin' &&
            !in_array($role, ['admin', 'user'])
        ) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Role yang dipilih tidak valid.'
                );
        }

        // Cek username digunakan user lain
        $cekUsername = $this->user
            ->where('username', $username)
            ->where('id !=', $id)
            ->first();

        if ($cekUsername) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Username sudah digunakan oleh akun lain.'
                );
        }

        // Cek email digunakan user lain
        $cekEmail = $this->user
            ->where('email', $email)
            ->where('id !=', $id)
            ->first();

        if ($cekEmail) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Email sudah digunakan oleh akun lain.'
                );
        }

        // Data yang diperbarui
        $data = [
            'username' => $username,
            'email'    => $email,
            'role'     => $role,
            'active'   => $active
        ];

        // Password hanya diubah jika diisi
        if ($password !== '') {
            $data['password'] = $password;
        }

        if (!$this->user->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with(
                    'error',
                    'Data user gagal diperbarui.'
                );
        }

        return redirect()
            ->to('/admin/manajemen-user')
            ->with(
                'success',
                'Data user berhasil diperbarui.'
            );
    }

    /**
     * Hapus user
     */
    public function delete($id)
    {
        $roleLogin   = session()->get('role');
        $userIdLogin = session()->get('id');

        if (!in_array($roleLogin, ['superadmin', 'admin'])) {
            return redirect()->to('/admin/korsda/kegiatan')
                ->with('error', 'Anda tidak memiliki akses.');
        }

        $user = $this->user->find($id);

        if (!$user) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'User tidak ditemukan.'
                );
        }

        // Tidak boleh menghapus akun sendiri
        if ((int) $id === (int) $userIdLogin) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'Anda tidak dapat menghapus akun yang sedang digunakan.'
                );
        }

        // Admin hanya boleh menghapus user biasa
        if (
            $roleLogin === 'admin' &&
            $user['role'] !== 'user'
        ) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'Admin hanya dapat menghapus user biasa.'
                );
        }

        if (!$this->user->delete($id)) {
            return redirect()->to('/admin/manajemen-user')
                ->with(
                    'error',
                    'User gagal dihapus.'
                );
        }

        return redirect()
            ->to('/admin/manajemen-user')
            ->with(
                'success',
                'User berhasil dihapus.'
            );
    }
}