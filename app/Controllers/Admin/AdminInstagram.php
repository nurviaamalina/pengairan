<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstagramModel;

class AdminInstagram extends BaseController
{
    protected $instagramModel;

    public function __construct()
    {
        $this->instagramModel = new InstagramModel();
        helper(['form', 'text']);
    }

    /*
    |--------------------------------------------------------------------------
    | LIST DATA
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        if ($keyword) {
            $instagram = $this->instagramModel
                ->like('judul', $keyword)
                ->orLike('caption', $keyword)
                ->orderBy('tanggal_post', 'DESC')
                ->paginate(10);
        } else {
            $instagram = $this->instagramModel
                ->orderBy('tanggal_post', 'DESC')
                ->paginate(10);
        }

        $data = [
            'title'     => 'Feed Instagram',
            'instagram' => $instagram,
            'pager'     => $this->instagramModel->pager,
            'keyword'   => $keyword
        ];

        return view('Admin/InstagramAdmin/index', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $data = [
            'title'      => 'Tambah Feed Instagram',
            'validation' => \Config\Services::validation()
        ];

        return view('Admin/InstagramAdmin/create', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        if (!$this->validate([

            'judul' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Judul wajib diisi.'
                ]
            ],

            'caption' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Caption wajib diisi.'
                ]
            ],

            'instagram_url' => [
                'rules' => 'required|valid_url',
                'errors' => [
                    'required'  => 'Link Instagram wajib diisi.',
                    'valid_url' => 'Link tidak valid.'
                ]
            ],

            'tanggal_post' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal wajib diisi.'
                ]
            ],

            'thumbnail' => [
                'rules' => 'uploaded[thumbnail]|max_size[thumbnail,4096]|is_image[thumbnail]|mime_in[thumbnail,image/png,image/jpg,image/jpeg,image/webp]',
                'errors' => [
                    'uploaded' => 'Thumbnail wajib dipilih.',
                    'max_size' => 'Ukuran maksimal 4 MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format gambar tidak didukung.'
                ]
            ]

        ])) {

            return redirect()->back()->withInput();

        }

        $gambar = $this->request->getFile('thumbnail');

        $namaBaru = $gambar->getRandomName();

        $gambar->move('uploads/instagram', $namaBaru);

        $this->instagramModel->save([

            'judul'         => $this->request->getPost('judul'),
            'caption'       => $this->request->getPost('caption'),
            'instagram_url' => $this->request->getPost('instagram_url'),
            'tanggal_post'  => $this->request->getPost('tanggal_post'),
            'thumbnail'     => $namaBaru

        ]);

        return redirect()
            ->to(base_url('admin/instagram'))
            ->with('success', 'Feed Instagram berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | FORM EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $instagram = $this->instagramModel->find($id);

        if (!$instagram) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [

            'title'      => 'Edit Feed Instagram',
            'instagram'  => $instagram,
            'validation' => \Config\Services::validation()

        ];

        return view('Admin/InstagramAdmin/edit', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $instagram = $this->instagramModel->find($id);

        if (!$instagram) {

            return redirect()->to(base_url('admin/instagram'));

        }

        $gambar = $this->request->getFile('thumbnail');

        if ($gambar->getError() == 4) {

            $namaBaru = $instagram['thumbnail'];

        } else {

            $namaBaru = $gambar->getRandomName();

            $gambar->move('uploads/instagram', $namaBaru);

            if (
                !empty($instagram['thumbnail']) &&
                file_exists('uploads/instagram/' . $instagram['thumbnail'])
            ) {

                unlink('uploads/instagram/' . $instagram['thumbnail']);

            }

        }

        $this->instagramModel->update($id, [

            'judul'         => $this->request->getPost('judul'),
            'caption'       => $this->request->getPost('caption'),
            'instagram_url' => $this->request->getPost('instagram_url'),
            'tanggal_post'  => $this->request->getPost('tanggal_post'),
            'thumbnail'     => $namaBaru

        ]);

        return redirect()
            ->to(base_url('admin/instagram'))
            ->with('success', 'Feed Instagram berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $instagram = $this->instagramModel->find($id);

        if (!$instagram) {

            return redirect()->to(base_url('admin/instagram'));

        }

        if (
            !empty($instagram['thumbnail']) &&
            file_exists('uploads/instagram/' . $instagram['thumbnail'])
        ) {

            unlink('uploads/instagram/' . $instagram['thumbnail']);

        }

        $this->instagramModel->delete($id);

        return redirect()
            ->to(base_url('admin/instagram'))
            ->with('success', 'Feed Instagram berhasil dihapus.');
    }


    public function sync()
{
    $syncUrl = base_url('instagram-sync');

    $client = \Config\Services::curlrequest([
        'timeout' => 60,
    ]);

    try {

        $response = $client->get($syncUrl);

        $result = json_decode(
            $response->getBody(),
            true
        );

        if (!empty($result['status'])) {

            return redirect()
                ->back()
                ->with(
                    'success',
                    'Sinkronisasi berhasil. ' .
                    'Data baru: ' . ($result['posting_baru'] ?? 0) .
                    ', diperbarui: ' . ($result['posting_update'] ?? 0)
                );
        }

        return redirect()
            ->back()
            ->with(
                'error',
                $result['message'] ?? 'Sinkronisasi gagal.'
            );

    } catch (\Throwable $e) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Gagal melakukan sinkronisasi Instagram: '
                . $e->getMessage()
            );
    }
}
}