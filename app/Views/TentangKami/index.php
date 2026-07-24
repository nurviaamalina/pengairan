<?= $this->include('layout/header') ?>


<link rel="stylesheet" href="<?= base_url('assets/css/tentangkami.css') ?>">

<!-- HERO -->
<section class="hero-about">

    <img src="<?= base_url('assets/images/batik.png') ?>" class="motif-kiri" alt="Motif">

    <div class="container text-center">

        <h1>
            TENTANG <span>KAMI</span>
        </h1>

    </div>

</section>

<!-- SEJARAH -->
<section class="sejarah-section">

    <div class="container">

        <h2 class="section-title">
            SEJARAH <span>SINGKAT</span>
        </h2>

        <div class="content-card">

            <p>
                Dinas Pekerjaan Umum Pengairan Kabupaten Banyuwangi merupakan perangkat
                daerah yang bertugas melaksanakan urusan pemerintahan di bidang sumber
                daya air dan pengelolaan jaringan irigasi. Keberadaan dinas ini
                berperan penting dalam mendukung ketahanan pangan, pembangunan daerah,
                serta pemenuhan kebutuhan air bagi masyarakat Kabupaten Banyuwangi.
            </p>

            <p>
                Seiring perkembangan pembangunan daerah, Dinas PU Pengairan terus
                melakukan berbagai upaya peningkatan kualitas layanan melalui
                pembangunan, rehabilitasi, operasi, dan pemeliharaan infrastruktur
                pengairan. Selain itu, dinas juga aktif dalam pengelolaan sumber daya
                air yang berkelanjutan dengan mengedepankan prinsip efisiensi,
                konservasi, dan pemberdayaan masyarakat.
            </p>

            <p>
                Dalam era transformasi digital, Dinas PU Pengairan Kabupaten
                Banyuwangi terus berinovasi melalui pengembangan sistem informasi dan
                layanan berbasis teknologi guna meningkatkan transparansi,
                akuntabilitas, serta kemudahan akses informasi bagi masyarakat.
            </p>

        </div>

    </div>

</section>

<!-- VISI MISI -->
<section class="visi-misi-section">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 mb-4">

                <div class="vm-content">

                    <h3>VISI</h3>

                    <p>
                        Visi Dinas PU Pengairan "Terwujudnya pengelolaan sumber daya
                        air yang optimal dan berwawasan lingkungan dengan meningkatkan
                        kualitas pelayanan kepada masyarakat secara adil, merata,
                        dan berkelanjutan, yang bertumpu pada kemandirian dan
                        keswadayaan masyarakat."
                    </p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="vm-content">

                    <h3>MISI</h3>

                    <ol>
                        <li>Meningkatkan penyediaan air guna menjamin tercapainya kebutuhan air masyarakat.</li>
                        <li>Melaksanakan pengembangan dan pengelolaan sistem irigasi.</li>
                        <li>Meningkatkan konservasi sumber daya air yang berkelanjutan.</li>
                        <li>Melaksanakan pengendalian daya rusak air dan kekeringan.</li>
                        <li>Melaksanakan penataan, penguasaan dan pemilikan tanah.</li>
                        <li>Meningkatkan kemampuan Sumber Daya Manusia.</li>
                    </ol>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- STRUKTUR ORGANISASI -->
<section class="struktur-section">

    <div class="container text-center">

        <h2 class="section-title-center">
            STRUKTUR <span>ORGANISASI</span>
        </h2>

        <p class="sub-title">
            Dinas Pekerjaan Umum Pengairan Kabupaten Banyuwangi
        </p>

        <div class="struktur-card">

            <img
                src="<?= base_url('assets/images/Struktur Terbaru.jpg') ?>"
                alt="Struktur Organisasi"
                class="img-fluid">

        </div>

    </div>

</section>

<!-- BUTTON -->
<section class="btn-section">

    <div class="container text-center">

        <a href="<?= base_url('/') ?>" class="btn-kembali">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Beranda
        </a>

    </div>

</section>

<?= $this->include('layout/footer') ?>