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

                <div class="col-lg-4 col-md-6">

                    <div class="instagram-card">

                        <a href="<?= esc($item['instagram_url']) ?>" target="_blank">

                            <img
                                src="<?= base_url('uploads/instagram/' . $item['thumbnail']) ?>"
                                class="img-fluid">

                        </a>

                        <div class="p-3">

                            <h5>

                                <?= esc($item['judul']) ?>

                            </h5>

                            <p>

                                <?= character_limiter(strip_tags($item['caption']),100) ?>

                            </p>

                            <small>

                                <?= date('d F Y', strtotime($item['tanggal_post'])) ?>

                            </small>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="mt-5 d-flex justify-content-center">

            <?= $pager->links() ?>

        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>