<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/berita.css') ?>">

<section class="berita-page pt-3 pb-5">
    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>" class="text-decoration-none text-muted">Beranda</a>
                </li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">
                    Berita
                </li>
            </ol>
        </nav>

        <!-- Judul Halaman -->
        <h1 class="judul-beritaPage fw-bold text-navy mb-4">Berita Terbaru</h1>

        <?php if (!empty($berita)) : ?>

            <!-- Headline -->
            <div class="row g-4 mb-5">
                <?php
                $headline = array_slice($berita, 0, 2);
                foreach ($headline as $item) :
                ?>
                    <div class="col-lg-6">
                        <a href="<?= base_url('berita/' . $item['slug']) ?>" class="headline-card">
                            <img src="<?= base_url('uploads/berita/' . $item['gambar']) ?>" alt="">
                            <div class="overlay">
                                <h4><?= esc($item['judul']) ?></h4>
                                <span>
                                    <?= date('d F Y', strtotime($item['created_at'])) ?>
                                </span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- List Berita -->
            <?php foreach ($berita as $item) : ?>
                <a href="<?= base_url('berita/' . $item['slug']) ?>" class="text-decoration-none text-dark">
                    <div class="row g-4 align-items-center mb-4">
                        <div class="col-lg-4">
                            <img src="<?= base_url('uploads/berita/' . $item['gambar']) ?>"
                                 class="img-fluid rounded-3 berita-img"
                                 alt="<?= esc($item['judul']) ?>">
                        </div>
                        <div class="col-lg-8">
                            <div class="card-body p-0">
                                <h2 class="berita-title">
                                    <?= esc($item['judul']) ?>
                                </h2>
                                <p class="berita-date">
                                    <?= date('d F Y', strtotime($item['created_at'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>

        <?php else : ?>

            <div class="alert alert-warning">
                Belum ada berita.
            </div>

        <?php endif; ?>

        <!-- Tombol Kembali (Disamakan dengan Halaman Kegiatan) -->
        <div class="d-flex justify-content-start mt-5">
            <a href="<?= base_url('/') ?>" class="btn btn-kembali">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
        </div>

    </div>
</section>

<?= $this->include('layout/footer') ?>