<?php

namespace App\Controllers;

use App\Models\PengaduanModel;

class Pengaduan extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }

    // ===== INDEX (Form + Daftar Pengaduan + Pencarian) =====
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $pengaduan = $this->pengaduanModel
                ->like('nama', $keyword)
                ->orLike('judul', $keyword)
                ->orLike('kategori', $keyword)
                ->orLike('status', $keyword)
                ->orderBy('created_at', 'DESC')
                ->limit(5)  // ← BATASI 5 DATA
                ->findAll();
        } else {
            $pengaduan = $this->pengaduanModel
                ->orderBy('created_at', 'DESC')
                ->limit(5)  // ← BATASI 5 DATA
                ->findAll();
        }

        $data = [
            'pengaduan' => $pengaduan,
            'keyword'   => $keyword
        ];

        return view('Pengaduan/index', $data);
    }

    // ===== SAVE =====
    public function save()
    {
        // Generate tracking code
        $tracking_code = strtoupper(substr(md5(uniqid()), 0, 8));

        $data = [
            'nama'           => $this->request->getPost('nama'),
            'email'          => $this->request->getPost('email'),
            'nomor_telepon'  => $this->request->getPost('nomor_telepon'),
            'judul'          => $this->request->getPost('judul'),
            'kategori'       => $this->request->getPost('kategori'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'status'         => 'pending',
            'tracking_code'  => $tracking_code
        ];

        $this->pengaduanModel->save($data);

        session()->setFlashdata('success', 'Pengaduan Anda berhasil dikirim! Kode tracking: ' . $tracking_code);
        return redirect()->to('pengaduan');
    }

    // ===== TRACK FORM =====
    public function trackForm()
    {
        return view('Pengaduan/track');
    }

    // ===== TRACK =====
    public function track()
    {
        $query = $this->request->getPost('query');

        $pengaduan = $this->pengaduanModel
            ->like('nama', $query)
            ->orLike('tracking_code', $query)
            ->orLike('judul', $query)
            ->findAll();

        return view('Pengaduan/track', [
            'pengaduan' => $pengaduan,
            'query' => $query
        ]);
    }
}