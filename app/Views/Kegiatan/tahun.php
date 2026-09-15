<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<section class="kegiatan-page pt-3 pb-5">

    <div class="container">

        <!-- Breadcrumb rapat di atas -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none text-muted">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('kegiatan') ?>" class="text-decoration-none text-muted">Kegiatan</a>
                </li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">
                    Tahun <?= esc($tahun) ?>
                </li>
            </ol>
        </nav>

        <!-- Judul & Deskripsi Header -->
        <div class="hero-indexkegiatan mb-4">
            <h1 class="fw-bold text-navy mb-2">Recap Kegiatan Dinas Pengairan</h1>
            <p class="text-muted mb-0">
                Rangkuman Kegiatan Dinas Pengairan Selama Tahun <?= esc($tahun) ?>.
            </p>
        </div>

        <!-- Grid Cards Kegiatan -->
        <div class="row g-4">

            <?php if (!empty($kegiatan)) : ?>

                <?php foreach ($kegiatan as $item) : ?>

                    <div class="col-lg-4 col-md-6">

                        <a href="<?= base_url('kegiatan/' . $item['slug']) ?>" class="card-kegiatan">

                            <img src="<?= base_url('uploads/kegiatan/thumbnail/' . $item['thumbnail']) ?>"
                                 alt="<?= esc($item['judul']) ?>">

                            <div class="overlay">
                                <h6><?= esc($item['judul']) ?></h6>
                                <?php if (!empty($item['created_at'])) : ?>
                                    <span class="tanggal"><?= date('d F Y', strtotime($item['created_at'])) ?></span>
                                <?php endif; ?>
                            </div>

                        </a>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="col-12 text-center py-5">
                    <h5 class="text-muted">
                        Belum ada kegiatan pada Tahun <?= esc($tahun) ?>
                    </h5>
                </div>

            <?php endif; ?>

        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-start mt-4">
            <a href="<?= base_url('kegiatan') ?>" class="btn btn-kembali">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>