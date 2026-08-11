<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;
use App\Models\KecamatanModel;

class Korsda extends BaseController
{
    protected $korsdaModel;
    protected $kecamatanModel;

    public function __construct()
    {
        $this->korsdaModel = new KorsdaModel();
        $this->kecamatanModel = new KecamatanModel();
    }

    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $data = [
            'title'  => 'Data KORSDA',
            'korsda' => $this->korsdaModel->getKorsda()
        ];

        return view('admin/korsda/index', $data);
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $data = [
            'title'     => 'Tambah KORSDA',
            'kecamatan' => $this->kecamatanModel->findAll()
        ];

        return view('admin/korsda/create', $data);
    }

    // =========================
    // STORE
    // =========================
    public function store()
    {
        $rules = [
            'kecamatan_id' => 'required',
            'nama_wilayah' => 'required|max_length[100]',
            'nama'         => 'required|max_length[100]',
            'jabatan'      => 'required|max_length[100]',
            'nip'          => 'permit_empty|max_length[30]',
            'email'        => 'permit_empty|valid_email|max_length[100]',
            'no_hp'        => 'permit_empty|max_length[20]',
            'alamat'       => 'permit_empty',
            'foto'         => 'permit_empty|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // =========================
        // DATA
        // =========================

        $data = [
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'nama'         => $this->request->getPost('nama'),
            'jabatan'      => $this->request->getPost('jabatan'),
            'nip'          => $this->request->getPost('nip'),
            'email'        => $this->request->getPost('email'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'alamat'       => $this->request->getPost('alamat'),
            'status'       => $this->request->getPost('status') ?? 'Aktif'
        ];

        // =========================
        // FOTO
        // =========================

        $foto = $this->request->getFile('foto');

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {

            $namaFoto = $foto->getRandomName();

            $uploadPath = FCPATH . 'uploads/korsda';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $foto->move($uploadPath, $namaFoto);

            $data['foto'] = $namaFoto;
        }

        // =========================
        // SIMPAN
        // =========================

        $this->korsdaModel->insert($data);

        return redirect()
            ->to(base_url('admin/korsda'))
            ->with('success', 'Data KORSDA berhasil ditambahkan.');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $korsda = $this->korsdaModel->getById($id);

        if (!$korsda) {
            return redirect()
                ->to(base_url('admin/korsda'))
                ->with('error', 'Data KORSDA tidak ditemukan.');
        }

        $data = [
            'title'     => 'Edit KORSDA',
            'korsda'    => $korsda,
            'kecamatan' => $this->kecamatanModel->findAll()
        ];

        return view('admin/korsda/edit', $data);
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $korsda = $this->korsdaModel->find($id);

        if (!$korsda) {
            return redirect()
                ->to(base_url('admin/korsda'))
                ->with('error', 'Data KORSDA tidak ditemukan.');
        }

        $rules = [
            'kecamatan_id' => 'required',
            'nama_wilayah' => 'required|max_length[100]',
            'nama'         => 'required|max_length[100]',
            'jabatan'      => 'required|max_length[100]',
            'nip'          => 'permit_empty|max_length[30]',
            'email'        => 'permit_empty|valid_email|max_length[100]',
            'no_hp'        => 'permit_empty|max_length[20]',
            'alamat'       => 'permit_empty',
            'foto'         => 'permit_empty|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'kecamatan_id' => $this->request->getPost('kecamatan_id'),
            'nama_wilayah' => $this->request->getPost('nama_wilayah'),
            'nama'         => $this->request->getPost('nama'),
            'jabatan'      => $this->request->getPost('jabatan'),
            'nip'          => $this->request->getPost('nip'),
            'email'        => $this->request->getPost('email'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'alamat'       => $this->request->getPost('alamat'),
            'status'       => $this->request->getPost('status') ?? 'Aktif'
        ];

        // FOTO BARU
        $foto = $this->request->getFile('foto');

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {

            $uploadPath = FCPATH . 'uploads/korsda';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $namaFoto = $foto->getRandomName();

            $foto->move($uploadPath, $namaFoto);

            // hapus foto lama
            if (
                !empty($korsda['foto']) &&
                $korsda['foto'] !== 'default.png'
            ) {
                $fotoLama = $uploadPath . '/' . $korsda['foto'];

                if (file_exists($fotoLama)) {
                    unlink($fotoLama);
                }
            }

            $data['foto'] = $namaFoto;
        }

        $this->korsdaModel->update($id, $data);

        return redirect()
            ->to(base_url('admin/korsda'))
            ->with('success', 'Data KORSDA berhasil diperbarui.');
    }

    // =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $korsda = $this->korsdaModel->find($id);

        if (!$korsda) {
            return redirect()
                ->to(base_url('admin/korsda'))
                ->with('error', 'Data KORSDA tidak ditemukan.');
        }

        $this->korsdaModel->delete($id);

        return redirect()
            ->to(base_url('admin/korsda'))
            ->with('success', 'Data KORSDA berhasil dihapus.');
    }
}