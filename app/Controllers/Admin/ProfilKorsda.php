<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProfilModel;
use App\Models\KorsdaModel;

class ProfilKorsda extends BaseController
{
    protected $profilModel;
    protected $korsdaModel;

    public function __construct()
    {
        $this->profilModel = new ProfilModel();
        $this->korsdaModel = new KorsdaModel();
    }

   public function index()
{
    $profil = $this->profilModel
        ->select('profil_korsda.*, korsda.nama AS nama_kecamatan')
        ->join(
            'korsda',
            'korsda.id = profil_korsda.korsda_id',
            'left'
        )
        ->findAll();

    $data = [
        'title'  => 'Profil KORSDA',
        'profil' => $profil,
    ];

    return view(
        'Admin/korsda/profil_korsda/index',
        $data
    );
}

    public function create()
    {
        $korsda = $this->korsdaModel->findAll();

        return view(
            'Admin/korsda/profil_korsda/create',
            [
                'title'  => 'Tambah Profil KORSDA',
                'korsda' => $korsda,
            ]
        );
    }

    public function store()
    {
        // ==============================
        // VALIDASI KORSDA
        // ==============================

        $korsdaId = $this->request->getPost('korsda_id');

        if (empty($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA / Kecamatan wajib dipilih.'
                );
        }

        // ==============================
        // CEK KORSDA
        // ==============================

        $korsda = $this->korsdaModel->find($korsdaId);

        if (!$korsda) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }

        // ==============================
        // CEK PROFIL SUDAH ADA
        // ==============================

        $profilLama = $this->profilModel
            ->where('korsda_id', $korsdaId)
            ->first();

        if ($profilLama) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Profil untuk KORSDA tersebut sudah ada.'
                );
        }

        // ==============================
        // UPLOAD STRUKTUR
        // ==============================

        $struktur = $this->request->getFile('struktur_organisasi');

        $namaStruktur = null;

        if ($struktur && $struktur->isValid() && !$struktur->hasMoved()) {

            $namaStruktur = $struktur->getRandomName();

            $struktur->move(
                FCPATH . 'uploads/korsda',
                $namaStruktur
            );
        }

        // ==============================
        // DATA
        // ==============================

        $data = [
            'korsda_id'          => $korsdaId,
            'visi'               => $this->request->getPost('visi'),
            'misi'               => $this->request->getPost('misi'),
            'tugas'              => $this->request->getPost('tugas'),
            'fungsi'             => $this->request->getPost('fungsi'),
            'struktur_organisasi'=> $namaStruktur,
            'deskripsi'          => $this->request->getPost('deskripsi'),
        ];

        // ==============================
        // SIMPAN
        // ==============================

        if (!$this->profilModel->insert($data)) {

            // Hapus file kalau database gagal
            if ($namaStruktur && file_exists(
                FCPATH . 'uploads/korsda/' . $namaStruktur
            )) {
                unlink(
                    FCPATH . 'uploads/korsda/' . $namaStruktur
                );
            }

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->profilModel->errors()
                );
        }

        return redirect()
            ->to(base_url('admin/korsda/profil_korsda'))
            ->with(
                'success',
                'Profil KORSDA berhasil ditambahkan.'
            );
    }

    public function edit($id)
    {
        $profil = $this->profilModel->find($id);

        if (!$profil) {
            return redirect()
                ->to(
                    base_url(
                        'admin/korsda/profil_korsda'
                    )
                )
                ->with(
                    'error',
                    'Data Profil KORSDA tidak ditemukan.'
                );
        }


        $korsda = $this->korsdaModel->findAll();


        return view(
            'Admin/korsda/profil_korsda/edit',
            [
                'title'  => 'Edit Profil KORSDA',
                'profil' => $profil,
                'korsda' => $korsda,
            ]
        );
    }


    /**
     * =========================================================
     * UPDATE
     * =========================================================
     */
    public function update($id)
    {
        $profil = $this->profilModel->find($id);

        if (!$profil) {
            return redirect()
                ->to(
                    base_url(
                        'admin/korsda/profil_korsda'
                    )
                )
                ->with(
                    'error',
                    'Data Profil KORSDA tidak ditemukan.'
                );
        }


        $korsdaId = $this->request->getPost('korsda_id');


        // Validasi KORSDA
        if (empty($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA / Kecamatan wajib dipilih.'
                );
        }


        // Pastikan KORSDA ada
        if (!$this->korsdaModel->find($korsdaId)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data KORSDA tidak ditemukan.'
                );
        }


        // Cek apakah KORSDA sudah digunakan profil lain
        $profilLain = $this->profilModel
            ->where('korsda_id', $korsdaId)
            ->where('id !=', $id)
            ->first();

        if ($profilLain) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'KORSDA tersebut sudah memiliki profil.'
                );
        }


        // File lama
        $namaFile = $profil['struktur_organisasi'] ?? null;


        // Upload file baru
        $file = $this->request->getFile(
            'struktur_organisasi'
        );

        if (
            $file &&
            $file->isValid() &&
            !$file->hasMoved()
        ) {

            $folder = FCPATH . 'uploads/korsda';

            if (!is_dir($folder)) {
                mkdir(
                    $folder,
                    0777,
                    true
                );
            }

            $fileBaru = $file->getRandomName();

            $file->move(
                $folder,
                $fileBaru
            );


            // Hapus file lama
            if (
                $namaFile &&
                file_exists(
                    $folder . DIRECTORY_SEPARATOR . $namaFile
                )
            ) {
                unlink(
                    $folder . DIRECTORY_SEPARATOR . $namaFile
                );
            }


            $namaFile = $fileBaru;
        }


        // Data update
        $data = [
            'korsda_id'           => $korsdaId,
            'visi'                => $this->request->getPost('visi'),
            'misi'                => $this->request->getPost('misi'),
            'tugas'               => $this->request->getPost('tugas'),
            'fungsi'              => $this->request->getPost('fungsi'),
            'struktur_organisasi' => $namaFile,
            'deskripsi'           => $this->request->getPost('deskripsi'),
        ];


        if (!$this->profilModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->profilModel->errors()
                );
        }


        return redirect()
            ->to(
                base_url(
                    'admin/korsda/profil_korsda'
                )
            )
            ->with(
                'success',
                'Profil KORSDA berhasil diperbarui.'
            );
    }


    /**
     * =========================================================
     * DELETE
     * =========================================================
     */
    public function delete($id)
    {
        $profil = $this->profilModel->find($id);

        if (!$profil) {
            return redirect()
                ->to(
                    base_url(
                        'admin/korsda/profil_korsda'
                    )
                )
                ->with(
                    'error',
                    'Data Profil KORSDA tidak ditemukan.'
                );
        }


        // Hapus file struktur
        if (!empty($profil['struktur_organisasi'])) {

            $file = FCPATH .
                'uploads/korsda/' .
                $profil['struktur_organisasi'];

            if (file_exists($file)) {
                unlink($file);
            }
        }


        // Hapus database
        $this->profilModel->delete($id);


        return redirect()
            ->to(
                base_url(
                    'admin/korsda/profil_korsda'
                )
            )
            ->with(
                'success',
                'Profil KORSDA berhasil dihapus.'
            );
    }

}