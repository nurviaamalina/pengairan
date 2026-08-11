<?= $this->include('layout/header') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/gis.css') ?>">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

        <form action="<?= base_url('search') ?>" method="get">

    <div class="search-box">

        <input
            type="text"
            name="keyword"
            class="search-input"
            placeholder="Apa yang perlu anda cari?"
            autocomplete="off"
             required>

    </div>

</form>

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

                 <a href="<?= base_url('pengaduan') ?>" class="menu-link text-decoration-none">
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

    <a href="https://live.banyuwangikab.go.id/page/cctv?area=PANTAU%20SUNGAI"
       class="menu-link"
       target="_blank">

        <div class="menu-circle">
            <img src="<?= base_url('assets/images/cctv.png') ?>"
                 alt="Live CCTV"
                 style="width: 200%; height: 200%; object-fit: contain;">
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

       
        <?php if (!empty($berita)) : ?>
 <!-- Berita Utama -->
<div class="berita-utama">

    <a href="<?= base_url('berita/'.$berita[0]['slug']) ?>">

        <img src="<?= base_url('uploads/berita/'.$berita[0]['gambar']) ?>" alt="">

        <div class="overlay">

            <h3><?= esc($berita[0]['judul']) ?></h3>

            <span>
                <?= date('d F Y', strtotime($berita[0]['created_at'])) ?>
            </span>

        </div>

    </a>

</div>

        <!-- Slider Berita -->
        <div class="slider-berita">

    <button class="slider-btn kiri">
        <i class="bi bi-arrow-left"></i>
    </button>

 <?php foreach (array_slice($berita, 1) as $item): ?>

<div class="berita-item">

    <a href="<?= base_url('berita/'.$item['slug']) ?>">

        <img src="<?= base_url('uploads/berita/'.$item['gambar']) ?>">

        <div class="overlay-kecil">

            <h6><?= esc($item['judul']) ?></h6>

            <span>
                <?= date('d M Y', strtotime($item['created_at'])) ?>
            </span>

        </div>

    </a>

</div>

<?php endforeach; ?>

    <button class="slider-btn kanan">
        <i class="bi bi-arrow-right"></i>
    </button>

</div>

<?php endif; ?>

        <div class="text-center">

            <a href="<?= base_url('berita') ?>" class="btn-lihat">
                Lihat Semua
            </a>

        </div>

    </div>

</section>
<!-- INFORMASI TERKINI -->
<!-- ===========================
     INSTAGRAM
=========================== -->

<section class="instagram-section py-5">

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="section-title">

                    Instagram

                </h2>

                <p class="text-muted">

                    Dokumentasi kegiatan terbaru Dinas Pengairan Kabupaten Banyuwangi.

                </p>

            </div>

            <a href="<?= base_url('instagram') ?>" class="btn btn-outline-primary">

                Lihat Semua

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

        <div class="row g-4">

            <?php if (!empty($instagram)) : ?>

                <?php foreach ($instagram as $item) : ?>

                    <div class="col-lg-4 col-md-6">

                        <div class="instagram-card">

                            <a href="<?= esc($item['instagram_url']) ?>" target="_blank">

                                <img
                                    src="<?= base_url('uploads/instagram/' . $item['thumbnail']) ?>"
                                    class="img-fluid">

                            </a>

                            <div class="instagram-content">

                                <h5>

                                    <?= esc($item['judul']) ?>

                                </h5>

                                <p>

                                    <?= character_limiter(strip_tags($item['caption']), 90) ?>

                                </p>

                                <small>

                                    <i class="bi bi-calendar-event"></i>

                                    <?= date('d F Y', strtotime($item['tanggal_post'])) ?>

                                </small>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="col-12">

                    <div class="alert alert-light text-center">

                        Belum ada postingan Instagram.

                    </div>

                </div>

            <?php endif; ?>

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
        <div id="map"></div>
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

                <div class="category-item" data-kategori="jaringan irigasi">
                    <span class="circle blue">
                        <i class="bi bi-droplet-fill"></i>
                    </span>
                    Jaringan Irigasi
                </div>

                <div class="category-item" data-kategori="bendungan">
                    <span class="circle green">
                        <i class="bi bi-tree-fill"></i>
                    </span>
                    Bendungan
                </div>

                <div class="category-item" data-kategori="embung">
                    <span class="circle orange">
                        <i class="bi bi-water"></i>
                    </span>
                    Embung
                </div>

                <div class="category-item" data-kategori="bangunan pengairan">
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

    <img src="<?= base_url('assets/images/batik 2.png') ?>" class="motif-kanan">

    <div class="container">

        <div class="judul-section">

            <h2 class="judul-berita">
                Kegiatan Terbaru
            </h2>

            <p class="text-muted mt-3 mb-5">
                Ikuti berbagai kegiatan terbaru Dinas Pengairan Kabupaten Banyuwangi.
            </p>

        </div>

        <?php if (!empty($headlineKegiatan)) : ?>

            <!-- Headline Kegiatan -->
            <a href="<?= base_url('kegiatan'.$headlineKegiatan['slug']) ?>" class="headline-kegiatan">

                <img src="<?= base_url('uploads/kegiatan/thumbnail/'.$headlineKegiatan['thumbnail']) ?>" alt="<?= esc($headlineKegiatan['judul']) ?>">

                <div class="overlay">

                    <h3><?= esc($headlineKegiatan['judul']) ?></h3>

                    <span>
                        <?= date('d F Y', strtotime($headlineKegiatan['tanggal'])) ?>
                    </span>

                </div>

            </a>

        <?php endif; ?>

        <!-- Slider Tahun -->
        <div class="slider-wrapper">

            <button class="slider-arrow left">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="slider-container">

                <?php if (!empty($tahunKegiatan)) : ?>

                    <?php foreach ($tahunKegiatan as $item) : ?>

                        <a href="<?= base_url('kegiatan/tahun/'.$item['tahun']) ?>" class="card-berita">

                            <img src="<?= base_url('uploads/kegiatan/thumbnail/'.$item['thumbnail']) ?>" alt="<?= esc($item['tahun']) ?>">

                            <div class="tahun">

                                <?= esc($item['tahun']) ?>

                            </div>

                        </a>

                    <?php endforeach; ?>

                <?php endif; ?>

            </div>

            <button class="slider-arrow right">
                <i class="bi bi-chevron-right"></i>
            </button>

        </div>

        <div class="text-center mt-4">

            <a href="<?= base_url('kegiatan') ?>" class="btn-lihat">
                Lihat Semua
            </a>

        </div>

    </div>

