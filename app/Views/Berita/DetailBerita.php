<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/berita.css') ?>">

<section class="detailberita-page">
    <div class="container py-5">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('berita') ?>">Berita</a>
                </li>

                <li class="breadcrumb-item active">
                    Detail Berita
                </li>
            </ol>
        </nav>

        <!-- Header Berita -->
        <div class="card berita-card border-0 mb-5">

            <div class="row g-4 align-items-center">

                <div class="col-lg-4">

                    <img
                        src="<?= base_url('uploads/berita/' . $berita['gambar']) ?>"
                        class="img-fluid rounded-3 berita-img"
                        alt="<?= esc($berita['judul']) ?>">

                </div>

                <div class="col-lg-8">

                    <div class="card-body p-0">

                        <h2 class="berita-title">
                            <?= esc($berita['judul']) ?>
                        </h2>

                        <div class="d-flex align-items-center gap-4 flex-wrap mt-3">

                            <!-- Tanggal -->
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-event me-2"></i>

                                <span>
                                    <?= date('d F Y', strtotime($berita['created_at'])) ?>
                                </span>
                            </div>

                            <!-- Publikator -->
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person me-2"></i>

                                <span>
                                    <?= esc($berita['publikator']) ?>
                                </span>
                            </div>

                            <!-- Views -->
                            <div class="d-flex align-items-center">
                                <i class="bi bi-eye me-2"></i>

                                <span>
                                    <?= $berita['views'] ?> kali dibaca
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Isi Berita -->

        <div class="berita-content">

            <?= nl2br(esc($berita['isi'])) ?>

        </div>

        
        <button
            type="button"
            class="btn btn-primary btn-kembali-detail"
            onclick="window.location.href='<?= base_url('berita') ?>'">

            <i class="bi bi-arrow-left me-2"></i>

            Kembali

        </button>

    </div>

</section>

<?= $this->include('layout/footer') ?>