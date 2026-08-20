<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KategoriDokumenModel;

class AdminKategoriDokumen extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriDokumenModel();
    }

    // Menampilkan semua kategori
    public function index()
    {
        $data = [
            'title'    => 'Kategori Dokumen',
            'kategori' => $this->kategori->getKategori()
        ];

        return view('Admin/kategori/index', $data);
    }

    // Form tambah kategori
    public function create()
    {
        return view('Admin/kategori/create');
    }

    // Simpan kategori
    public function store()
    {
        $rules = [
            'nama_kategori' => 'required',
            'slug'          => 'required|is_unique[kategori_dokumen.slug]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->kategori->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'slug'          => url_title($this->request->getPost('slug'), '-', true),
        ]);

        return redirect()->to('/admin/kategori')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $data = [
            'kategori' => $this->kategori->getKategori($id)
        ];

        return view('Admin/kategori/edit', $data);
    }

    // Update
    public function update($id)
{
    $kategori = $this->kategori->find($id);

    if (!$kategori) {
        return redirect()->to('/admin/kategori')
            ->with('error', 'Kategori tidak ditemukan.');
    }

    // Ambil data dari form
    $namaKategori = trim($this->request->getPost('nama_kategori'));
    $slug = url_title(
        trim($this->request->getPost('slug')),
        '-',
        true
    );

    // Validasi
    $rules = [
        'nama_kategori' => 'required',
        'slug' => "required|is_unique[kategori_dokumen.slug,id,{$id}]"
    ];

    $dataValidasi = [
        'nama_kategori' => $namaKategori,
        'slug' => $slug
    ];

    if (!$this->validateData($dataValidasi, $rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    // Update data
    $this->kategori->update($id, [
        'nama_kategori' => $namaKategori,
        'slug'          => $slug,
    ]);

    return redirect()->to('/admin/kategori')
        ->with('success', 'Kategori berhasil diperbarui.');
}

    // Hapus
    public function delete($id)
    {
        $this->kategori->delete($id);

        return redirect()->to('/admin/kategori')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}