</section>
<script>

const dataGIS = <?= json_encode($gis ?? []); ?>;

document.addEventListener("DOMContentLoaded", function () {

    const map = L.map('map', {
    scrollWheelZoom: true,   
    touchZoom: true,
    doubleClickZoom: true,
    dragging: true,
    zoomControl: true
}).setView([-8.2192, 114.3691], 11);

    L.tileLayer(
        'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
        {
            maxZoom:20,
            subdomains:['mt0','mt1','mt2','mt3']
        }
    ).addTo(map);

    let markers = [];
    let kategoriAktif = "";

    function tampilkanMarker(){

        // hapus marker lama
        markers.forEach(function(marker){
            map.removeLayer(marker);
        });

        markers = [];

        dataGIS.forEach(function(item){

            if(
                item.latitude == null ||
                item.longitude == null ||
                item.latitude == "" ||
                item.longitude == ""
            ){
                return;
            }

            // FILTER KATEGORI
            if(
                kategoriAktif != "" &&
                item.keterangan.toLowerCase() != kategoriAktif
            ){
                return;
            }

            let marker = L.marker([
                parseFloat(item.latitude),
                parseFloat(item.longitude)
            ]).addTo(map);

            marker.bindPopup(`
                <div style="min-width:220px">

                    <h6>${item.nama_lokasi}</h6>

                    <hr>

                    <b>Kecamatan</b><br>

                    ${item.nama_kecamatan ?? '-'}

                    <br><br>

                    <b>Latitude</b><br>

                    ${item.latitude}

                    <br><br>

                    <b>Longitude</b><br>

                    ${item.longitude}

                    <br><br>

                    <b>Kategori</b><br>

                    ${item.keterangan ?? '-'}

                </div>
            `);

            markers.push(marker);

        });

        if(markers.length > 0){

            let group = L.featureGroup(markers);

            map.fitBounds(group.getBounds().pad(0.2));

        }

    }

    tampilkanMarker();

    // ==========================
    // FILTER SAAT KATEGORI DIKLIK
    // ==========================

    document.querySelectorAll(".category-item").forEach(function(item){

        item.addEventListener("click", function(){

            document.querySelectorAll(".category-item").forEach(function(el){
                el.classList.remove("active");
            });

            this.classList.add("active");

            kategoriAktif = this.dataset.kategori;

            tampilkanMarker();

        });

    });

    // Klik peta menuju halaman GIS

    map.on('click', function () {
        window.location.href = "<?= base_url('gis') ?>";
    });

});
</script>
<?= $this->include('layout/footer') ?>