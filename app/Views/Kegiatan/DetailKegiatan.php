<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<section class="container py-5">
    <div class="container py-5">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('berita') ?>">Kegiatan</a>
                </li>

                <li class="breadcrumb-item active">
                    Detail Kegiatan
                </li>
            </ol>
        </nav>

    <h2 class="text-center fw-bold">

        <?= esc($kegiatan['judul']) ?>

    </h2>

    <p class="text-center text-muted">

        <?= date('d F Y', strtotime($kegiatan['tanggal'])) ?>

    </p>

    <div class="text-center my-5">

    <img
        src="<?= base_url('uploads/kegiatan/thumbnail/'.$kegiatan['thumbnail']) ?>"
        class="img-fluid rounded shadow">

</div>

<div class="row justify-content-center">

    <div class="col-lg-10">

        <?= nl2br(esc($kegiatan['deskripsi'])) ?>

    </div>

</div>

<hr class="my-5">

<h3 class="text-center mb-4">

Dokumentasi

</h3>

<div class="row g-4">

<?php foreach($foto as $item): ?>

    <div class="col-lg-4 col-md-6">

        <img
            src="<?= base_url('uploads/kegiatan/dokumentasi/'.$item['foto']) ?>"
            class="img-fluid rounded shadow-sm">

    </div>

<?php endforeach; ?>

</div>

 <button
            type="button"
            class="btn btn-primary btn-kembali"
            onclick="window.location.href='<?= base_url('/') ?>'">

            <i class="bi bi-arrow-left me-2"></i>
            Kembali

        </button>

</section>

<?= $this->include('layout/footer') ?>