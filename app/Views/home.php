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

            <a href="https://sekardadu.dingkoding.com/home" class="menu-link">
                <div class="menu-circle">
                <img src="<?= base_url('assets/images/sekardadu.png') ?>"
                alt=""style="width: 250%; height: 250%; object-fit: contain;">
            </div>
        <h5>Sekardadu</h5>
        </a>
                

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center mb-3">

                <a href="https://mawasdiri.dingkoding.com/home" class="menu-link">
                    <div class="menu-circle">
                       <img src="<?= base_url('assets/images/mawasdiri.png') ?>"alt=""style="width: 150%; height: 150%; object-fit: contain;">
                    </div>
                    <h5>Mawasdiri</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center mb-3">

                <a href="https://pubwi.dingkoding.com/home" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/warmsystem.png') ?>"alt=""style="width: 150%; height: 150%; object-fit: contain;">
                    </div>
                    <h5>Warm System</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/pengaduan.png') ?>"alt=""style="width: 150%; height: 150%; object-fit: contain;">
                    </div>
                    <h5>Pengaduan</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center">

                <a href="<?= base_url('korsda') ?>" class="menu-item text-decoration-none">
                    <div class="menu-circle">
                        <img src="<?= base_url('assets/images/korsda.png') ?>"alt=""style="width: 150%; height: 150%; object-fit: contain;">
                    </div>
                    <h5>KORSDA</h5>
                </a>

            </div>

            <div class="col-lg-4 col-md-4 col-6 text-center">

                <a href="#" class="menu-link">
                    <div class="menu-circle">
                       <img src="<?= base_url('assets/images/cctv.png') ?>"alt=""style="width: 200%; height: 200%; object-fit: contain;">
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
        <div class="judul-section">

            <h2 class="judul-berita">
                Berita Terbaru
            </h2>

            <p class="text-muted mt-3 mb-5">
                Ikuti berita terbaru sebagai sumber informasi resmi mengenai kegiatan dan kebijakan Dinas Pengairan Banyuwangi.
            </p>

        </div>
    </div>

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

            <a href="<?= base_url('berita') ?>" class="btn-lihat">
                Lihat Semua
            </a>

        </div>

    </div>

</section>
<!-- INFORMASI TERKINI -->
<section class="info-section py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold text-primary-custom">
                Informasi Terkini
            </h2>

            <p class="text-muted mt-3">
                Ikuti berbagai kegiatan dan informasi terbaru Dinas Pengairan
                Banyuwangi yang dipublikasikan melalui media resmi kami
            </p>

            <div class="line-title"></div>

        </div>

        <div class="row justify-content-center">

            <?php foreach($berita as $item): ?>

            <div class="col-lg-5 col-md-6 mb-4">

                <div class="card berita-card">

                    <img src="<?= base_url('assets/images/'.$item['gambar']) ?>" class="card-img-top">

                    <div class="card-body">

                        <small class="text-muted">
                            <?= $item['tanggal'] ?>
                        </small>

                        <h6 class="mt-2 fw-semibold">
                            <?= $item['judul'] ?>
                        </h6>

                    </div>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

        <div class="text-center mt-3">

            <a href="https://instagram.com"
                target="_blank"
                class="btn btn-instagram">

                <i class="bi bi-instagram"></i>

                Lihat Selengkapnya di Instagram

                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>

    </div>

</section>
<!-- INFRASTRUKTUR -->
<section class="map-section py-5">

    <div class="container">

        <div class="text-center mb-4">
            <h2 class="map-title">Infrastruktur Pengairan Banyuwangi</h2>

            <p class="map-subtitle">
                Peta persebaran irigasi, bendungan, sungai, dan bangunan pengairan lainnya di Kabupaten Banyuwangi
            </p>
        </div>

        <!-- MAP -->
        <div class="map-wrapper">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15795.284123220945!2d114.38147724999999!3d-8.22074595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15adf979095a9%3A0x1c00c5eb5b542e20!2sKec.%20Banyuwangi%2C%20Kabupaten%20Banyuwangi%2C%20Jawa%20Timur%2068411!5e0!3m2!1sid!2sid!4v1784694141106!5m2!1sid!2sid"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>

        </div>

        <!-- KATEGORI -->
        <div class="category-box mt-4">

            <div class="row align-items-center g-3">

                <div class="col-lg-3">
                    <div class="category-title">
                        <strong>Kategori</strong><br>
                        Infrastruktur
                    </div>
                </div>

                <div class="col-lg-9">

                    <div class="d-flex flex-wrap gap-4 justify-content-lg-start justify-content-center">

                        <div class="category-item">
                            <span class="circle blue">
                                <i class="bi bi-droplet-fill"></i>
                            </span>
                            Jaringan Irigasi
                        </div>

                        <div class="category-item">
                            <span class="circle green">
                                <i class="bi bi-tree-fill"></i>
                            </span>
                            Bendungan
                        </div>

                        <div class="category-item">
                            <span class="circle orange">
                                <i class="bi bi-water"></i>
                            </span>
                            Embung
                        </div>

                        <div class="category-item">
                            <span class="circle purple">
                                <i class="bi bi-building"></i>
                            </span>
                            Bangunan Pengairan
                        </div>

                    </div>

                </div>

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

        <p class="text-muted mt-3 mb-5">
             Dokumentasi kegiatan, agenda, dan berbagai aktivitas Dinas Pengairan Banyuwangi dalam mendukung pelayanan kepada masyarakat.
        </p>
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