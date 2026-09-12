<?php

namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\KegiatanModel;
use App\Models\KorsdaModel;
use App\Models\DokumenModel;
use App\Models\InstagramModel;
use App\Models\SekardaduModel;
use App\Models\MawasdiriModel;
use App\Models\WarmSystemModel;
use App\Models\LiveCctvModel;

class Search extends BaseController
{
    public function index()
    {
        // Tangkap parameter 'q' atau 'keyword'
        $keyword = trim($this->request->getGet('q') ?? $this->request->getGet('keyword') ?? '');

        $data = [
            'keyword'     => $keyword,
            'berita'      => [],
            'kegiatan'    => [],
            'dokumen'     => [],
            'korsda'      => [],
            'instagram'   => [],
            'sekardadu'   => [],
            'mawasdiri'   => [],
            'warmsystem'  => [],
            'livecctv'    => [],
        ];

        if ($keyword !== '') {
            // 1. Berita
            $data['berita'] = (new BeritaModel())
                ->groupStart()
                    ->like('judul', $keyword)
                    ->orLike('isi', $keyword)
                ->groupEnd()
                ->findAll();

            // 2. Kegiatan
            $data['kegiatan'] = (new KegiatanModel())
                ->groupStart()
                    ->like('judul', $keyword)
                ->groupEnd()
                ->findAll();

            // 3. Dokumen
            $data['dokumen'] = (new DokumenModel())
                ->groupStart()
                    ->like('judul', $keyword)
                    ->orLike('deskripsi', $keyword)
                ->groupEnd()
                ->findAll();

            // 4. Korsda
            $data['korsda'] = (new KorsdaModel())
                ->groupStart()
                    ->like('nama_kecamatan', $keyword)
                    ->orLike('nama', $keyword)
                ->groupEnd()
                ->findAll();

            // 5. Instagram
            $data['instagram'] = (new InstagramModel())
                ->groupStart()
                    ->like('caption', $keyword)
                ->groupEnd()
                ->findAll();

            // 6. Sekardadu (Sesuaikan nama kolom DB)
            $data['sekardadu'] = (new SekardaduModel())
                ->groupStart()
                    ->like('judul', $keyword)
                    ->orLike('deskripsi', $keyword)
                ->groupEnd()
                ->findAll();

            // 7. Mawasdiri (Sesuaikan nama kolom DB)
            $data['mawasdiri'] = (new MawasdiriModel())
                ->groupStart()
                    ->like('judul', $keyword)
                    ->orLike('deskripsi', $keyword)
                ->groupEnd()
                ->findAll();

            // 8. Warm System (Sesuaikan nama kolom DB)
            $data['warmsystem'] = (new WarmSystemModel())
                ->groupStart()
                    ->like('judul', $keyword)
                    ->orLike('lokasi', $keyword)
                ->groupEnd()
                ->findAll();

            // 9. Live CCTV (Sesuaikan nama kolom DB)
            $data['livecctv'] = (new LiveCctvModel())
                ->groupStart()
                    ->like('nama_cctv', $keyword)
                    ->orLike('lokasi', $keyword)
                ->groupEnd()
                ->findAll();
        }

        return view('search/index', $data);
    }
}