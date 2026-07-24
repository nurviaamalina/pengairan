<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengaduanModel;

class AdminPengaduan extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }

    /**
     * ============================================================
     * INDEX - Daftar Pengaduan (10 data terbaru)
     * ============================================================
     */
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
                ->limit(10)
                ->findAll();
        } else {
            $pengaduan = $this->pengaduanModel
                ->orderBy('created_at', 'DESC')
                ->limit(10)
                ->findAll();
        }

        // Hitung statistik
        $total_all = $this->pengaduanModel->countAll();
        $pending = $this->pengaduanModel->where('status', 'pending')->countAllResults();
        $diproses = $this->pengaduanModel->where('status', 'diproses')->countAllResults();
        $selesai = $this->pengaduanModel->where('status', 'selesai')->countAllResults();
        $ditolak = $this->pengaduanModel->where('status', 'ditolak')->countAllResults();

        $data = [
            'pengaduan' => $pengaduan,
            'keyword'   => $keyword,
            'total_all' => $total_all,
            'pending'   => $pending,
            'diproses'  => $diproses,
            'selesai'   => $selesai,
            'ditolak'   => $ditolak,
        ];

        return view('Admin/PengaduanAdmin/index', $data);
    }

    /**
     * ============================================================
     * DETAIL - Lihat Detail Pengaduan
     * ============================================================
     */
    public function detail($id)
    {
        $pengaduan = $this->pengaduanModel->find($id);

        if (!$pengaduan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pengaduan tidak ditemukan');
        }

        return view('Admin/PengaduanAdmin/detail', ['pengaduan' => $pengaduan]);
    }

    /**
     * ============================================================
     * UPDATE STATUS - Ubah Status Pengaduan
     * ============================================================
     */
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        // Validasi status
        $allowedStatus = ['pending', 'diproses', 'selesai', 'ditolak'];
        if (!in_array($status, $allowedStatus)) {
            session()->setFlashdata('error', 'Status tidak valid!');
            return redirect()->back();
        }

        $pengaduan = $this->pengaduanModel->find($id);
        if (!$pengaduan) {
            session()->setFlashdata('error', 'Pengaduan tidak ditemukan!');
            return redirect()->back();
        }

        $this->pengaduanModel->update($id, ['status' => $status]);

        // Mapping status ke teks
        $statusText = [
            'pending' => 'Pending',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        session()->setFlashdata('success', 'Status pengaduan berhasil diubah menjadi "' . $statusText[$status] . '"!');
        return redirect()->to('admin/pengaduan');
    }

    /**
     * ============================================================
     * DELETE - Hapus Pengaduan
     * ============================================================
     */
    public function delete($id)
    {
        $pengaduan = $this->pengaduanModel->find($id);

        if (!$pengaduan) {
            session()->setFlashdata('error', 'Pengaduan tidak ditemukan!');
            return redirect()->to('admin/pengaduan');
        }

        $this->pengaduanModel->delete($id);

        session()->setFlashdata('success', 'Pengaduan berhasil dihapus!');
        return redirect()->to('admin/pengaduan');
    }

    /**
     * ============================================================
     * BULK DELETE - Hapus Banyak Pengaduan (Opsional)
     * ============================================================
     */
    public function bulkDelete()
    {
        $ids = $this->request->getPost('ids');

        if (!$ids || !is_array($ids)) {
            session()->setFlashdata('error', 'Tidak ada data yang dipilih!');
            return redirect()->to('admin/pengaduan');
        }

        $this->pengaduanModel->whereIn('id', $ids)->delete();

        session()->setFlashdata('success', count($ids) . ' pengaduan berhasil dihapus!');
        return redirect()->to('admin/pengaduan');
    }

    /**
     * ============================================================
     * EXPORT - Export Data Pengaduan ke CSV/Excel (Opsional)
     * ============================================================
     */
    public function export()
    {
        $pengaduan = $this->pengaduanModel->orderBy('created_at', 'DESC')->findAll();

        if (empty($pengaduan)) {
            session()->setFlashdata('error', 'Tidak ada data untuk diexport!');
            return redirect()->to('admin/pengaduan');
        }

        $filename = 'pengaduan_' . date('Y-m-d') . '.csv';

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        // Header CSV
        fputcsv($output, ['ID', 'Nama', 'Email', 'Telepon', 'Judul', 'Kategori', 'Status', 'Tanggal']);

        // Data
        foreach ($pengaduan as $row) {
            fputcsv($output, [
                $row['id'],
                $row['nama'],
                $row['email'],
                $row['nomor_telepon'],
                $row['judul'],
                $row['kategori'],
                $row['status'],
                $row['created_at']
            ]);
        }

        fclose($output);
        exit();
    }
}