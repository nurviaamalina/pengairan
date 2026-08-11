<?php

namespace App\Controllers;

use App\Models\InstagramModel;

class Instagram extends BaseController
{
    public function index()
    {
        $model = new InstagramModel();

        // =====================================================
        // AMBIL 50 POSTING TERBARU SAJA
        // =====================================================

        $allPosts = $model
            ->orderBy('posted_at', 'DESC')
            ->findAll(50);


        // =====================================================
        // HALAMAN AKTIF
        // =====================================================

        $page = (int) ($this->request->getGet('page') ?? 1);

        if ($page < 1) {
            $page = 1;
        }


        // =====================================================
        // 10 POSTING PER HALAMAN
        // =====================================================

        $perPage = 12;


        // =====================================================
        // TOTAL POSTING YANG DITAMPILKAN
        // MAKSIMAL 50
        // =====================================================

        $totalPosts = count($allPosts);


        // =====================================================
        // TOTAL HALAMAN
        // 50 / 10 = 5 HALAMAN
        // =====================================================

        $totalPages = (int) ceil(
            $totalPosts / $perPage
        );


        // =====================================================
        // PENGAMAN JIKA PAGE MELEBIHI HALAMAN TERAKHIR
        // =====================================================

        if ($totalPages > 0 && $page > $totalPages) {
            $page = $totalPages;
        }


        // =====================================================
        // HITUNG OFFSET
        // =====================================================

        $offset = ($page - 1) * $perPage;


        // =====================================================
        // AMBIL 10 POSTING UNTUK HALAMAN AKTIF
        // =====================================================

        $instagram = array_slice(
            $allPosts,
            $offset,
            $perPage
        );


        // =====================================================
        // DATA UNTUK VIEW
        // =====================================================

        $data = [
            'instagram'   => $instagram,
            'currentPage' => $page,
            'totalPages'  => $totalPages,
            'totalPosts'  => $totalPosts,
        ];


        // =====================================================
        // TAMPILKAN VIEW
        // =====================================================

        return view('Instagram/index', $data);
    }
}