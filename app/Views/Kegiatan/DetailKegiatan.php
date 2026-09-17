<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<section class="detail-kegiatan-page">

    <!-- ==========================================
         THUMBNAIL / HERO KEGIATAN
         ========================================== -->
    <div class="detail-hero">

        <?php
        $thumbnail = !empty($kegiatan['thumbnail'])
            ? base_url('uploads/kegiatan/thumbnail/' . $kegiatan['thumbnail'])
            : base_url('assets/img/default-kegiatan.jpg');
        ?>

        <img src="<?= $thumbnail ?>"
             alt="<?= esc($kegiatan['judul']) ?>"
             class="detail-hero-image">

        <!-- ======================================
             BREADCRUMB DI ATAS FOTO
             ====================================== -->
        <nav class="detail-breadcrumb" aria-label="breadcrumb">

            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">
                        Beranda
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('kegiatan') ?>">
                        Kegiatan
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    <?= esc($kegiatan['judul']) ?>
                </li>

            </ol>

        </nav>

    </div>


    <!-- ==========================================
         INFORMASI KEGIATAN
         ========================================== -->
    <div class="detail-info">

        <!-- JUDUL -->
        <h1 class="detail-title">
            <?= esc($kegiatan['judul']) ?>
        </h1>

        <!-- TANGGAL -->
        <div class="detail-date">

            <i class="bi bi-calendar3"></i>

            <span>
                <?= date(
                    'd F Y',
                    strtotime($kegiatan['created_at'] ?? $kegiatan['tanggal'])
                ) ?>
            </span>

        </div>

    </div>


    <!-- ==========================================
         PEMBATAS
         ========================================== -->
    <div class="detail-divider"></div>


    <!-- ==========================================
         DOKUMENTASI
         ========================================== -->
    <?php if (!empty($foto)) : ?>

        <section class="detail-dokumentasi">

            <h2 class="dokumentasi-title">
                Dokumentasi Kegiatan
            </h2>

            <div class="dokumentasi-grid">

                <?php foreach ($foto as $item) : ?>

                    <div class="dokumentasi-item">

                        <img
                            src="<?= base_url('uploads/kegiatan/dokumentasi/' . $item['foto']) ?>"
                            alt="Dokumentasi <?= esc($kegiatan['judul']) ?>"
                        >

                    </div>

                <?php endforeach; ?>

            </div>

        </section>

    <?php endif; ?>


    <!-- ==========================================
         TOMBOL KEMBALI
         ========================================== -->
    <div class="container my-4">
        <div class="detail-back">

            <a href="javascript:history.back()" class="btn-kembali">

                <i class="bi bi-arrow-left"></i>

                <span>Kembali</span>

            </a>

        </div>
    </div>

</section>

<?= $this->include('layout/footer') ?>