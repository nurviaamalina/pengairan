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

        $ruleSlug = ($kategori['slug'] == $this->request->getPost('slug'))
            ? 'required'
            : 'required|is_unique[kategori_dokumen.slug]';

        $rules = [
            'nama_kategori' => 'required',
            'slug'          => $ruleSlug
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $this->kategori->update($id, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'slug'          => url_title($this->request->getPost('slug'), '-', true),
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