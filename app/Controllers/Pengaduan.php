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
        // Paginate 5 per page
        $pengaduan = $this->pengaduanModel
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $pager = $this->pengaduanModel->pager;

        $data = [
            'pengaduan' => $pengaduan,
            'total' => $this->pengaduanModel->countAll(),
            'pager' => $pager
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
        // Show paginated list (5 per page) for the track page using its own pager group
        $pengaduan = $this->pengaduanModel
            ->orderBy('created_at', 'DESC')
            ->paginate(5, 'track');

        $pager = $this->pengaduanModel->pager;

        $data = [
            'pengaduan' => $pengaduan,
            'total' => $this->pengaduanModel->countAll(),
            'pager' => $pager,
            'pagerGroup' => 'track'
        ];

        return view('Pengaduan/track', $data);
    }

    // ===== TRACK =====
    public function track()
    {
        $query = $this->request->getPost('query');
        $result = $this->getTrackRows($query);

        return view('Pengaduan/track', [
            'pengaduan' => $result,
            'query' => $query
        ]);
    }

    public function trackJson()
    {
        $query = $this->request->getGet('query');
        $result = $this->getTrackRows($query);

        return $this->response->setJSON(['data' => $result]);
    }

    private function getTrackRows($query)
    {
        if (empty($query)) {
            return [];
        }

        $model = new \App\Models\PengaduanModel();

        $rows = $model->groupStart()
            ->where('tracking_code', $query)
            ->orWhere('nama', $query)
            ->groupEnd()
            ->findAll();

        $result = [];

        foreach ($rows as $row) {
            $row['hasil_penanganan'] = $row['hasil_penanganan']
                ?? $row['tindak_lanjut']
                ?? $row['catatan_penanganan']
                ?? '';

            $result[] = $row;
        }

        return $result;
    }

    // ===== UPDATE TINDAK LANJUT =====
    public function updateTindakLanjut($id)
    {
        $data = [
            'status' => $this->request->getPost('status'),
            'tindak_lanjut' => $this->request->getPost('tindak_lanjut'),
        ];

        $this->pengaduanModel->update($id, $data);

        return redirect()->back()->with('success', 'Tindak lanjut berhasil disimpan.');
    }
}