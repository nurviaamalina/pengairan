<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/berita.css') ?>">

<section class="detailberita-page">
    <div class="container py-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('berita/detail') ?>">Berita</a>
                </li>
            
                <li class="breadcrumb-item active" aria-current="page">
                    Detail berita
                </li>
                
            </ol>
        </nav>



     <div class="card berita-card border-0 mb-5">

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

                
                    <div class="d-flex align-items-center gap-4 flex-wrap mt-3">

                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-event me-2"></i>
                            <span>Senin, 12 Juli 2026</span>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="bi bi-folder2-open me-2"></i>
                            <span>Lorem Ipsum</span>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="bi bi-eye me-2"></i>
                            <span>20 kali dibaca</span>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="berita-content mt-4">

        <p>
            Banyuwangi – Dalam upaya meningkatkan kualitas pelayanan publik dan keterbukaan informasi,
            Dinas Pengairan Kabupaten Banyuwangi tengah mengembangkan website resmi terbaru yang
            dirancang lebih modern, informatif, dan mudah diakses oleh masyarakat.
        </p>

        <p>
            Pengembangan website ini bertujuan untuk menghadirkan satu platform digital yang mampu
            memberikan berbagai informasi terkait pengelolaan sumber daya air, jaringan irigasi,
            infrastruktur pengairan, hingga layanan pengaduan masyarakat secara cepat dan transparan.
        </p>

        <p>
            Website terbaru nantinya akan dilengkapi dengan berbagai fitur unggulan, seperti Geographic Information System (GIS) untuk menampilkan peta jaringan sungai dan irigasi secara interaktif, SI AIR sebagai sistem informasi pengairan, KORSDA untuk mendukung koordinasi wilayah sumber daya air, Data Center sebagai pusat penyimpanan data, serta Layanan Pengaduan yang memudahkan masyarakat dalam menyampaikan laporan maupun aspirasi terkait kondisi infrastruktur pengairan.
            Selain menyediakan informasi publik, website ini juga menjadi media komunikasi antara Dinas Pengairan dengan masyarakat, sehingga proses penyampaian informasi dapat dilakukan secara lebih efektif, cepat, dan akurat.
        </p>

    </div>

        <button
            type="button"
            class="btn btn-primary btn-kembali-detail"
            onclick="window.location.href='<?= base_url('/berita') ?>'">

            <i class="bi bi-arrow-left me-2"></i>
            Kembali

        </button>

</section>

<?= $this->include('layout/footer') ?>

 