<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WilayahKerjaModel;
use App\Models\KorsdaModel;

class PetaKorsda extends BaseController
{
    protected $wilayahModel;
    protected $korsdaModel;

    public function __construct()
    {
        $this->wilayahModel = new WilayahKerjaModel();
        $this->korsdaModel  = new KorsdaModel();
    }

    public function index()
    {
        $data['wilayah'] = $this->wilayahModel
            ->select('wilayah_kerja.*, korsda.nama_kecamatan')
            ->join('korsda', 'korsda.id = wilayah_kerja.id_korsda')
            ->findAll();

        return view('admin/korsda/peta/index', $data);
    }

    public function create()
    {
        $data['korsda'] = $this->korsdaModel->findAll();

        return view('admin/korsda/peta/create', $data);
    }

    public function store()
    {
        $this->wilayahModel->save([
            'id_korsda'   => $this->request->getPost('id_korsda'),
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'latitude'    => $this->request->getPost('latitude'),
            'longitude'   => $this->request->getPost('longitude'),
            'zoom'        => $this->request->getPost('zoom'),
            'keterangan'  => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/admin/wilayah')->with('success','Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data['wilayah'] = $this->wilayahModel->find($id);
        $data['korsda']  = $this->korsdaModel->findAll();

        return view('admin/korsda/peta/edit',$data);
    }

    public function update($id)
    {
        $this->wilayahModel->update($id,[
            'id_korsda'   => $this->request->getPost('id_korsda'),
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
            'latitude'    => $this->request->getPost('latitude'),
            'longitude'   => $this->request->getPost('longitude'),
            'zoom'        => $this->request->getPost('zoom'),
            'keterangan'  => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/admin/wilayah')->with('success','Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->wilayahModel->delete($id);

        return redirect()->to('/admin/wilayah')->with('success','Data berhasil dihapus');
    }
}