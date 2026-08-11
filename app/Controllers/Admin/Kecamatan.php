<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KecamatanModel;

class Kecamatan extends BaseController
{
    protected $kecamatan;

    public function __construct()
    {
        $this->kecamatan = new KecamatanModel();
    }

    // =========================
    // INDEX
    // =========================
 public function index()
{
    $data = [
        'title' => 'Data Kecamatan',
        'kecamatan' => $this->kecamatan
            ->orderBy('nama_kecamatan', 'ASC')
            ->findAll()
    ];

    return view(
        'admin/korsda/kecamatan/index',
        $data
    );
}


    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $data = [
            'title' => 'Tambah Kecamatan'
        ];

        return view(
            'admin/korsda/kecamatan/create',
            $data
        );
    }


    // =========================
    // STORE
    // =========================
    public function store()
    {
        $rules = [
            'nama_kecamatan' => [
                'rules' => 'required|is_unique[kecamatan.nama_kecamatan]',
                'errors' => [
                    'required'  => 'Nama Kecamatan wajib diisi.',
                    'is_unique' => 'Nama Kecamatan sudah ada.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->kecamatan->save([
            'nama_kecamatan' => $this->request
                ->getPost('nama_kecamatan')
        ]);

        return redirect()
            ->to(base_url('admin/korsda/kecamatan'))
            ->with(
                'success',
                'Data Kecamatan berhasil ditambahkan.'
            );
    }


    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $kecamatan = $this->kecamatan->find($id);

        if (!$kecamatan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'     => 'Edit Kecamatan',
            'kecamatan' => $kecamatan
        ];

        return view(
            'admin/korsda/kecamatan/edit',
            $data
        );
    }


    // =========================
    // UPDATE
    // =========================
    public function update($id)
    {
        $rules = [
            'nama_kecamatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kecamatan wajib diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $this->kecamatan->update($id, [
            'nama_kecamatan' => $this->request
                ->getPost('nama_kecamatan')
        ]);

        return redirect()
            ->to(base_url('admin/korsda/kecamatan'))
            ->with(
                'success',
                'Data Kecamatan berhasil diubah.'
            );
    }


    // =========================
    // DELETE
    // =========================
    public function delete($id)
    {
        $data = $this->kecamatan->find($id);

        if (!$data) {
            return redirect()
                ->to(base_url('admin/korsda/kecamatan'))
                ->with(
                    'error',
                    'Data Kecamatan tidak ditemukan.'
                );
        }

        $this->kecamatan->delete($id);

        return redirect()
            ->to(base_url('admin/korsda/kecamatan'))
            ->with(
                'success',
                'Data Kecamatan berhasil dihapus.'
            );
    }
}