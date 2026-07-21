<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class AdminBerita extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    // Menampilkan daftar berita
    public function index()
    {
        $data = [
            'title'   => 'Data Berita',
            'berita'  => $this->beritaModel
                            ->orderBy('tanggal', 'DESC')
                            ->findAll()
        ];

        return view('admin/BeritaAdmin/index', $data);
    }

    // Form tambah berita
    public function create()
    {
        $data = [
            'title' => 'Tambah Berita'
        ];

        return view('admin/BeritaAdmin/create', $data);
    }

    // Simpan berita
    public function store()
    {
        $gambar = $this->request->getFile('gambar');

        $namaGambar = null;

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

            $namaGambar = $gambar->getRandomName();

            $gambar->move(FCPATH . 'uploads/berita', $namaGambar);
        }

        $this->beritaModel->save([

            'judul' => $this->request->getPost('judul'),

            'slug' => url_title(
                $this->request->getPost('judul'),
                '-',
                true
            ),

            'isi' => $this->request->getPost('isi'),

            'gambar' => $namaGambar,

            'publikator' => $this->request->getPost('publikator'),

            'tanggal' => $this->request->getPost('tanggal'),

            'views' => 0

        ]);

        return redirect()->to('/admin/berita')
                         ->with('success', 'Berita berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $berita = $this->beritaModel->find($id);

        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('admin/BeritaAdmin/edit', [
            'title' => 'Edit Berita',
            'berita' => $berita
        ]);
    }

    // Update berita
    public function update($id)
    {
        $berita = $this->beritaModel->find($id);

        $gambar = $this->request->getFile('gambar');

        $namaGambar = $berita['gambar'];

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

            if (!empty($berita['gambar']) &&
                file_exists(FCPATH . 'uploads/berita/' . $berita['gambar'])) {

                unlink(FCPATH . 'uploads/berita/' . $berita['gambar']);
            }

            $namaGambar = $gambar->getRandomName();

            $gambar->move(FCPATH . 'uploads/berita', $namaGambar);
        }

        $this->beritaModel->update($id, [

            'judul' => $this->request->getPost('judul'),

            'slug' => url_title(
                $this->request->getPost('judul'),
                '-',
                true
            ),

            'isi' => $this->request->getPost('isi'),

            'gambar' => $namaGambar,

            'publikator' => $this->request->getPost('publikator'),

            'tanggal' => $this->request->getPost('tanggal')

        ]);

        return redirect()->to('/admin/berita')
                         ->with('success', 'Berita berhasil diperbarui.');
    }

    // Hapus berita
    public function delete($id)
    {
        $berita = $this->beritaModel->find($id);

        if ($berita) {

            if (!empty($berita['gambar']) &&
                file_exists(FCPATH . 'uploads/berita/' . $berita['gambar'])) {

                unlink(FCPATH . 'uploads/berita/' . $berita['gambar']);
            }

            $this->beritaModel->delete($id);
        }

        return redirect()->to('/admin/berita')
                         ->with('success', 'Berita berhasil dihapus.');
    }
}