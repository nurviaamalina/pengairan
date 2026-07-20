<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/berita.css') ?>">

<section class="berita-page">
    <div class="container py-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Berita
                </li>
            </ol>
        </nav>

        <h1 class="judul-beritaPage mb-5">Berita Terbaru</h1>

        <!-- Headline -->
        <div class="row g-4 mb-5">

            <div class="col-lg-6">
                <a href="<?= base_url('berita/detail') ?>" class="headline-card">
                    <img src="<?= base_url('assets/images/berita1.png') ?>" alt="Berita">
                    <div class="overlay">
                        <h4>Dinas PU Pengairan Ajak Siswa SDN Bersih-bersih Sungai</h4>
                        <span>Senin, 13 Juli 2026</span>
                    </div>
                </a>
            </div>

            <div class="col-lg-6">
                <a href="<?= base_url('berita/detail') ?>" class="headline-card">
                    <img src="<?= base_url('assets/images/berita1.png') ?>" alt="Berita">
                    <div class="overlay">
                        <h4>Dinas PU Pengairan Ajak Siswa SDN Bersih-bersih Sungai</h4>
                        <span>Senin, 13 Juli 2026</span>
                    </div>
                </a>
            </div>

        </div>

        <!-- List Berita -->
        <a href="<?= base_url('berita/detail') ?>" class="text-decoration-none text-dark">

            <div class="row g-4 align-items-center">

                    <div class="col-lg-4">

                        <img src="<?= base_url('assets/images/berita1.png') ?>"
                            class="img-fluid rounded-3 berita-img"
                            alt="Berita">

                    </div>

                    <div class="col-lg-8">

                        <div class="card-body p-0">

                            <h2 class="card-title berita-title">
                                Dinas Pengairan Kabupaten Banyuwangi Perkuat Transformasi Digital Melalui Pengembangan Website Terintegrasi
                            </h2>

                            <p class="berita-date">
                                Senin, 13 Juli 2026
                            </p>

                        </div>

                     </div>
            </div>
        </a>

    </div>

</div>

         <button
            type="button"
            class="btn btn-primary btn-kembali"
            onclick="window.location.href='<?= base_url('/') ?>'">

            <i class="bi bi-arrow-left me-2"></i>
            Kembali

        </button>

    </div>
</section>

<?= $this->include('layout/footer') ?>