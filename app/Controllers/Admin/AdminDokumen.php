<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KategoriDokumenModel;

class AdminDokumen extends BaseController
{
    protected $dokumen;
    protected $kategori;

    public function __construct()
    {
        $this->dokumen = new DokumenModel();
        $this->kategori = new KategoriDokumenModel();
    }

    // Daftar dokumen
    public function index()
    {
        $data = [
            'title'    => 'Kategori Dokumen',
            'kategori' => $this->kategori->findAll()
        ];

        return view('Admin/kategori/index', $data);
    }

    // Menampilkan dokumen berdasarkan slug kategori
    public function kategori($slug)
    {
           $kategori = $this->kategori->getSlug($slug);

        if (!$kategori) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'    => $kategori['nama_kategori'],
            'kategori' => $kategori,
            'dokumen'  => $this->dokumen->getByKategori($kategori['id'])
        ];

        return view('Admin/dokumen/list', $data);
    }

    // Form tambah dokumen
    public function create($slug = null)
    {

        $data = [
            
            'kategori' => $this->kategori->getKategori(),
            'slug'     => $slug
           
        ];

        return view('Admin/dokumen/create', $data);
    }

    
    // Simpan dokumen
    // Simpan dokumen
public function store()
{
    $rules = [
        'kategori_id' => 'required',
        'judul'       => 'required',
        'tahun'       => 'required',
        'file'        => 'uploaded[file]|ext_in[file,pdf]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput();
    }

    $kategoriId = $this->request->getPost('kategori_id');

    // Cari kategori berdasarkan ID
    $kategori = $this->kategori->find($kategoriId);

    if (!$kategori) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Kategori tidak ditemukan.');
    }

    $file = $this->request->getFile('file');

    // Nama file tetap menggunakan nama asli
    $namaFile = $file->getName();

    // Simpan file
    $file->move(FCPATH . 'uploads/dokumen', $namaFile);

    // Simpan data ke database
    $this->dokumen->save([
        'kategori_id' => $kategoriId,
        'judul'       => $this->request->getPost('judul'),
        'tahun'       => $this->request->getPost('tahun'),
        'file'        => $namaFile,
    ]);

    // Redirect ke halaman kategori
    return redirect()->to('/admin/kategori/' . $kategori['slug'])
        ->with('success', 'Dokumen berhasil ditambahkan.');
}


    // Form edit
    public function edit($id)
    {
        $data = [
            'dokumen'  => $this->dokumen->getDokumen($id),
            'kategori' => $this->kategori->getKategori()
        ];

        return view('Admin/dokumen/edit', $data);
    }

    // Update
    public function update($id)
{
    $dokumen = $this->dokumen->find($id);

    if (!$dokumen) {
        return redirect()->back()
            ->with('error', 'Dokumen tidak ditemukan.');
    }

    $data = [
        'kategori_id' => $this->request->getPost('kategori_id'),
        'judul'       => $this->request->getPost('judul'),
        'tahun'       => $this->request->getPost('tahun'),
    ];

    $file = $this->request->getFile('file');

    // Jika user upload PDF baru
    if ($file && $file->isValid() && !$file->hasMoved()) {

        // Hapus file lama
        if (
            !empty($dokumen['file']) &&
            file_exists(FCPATH . 'uploads/dokumen/' . $dokumen['file'])
        ) {
            unlink(FCPATH . 'uploads/dokumen/' . $dokumen['file']);
        }

        // Gunakan nama asli PDF
        $namaFile = $file->getName();

        // Simpan dengan nama asli
        $file->move(FCPATH . 'uploads/dokumen', $namaFile);

        $data['file'] = $namaFile;
    }

    $this->dokumen->update($id, $data);

    $kategori = $this->kategori->find(
        $this->request->getPost('kategori_id')
    );

    return redirect()->to('/admin/kategori/' . $kategori['slug'])
                     ->with('success', 'Dokumen berhasil diperbarui.');
}

    // Hapus
    public function delete($id)
    {
        $dokumen = $this->dokumen->find($id);

        if ($dokumen) {

            if (!empty($dokumen['file']) && file_exists(FCPATH . 'uploads/dokumen/' . $dokumen['file'])) {
                unlink(FCPATH . 'uploads/dokumen/' . $dokumen['file']);
            }

            $this->dokumen->delete($id);
        }

        return redirect()->to('/admin/dokumen')
                         ->with('success', 'Dokumen berhasil dihapus.');
    }

    
}