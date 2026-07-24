<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminProfilModel;

class AdminProfil extends BaseController
{
    protected $adminProfilModel;  // <-- Ubah nama variabel menjadi konsisten
    
    public function __construct()
    {
        $this->adminProfilModel = new AdminProfilModel();  // <-- Perbaiki ini
        helper(['text', 'form']);
    }
    
    public function index()
    {
        $data = [
            'title' => 'Profil Dinas Pengairan',
            'profil' => $this->adminProfilModel->findAll(),  // <-- Ganti
            'detail_profil' => $this->adminProfilModel->first()  // <-- Ganti
        ];
        
        return view('Admin/profil/index', $data);
    }
    
    public function create()
    {
        $data = [
            'title' => 'Tambah Profil Dinas Pengairan',
            'validation' => \Config\Services::validation()
        ];
        
        return view('Admin/profil/create', $data);
    }
    
    public function save()
    {
        $rules = [
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi_struktur' => 'permit_empty',
            'struktur' => 'permit_empty|is_image[struktur]|max_size[struktur,2048]|ext_in[struktur,jpg,jpeg,png]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $strukturFile = $this->request->getFile('struktur');
        $strukturName = '';
        
        if ($strukturFile && $strukturFile->isValid() && !$strukturFile->hasMoved()) {
            $strukturName = $strukturFile->getRandomName();
            $strukturFile->move('uploads/struktur', $strukturName);
        }
        
        // PERBAIKI: Ganti $this->profilModel menjadi $this->adminProfilModel
        $this->adminProfilModel->save([
            'sejarah' => $this->request->getPost('sejarah'),
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'deskripsi_struktur' => $this->request->getPost('deskripsi_struktur'),
            'struktur' => $strukturName
        ]);
        
        session()->setFlashdata('success', 'Data Profil berhasil ditambahkan!');
        return redirect()->to('admin/profil');
    }
    
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Profil Dinas Pengairan',
            'profil' => $this->adminProfilModel->find($id),  // <-- Ganti
            'validation' => \Config\Services::validation()
        ];
        
        if (empty($data['profil'])) {
            session()->setFlashdata('error', 'Data tidak ditemukan!');
            return redirect()->to('admin/profil');
        }
        
        return view('Admin/profil/edit', $data);
    }
    
    public function update($id)
    {
        $rules = [
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'deskripsi_struktur' => 'permit_empty',
            'struktur' => 'permit_empty|is_image[struktur]|max_size[struktur,2048]|ext_in[struktur,jpg,jpeg,png]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $dataLama = $this->adminProfilModel->find($id);  // <-- Ganti
        $strukturName = $dataLama['struktur'] ?? '';
        
        $strukturFile = $this->request->getFile('struktur');
        if ($strukturFile && $strukturFile->isValid() && !$strukturFile->hasMoved()) {
            if (!empty($strukturName) && file_exists('uploads/struktur/' . $strukturName)) {
                unlink('uploads/struktur/' . $strukturName);
            }
            
            $strukturName = $strukturFile->getRandomName();
            $strukturFile->move('uploads/struktur', $strukturName);
        }
        
        $this->adminProfilModel->update($id, [  // <-- Ganti
            'sejarah' => $this->request->getPost('sejarah'),
            'visi' => $this->request->getPost('visi'),
            'misi' => $this->request->getPost('misi'),
            'deskripsi_struktur' => $this->request->getPost('deskripsi_struktur'),
            'struktur' => $strukturName
        ]);
        
        session()->setFlashdata('success', 'Data Profil berhasil diupdate!');
        return redirect()->to('admin/profil');
    }
    
    public function delete($id)
    {
        $data = $this->adminProfilModel->find($id);  // <-- Ganti
        
        if (empty($data)) {
            session()->setFlashdata('error', 'Data tidak ditemukan!');
            return redirect()->to('admin/profil');
        }
        
        if (!empty($data['struktur']) && file_exists('uploads/struktur/' . $data['struktur'])) {
            unlink('uploads/struktur/' . $data['struktur']);
        }
        
        $this->adminProfilModel->delete($id);  // <-- Ganti
        
        session()->setFlashdata('success', 'Data Profil berhasil dihapus!');
        return redirect()->to('admin/profil');
    }
}