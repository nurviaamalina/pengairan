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

    public function index()
    {
        $data = [
            'title' => 'Layanan Pengaduan Masyarakat',
        ];
        return view('Pengaduan/create', $data);
    }

    public function detail($id)
    {
        $pengaduan = $this->pengaduanModel->getPengaduanById($id);
        if (!$pengaduan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Pengaduan',
            'pengaduan' => $pengaduan,
        ];
        return view('Pengaduan/DetailPengaduan', $data);
    }

    public function create()
    {
        return redirect()->to('/pengaduan');
    }

    public function save()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'kategori' => $this->request->getPost('kategori'),
            'status' => 'pending',
        ];

        $this->pengaduanModel->insertPengaduan($data);
        // Tampilkan view sukses setelah penyimpanan
        return view('pengaduan/success');
    }

    public function edit($id)
    {
        $pengaduan = $this->pengaduanModel->getPengaduanById($id);
        if (!$pengaduan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengaduan tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Pengaduan',
            'pengaduan' => $pengaduan,
        ];
        return view('Pengaduan/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'nomor_telepon' => $this->request->getPost('nomor_telepon'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'kategori' => $this->request->getPost('kategori'),
            'status' => $this->request->getPost('status'),
        ];

        $this->pengaduanModel->updatePengaduan($id, $data);
        return redirect()->to('/pengaduan')->with('success', 'Pengaduan berhasil diupdate');
    }

    public function delete($id)
    {
        $this->pengaduanModel->deletePengaduan($id);
        return redirect()->to('/pengaduan')->with('success', 'Pengaduan berhasil dihapus');
    }
}
