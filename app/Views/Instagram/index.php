<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/instagram.css') ?>">

<section class="berita-page">

    <div class="container py-5">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>

                <li class="breadcrumb-item active">
                    Feed Instagram
                </li>

            </ol>
        </nav>

    </div>

</section>

<!-- ==========================================
                HERO INSTAGRAM
=========================================== -->

<section class="hero-instagram">

    <div class="hero-bg"></div>

    <div class="container">

        <div class="row align-items-center g-5">

            <!-- ================= LEFT ================= -->

            <div class="col-lg-6">

                <span class="hero-label">

                    Instagram

                    <span>Pengairan</span>

                </span>

                <h1 class="hero-title">

                    Ikuti Aktivitas

                    <br>

                    Dinas Pengairan

                </h1>

                <p class="hero-desc">

                    Dapatkan informasi terbaru mengenai kegiatan,
                    pembangunan, pemeliharaan jaringan irigasi,
                    serta berbagai aktivitas Dinas Pengairan
                    Kabupaten Banyuwangi melalui akun Instagram resmi kami.

                </p>

                <a href="https://www.instagram.com/dinas_pengairan.bwi?igsh=MXNwZHg0bjA3NGczdw=="
                    target="_blank"
                    class="btn-instagram">

                    <i class="bi bi-instagram"></i>

                    Kunjungi Instagram

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>

            <!-- ================= RIGHT ================= -->

            <div class="col-lg-6 text-center position-relative">

                <div class="hero-phone-wrapper">

                    <div class="circle"></div>

                    <img src="<?= base_url('assets/images/akun.png') ?>"
                        class="phone-img"
                        alt="Instagram">

                    <img src="<?= base_url('assets/images/logoinstagram.png') ?>"
                        class="ig-logo"
                        alt="Instagram Logo">

                </div>

            </div>

        </div>

    </div>

</section>

<!-- FEED -->

<section class="instagram-feed py-5">

   <div class="container">

   <div class="row g-4">

    <?php foreach ($instagram as $item) : ?>

        <?php
            // URL posting Instagram
            $instagramUrl = !empty($item['permalink'])
                ? $item['permalink']
                : ($item['instagram_url'] ?? '#');

            // Tentukan gambar preview
            $mediaType = strtoupper($item['media_type'] ?? 'IMAGE');

            if ($mediaType === 'VIDEO') {
                // REELS / VIDEO menggunakan thumbnail
                $imageUrl = $item['thumbnail_url'] ?? null;
            } else {
                // FOTO menggunakan media_url
                $imageUrl = $item['media_url'] ?? null;
            }

            // Tanggal
            $tanggal = !empty($item['posted_at'])
                ? $item['posted_at']
                : ($item['tanggal_post'] ?? null);
        ?>
        
        <div class="col-lg-4 col-md-6">

            <!-- SELURUH CARD MENJADI LINK -->
            <a
                href="<?= esc($instagramUrl, 'attr') ?>"
                target="_blank"
                rel="noopener noreferrer"
                class="instagram-card-link"
            >

                <div class="instagram-card">

                    <!-- GAMBAR -->

                    <div class="instagram-image">

                        <?php if (!empty($imageUrl)) : ?>

                            <img
                                src="<?= esc($imageUrl, 'attr') ?>"
                                alt="<?= esc($item['judul']) ?>"
                                loading="lazy"
                            >

                        <?php else : ?>

                            <div class="instagram-image-empty">

                                <i class="bi bi-instagram"></i>

                                <span>
                                    Gambar tidak tersedia
                                </span>

                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- ISI CARD -->

                    <div class="p-3">

                        <h5>
                            <?= esc($item['judul']) ?>
                        </h5>

                        <p>
                            <?= character_limiter(
                                strip_tags($item['caption'] ?? ''),
                                100
                            ) ?>
                        </p>

                        <?php if (!empty($tanggal)) : ?>

                            <small>
                                <?= date(
                                    'd F Y',
                                    strtotime($tanggal)
                                ) ?>
                            </small>

                        <?php endif; ?>

                    </div>

                </div>

            </a>

        </div>

    <?php endforeach; ?>

</div>


    <!-- PAGINATION -->

    <?php if (isset($totalPages) && $totalPages > 1) : ?>

        <div class="d-flex justify-content-center mt-5">

            <nav aria-label="Pagination Instagram">

                <ul class="pagination">

                    <?php if ($currentPage > 1) : ?>

                        <li class="page-item">

                            <a
                                class="page-link"
                                href="<?= base_url(
                                    'instagram?page=' . ($currentPage - 1)
                                ) ?>"
                            >
                                &laquo;
                            </a>

                        </li>

                    <?php endif; ?>


                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>

                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">

                            <a
                                class="page-link"
                                href="<?= base_url(
                                    'instagram?page=' . $i
                                ) ?>"
                            >
                                <?= $i ?>
                            </a>

                        </li>

                    <?php endfor; ?>


                    <?php if ($currentPage < $totalPages) : ?>

                        <li class="page-item">

                            <a
                                class="page-link"
                                href="<?= base_url(
                                    'instagram?page=' . ($currentPage + 1)
                                ) ?>"
                            >
                                &raquo;
                            </a>

                        </li>

                    <?php endif; ?>

                </ul>

            </nav>

        </div>

    <?php endif; ?>

</div>

</section>

<?= $this->include('layout/footer') ?>