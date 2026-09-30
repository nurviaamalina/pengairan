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
        <div class="row g-4 mb-5">
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

        <!-- SECTION DAFTAR KEGIATAN KORSDA TERBARU -->
        <div class="korsda-section mt-5 pt-4 border-top">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold text-navy mb-1">Kegiatan Korsda Terbaru</h3>
                    <p class="text-muted small mb-0">Dokumentasi kegiatan Koordinator Wilayah Sumber Daya Air di lapangan.</p>
                </div>
            </div>

            <!-- Grid Cards Kegiatan Korsda (Persis Tampilan card-kegiatan) -->
            <div class="row g-4">
                <?php if (!empty($kegiatanKorsda)) : ?>

                    <?php foreach ($kegiatanKorsda as $korsda) : ?>

                        <div class="col-lg-4 col-md-6">

                            <a href="<?= base_url('korsda/detail_kegiatan/' . $korsda['id']) ?>" class="card-kegiatan">

                                <?php 
                                    $gambar = $korsda['gambar'] ?? '';

                                    // Path fisik server berdasarkan struktur admin
                                    $pathBaru = FCPATH . 'uploads/Kegiatan/thumbnail/' . $gambar;
                                    $pathLama = FCPATH . 'uploads/kegiatan/' . $gambar;

                                    // Tentukan URL gambar
                                    if (!empty($gambar) && file_exists($pathBaru)) {
                                        $imgSrc = base_url('uploads/Kegiatan/thumbnail/' . $gambar);
                                    } elseif (!empty($gambar) && file_exists($pathLama)) {
                                        $imgSrc = base_url('uploads/kegiatan/' . $gambar);
                                    } elseif (!empty($gambar) && file_exists(FCPATH . 'uploads/kegiatankorsda/' . $gambar)) {
                                        $imgSrc = base_url('uploads/kegiatankorsda/' . $gambar);
                                    } else {
                                        $imgSrc = base_url('assets/img/no-image.png');
                                    }
                                ?>

                                <img src="<?= $imgSrc ?>" alt="<?= esc($korsda['judul'] ?? 'Kegiatan Korsda') ?>">

                                <div class="overlay">
                                    <h6><?= esc($korsda['judul'] ?? '') ?></h6>
                                    <?php if (!empty($korsda['tanggal'])) : ?>
                                        <span class="tanggal"><?= date('d F Y', strtotime($korsda['tanggal'])) ?></span>
                                    <?php endif; ?>
                                </div>

                            </a>

                        </div>

                    <?php endforeach; ?>

                <?php else : ?>

                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted">
                            Belum ada kegiatan Korsda terbaru
                        </h5>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-start mt-5">
            <a href="<?= base_url('/') ?>" class="btn btn-kembali">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>