<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProfilModel;
use App\Models\KorsdaModel;

class ProfilKorsda extends BaseController
{
    protected $profilModel;
    protected $korsda;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->korsda = new KorsdaModel();
    }

    public function index()
    {
        $data['profil'] = $this->profilModel
            ->select('profil_korsda.*, korsda.nama_kecamatan')
            ->join('korsda', 'korsda.id = profil_korsda.id_korsda')
            ->findAll();

        $data['kecamatan'] = $this->korsda->findAll();

        return view('admin/korsda/profil_korsda/index', $data);
    }

    public function create()
    {
    $data['kecamatan'] = $this->korsda->findAll();

    return view('admin/korsda/profil_korsda/create', $data);
    }

    public function store()
{
    $gambar = $this->request->getFile('struktur');

    $nama = null;

    if ($gambar->isValid() && !$gambar->hasMoved()) {

        $nama = $gambar->getRandomName();

        $gambar->move('uploads/struktur', $nama);
    }

   $this->profilModel->save([
    'id_korsda' => $this->request->getPost('id_korsda'),
    'visi'      => $this->request->getPost('visi'),
    'misi'      => $this->request->getPost('misi'),
    'tugas'     => $this->request->getPost('tugas'),
    'struktur'  => $nama
]);

    return redirect()->to('admin/korsda/profil_korsda');
    }

 public function edit($id)
    {
        $data['profil'] = $this->profilModel->find($id);
        $data['korsda'] = $this->korsda->findAll();

    


        return view('admin/korsda/profil_korsda/edit', $data);
    }

    public function update($id)
{
    return redirect()->to(base_url('admin/korsda/profil_korsda'));
}

public function delete($id)
{
    $profil = $this->profilModel->find($id);

    if (!$profil) {
        return redirect()->to(base_url('admin/korsda/profil_korsda'))
                         ->with('error', 'Data tidak ditemukan.');
    }

    // Hapus file struktur jika ada
    if (!empty($profil['struktur'])) {
        $file = FCPATH . 'uploads/struktur/' . $profil['struktur'];

        if (file_exists($file)) {
            unlink($file);
        }
    }

    $this->profilModel->delete($id);

    return redirect()->to(base_url('admin/korsda/profil_korsda'))
                     ->with('success', 'Data berhasil dihapus.');
}
}