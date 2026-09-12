<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<!-- Satu Section Pembungkus Utama -->
<section class="kegiatan-page pt-3 pb-5">

    <div class="container">

        <!-- Breadcrumb rapat di atas -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none text-muted">Beranda</a>
                </li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">
                    Kegiatan
                </li>
            </ol>
        </nav>

        <!-- Judul & Deskripsi -->
        <div class="hero-indexkegiatan mb-4">
            <h1 class="fw-bold text-navy mb-2">Recap Kegiatan Dinas Pengairan</h1>
            <p class="text-muted mb-0">
                Pilih tahun untuk melihat seluruh kegiatan Dinas Pengairan Kabupaten Banyuwangi.
            </p>
        </div>

        <!-- Grid Cards Tahun -->
        <div class="row g-4">
            <?php foreach ($tahun as $item): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="<?= base_url('kegiatan/tahun/'.$item['tahun']) ?>" class="tahun-card">
                        <img src="<?= base_url('uploads/kegiatan/thumbnail/'.$item['thumbnail']) ?>" alt="<?= esc($item['tahun']) ?>">
                        <div class="overlay">
                            <h5><?= esc($item['tahun']) ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-start mt-4">
            <a href="<?= base_url('/') ?>" class="btn btn-kembali">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>