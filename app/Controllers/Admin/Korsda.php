<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KorsdaModel;

class Korsda extends BaseController
{
    protected $korsda;

    public function __construct()
    {
        $this->korsda = new KorsdaModel();
    }

    // Menampilkan data
    public function index()
    {
        $data = [
            'korsda' => $this->korsda->findAll()
        ];

        return view('Admin/korsda/index', $data);
    }

    // Form tambah
    public function create()
    {
        return view('Admin/korsda/create');
    }

    // Simpan data
    public function store()
{
    $rules = [
        'nama_kecamatan' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Kecamatan wajib dipilih.'
            ]
        ],

        'ketua' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Ketua wajib diisi.'
            ]
        ],

        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat wajib diisi.'
            ]
        ],

        'telepon' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nomor Telepon wajib diisi.'
            ]
        ],

        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi wajib diisi.'
            ]
        ],

        'gambar' => [
            'rules' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]',
            'errors' => [
                'uploaded' => 'Gambar wajib diupload.',
                'is_image' => 'File yang dipilih harus berupa gambar.',
                'max_size' => 'Ukuran gambar maksimal 2 MB.'
            ]
        ],
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $this->validator->getErrors());
    }

    $file = $this->request->getFile('gambar');

    $namaGambar = $file->getRandomName();

    $file->move(FCPATH . 'uploads/korsda', $namaGambar);

    $this->korsda->save([
        'nama_kecamatan' => $this->request->getPost('nama_kecamatan'),
        'ketua'          => $this->request->getPost('ketua'),
        'alamat'         => $this->request->getPost('alamat'),
        'telepon'        => $this->request->getPost('telepon'),
        'deskripsi'      => $this->request->getPost('deskripsi'),
        'gambar'         => $namaGambar,
    ]);

    return redirect()->to(base_url('admin/korsda'))
        ->with('success', 'Data KORSDA berhasil ditambahkan.');
}
    // Form edit
    public function edit($id)
    {
        $data['korsda'] = $this->korsda->find($id);

        if (!$data['korsda']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('Admin/korsda/edit', $data);
    }

    // Update data
    public function update($id)
    {
        $dataLama = $this->korsda->find($id);

        $gambar = $this->request->getFile('gambar');

        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {

            if (!empty($dataLama['gambar']) && file_exists(FCPATH . 'uploads/korsda/' . $dataLama['gambar'])) {

                unlink(FCPATH . 'uploads/korsda/' . $dataLama['gambar']);
            }

            $namaGambar = $gambar->getRandomName();

            $gambar->move(FCPATH . 'uploads/korsda', $namaGambar);

        } else {

            $namaGambar = $dataLama['gambar'];
        }

        $this->korsda->update($id, [

            'nama_kecamatan' => $this->request->getPost('nama_kecamatan'),
            'ketua'          => $this->request->getPost('ketua'),
            'alamat'         => $this->request->getPost('alamat'),
            'telepon'        => $this->request->getPost('telepon'),
            'deskripsi'      => $this->request->getPost('deskripsi'),
            'gambar'         => $namaGambar,

        ]);

        return redirect()->to('/admin/korsda')
            ->with('success', 'Data KORSDA berhasil diupdate.');
    }

    // Hapus data
    public function delete($id)
    {
        $korsda = $this->korsda->find($id);

        if (!$korsda) {

            return redirect()->to('/admin/korsda');
        }

        if (!empty($korsda['gambar']) && file_exists(FCPATH . 'uploads/korsda/' . $korsda['gambar'])) {

            unlink(FCPATH . 'uploads/korsda/' . $korsda['gambar']);
        }

        $this->korsda->delete($id);

        return redirect()->to('/admin/korsda')
            ->with('success', 'Data KORSDA berhasil dihapus.');
    }
}