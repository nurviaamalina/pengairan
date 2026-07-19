<?= $this->include('layout/navbar') ?>
<?= $this->include('layout/header') ?>

<section class="hero">

    <img src="<?= base_url('assets/images/batik.png') ?>" class="motif">

    <div class="container text-center">

        <h1>

            DINAS PENGAIRAN

            <span>BANYUWANGI</span>

        </h1>

        <p>
            Dinas pengairan berkomitmen untuk mengelola sumber daya air secara
            berkelanjutan demi kesejahteraan masyarakat dan kelestarian lingkungan
        </p>

        <div class="search-box">

            <input
                type="text"
                placeholder="Apa yang perlu anda cari?">

        </div>

        <div class="row justify-content-center mt-5">

       <!-- MENU LAYANAN -->
<section class="layanan-section">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-4 col-md-4 col-6 text-center mb-3">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/sekardadu.png') ?>" alt="">
                    </div>
                    <h5>Sekardadu</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center mb-3">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/mawasdiri.png') ?>" alt="">
                    </div>
                    <h5>Mawasdiri</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center mb-3">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/warmsystem.png') ?>" alt="">
                    </div>
                    <h5>Warm System</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/pengaduan.png') ?>" alt="">
                    </div>
                    <h5>Pengaduan</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/korsda.png') ?>" alt="">
                    </div>
                    <h5>KORSDA</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/cctv.png') ?>" alt="">
                    </div>
                    <h5>Live CCTV</h5>
                </a>

            </div>

        </div>

    </div>

</section>
    </div>
</section>


<!-- BERITA TERBARU -->
<section class="berita-section">

    <img src="<?= base_url('assets/images/batik 2.png') ?>" class="motif-kanan">

    <div class="container">

        <h2 class="judul-berita">
            Berita Terbaru
        </h2>

        <!-- Berita Utama -->
        <div class="berita-utama">

            <img src="<?= base_url('assets/images/berita1.jpg') ?>" alt="">

            <div class="overlay"></div>

        </div>

        <!-- Slider Berita -->
        <div class="slider-berita">

            <button class="slider-btn kiri">
                &#10094;
            </button>

            <div class="berita-item">

                <img src="<?= base_url('assets/images/berita2.jpg') ?>">

            </div>

            <div class="berita-item">

                <img src="<?= base_url('assets/images/berita2.jpg') ?>">

            </div>

            <div class="berita-item">

                <img src="<?= base_url('assets/images/berita2.jpg') ?>">

            </div>

            <button class="slider-btn kanan">
                &#10095;
            </button>

        </div>

        <div class="text-center">

            <a href="#" class="btn-lihat">
                Lihat Semua
            </a>

        </div>

    </div>

</section>
<!-- INFRASTRUKTUR -->
<section class="infrastruktur-section">

    <div class="container">

        <h2 class="judul-infrastruktur">
            Infrastruktur Pengairan Banyuwangi
        </h2>

        <div class="map-container">

            <img src="<?= base_url('assets/images/peta-pengairan.jpg') ?>" alt="Peta Infrastruktur Pengairan">

        </div>

    </div>

</section>

<section class="menu-shortcut">

    <div class="container">

        <div class="row justify-content-center g-4">

            <div class="col-auto">
                <a href="#" class="shortcut-btn"></a>
            </div>

            <div class="col-auto">
                <a href="#" class="shortcut-btn"></a>
            </div>

            <div class="col-auto">
                <a href="#" class="shortcut-btn"></a>
            </div>

            <div class="col-auto">
                <a href="#" class="shortcut-btn"></a>
            </div>

        </div>

    </div>

</section>

<!-- KEGIATAN TERBARU -->
<section class="kegiatan-section">

    <div class="container">

        <h2 class="judul-kegiatan">
            Kegiatan Terbaru
        </h2>

        <!-- Berita Utama -->
        <div class="berita-utama">

            <img src="<?= base_url('assets/images/kegiatan-utama.jpg') ?>" alt="">

            <div class="overlay"></div>

        </div>

        <!-- Slider -->
        <div class="slider-wrapper">

            <button class="slider-arrow left">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div class="row g-3 justify-content-center">

                <div class="col-lg-4 col-md-4">

                    <a href="#" class="card-berita">

                        <img src="<?= base_url('assets/images/kegiatan1.jpg') ?>" alt="">

                        <div class="tahun">
                            2026
                        </div>

                    </a>

                </div>

                <div class="col-lg-4 col-md-4">

                    <a href="#" class="card-berita">

                        <img src="<?= base_url('assets/images/kegiatan2.jpg') ?>" alt="">

                        <div class="tahun">
                            2025
                        </div>

                    </a>

                </div>

                <div class="col-lg-4 col-md-4">

                    <a href="#" class="card-berita">

                        <img src="<?= base_url('assets/images/kegiatan3.jpg') ?>" alt="">

                        <div class="tahun">
                            2024
                        </div>

                    </a>

                </div>

            </div>

            <button class="slider-arrow right">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

        </div>

        <div class="text-center mt-4">

            <a href="#" class="btn-lihat">
                Lihat Semua
            </a>

        </div>

    </div>

</section>
<?= $this->include('layout/footer') ?>