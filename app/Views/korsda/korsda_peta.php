<?= $this->include('layout/header') ?>

<?php $uri = service('uri'); ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatankorsda.css') ?>"
>

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


<!-- =====================================================
     HERO
===================================================== -->

<section class="hero-korsda">

    <div class="container text-center">

        <h1>
            KORSDA
        </h1>

        <h2>
            Wilayah <?= esc($korsda['nama_kecamatan']) ?>
        </h2>

    </div>

</section>



<!-- =====================================================
     MENU TAB / BREADCRUMB
===================================================== -->

<div class="container tab-container">

    <?php
    $currentPage = $uri->getSegment(2);
    ?>

    <div class="korsda-tabs">

        <!-- PROFIL -->
        <a
            href="<?= base_url('korsda/profil/' . $korsda['id']) ?>"
            class="tab-link <?= $currentPage === 'profil' ? 'active' : '' ?>"
        >
            Profil
        </a>


        <!-- PETA -->
        <a
            href="<?= base_url('korsda/peta/' . $korsda['id']) ?>"
            class="tab-link <?= $currentPage === 'peta' ? 'active' : '' ?>"
        >
            Peta Wilayah Kerja
        </a>


        <!-- KEGIATAN -->
        <a
            href="<?= base_url('korsda/kegiatan/' . $korsda['id']) ?>"
            class="tab-link <?= $currentPage === 'kegiatan' ? 'active' : '' ?>"
        >
            Kegiatan
        </a>

    </div>

</div>



<!-- =====================================================
     KONTEN PETA
===================================================== -->

<section class="korsda-content">

    <div class="container">


        <!-- =================================================
             JUDUL PETA
        ================================================== -->

        <div class="kegiatan-header">

            <h2>
                Peta Wilayah Kerja
                <?= esc($korsda['nama_kecamatan']) ?>
            </h2>

            <p>
                Peta wilayah kerja KORSDA Kecamatan
                <?= esc($korsda['nama_kecamatan']) ?>
            </p>

        </div>



        <!-- =================================================
             PETA
        ================================================== -->

        <?php if (!empty($wilayah)) : ?>

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-3">

                    <div
                        id="map"
                        style="height:600px; border-radius:12px; overflow:hidden;"
                    ></div>

                </div>

            </div>


            <script>

            // =================================================
            // INISIALISASI PETA
            // =================================================

            var map = L.map('map').setView(
                [-8.2192, 114.3692],
                12
            );


            // =================================================
            // OPEN STREET MAP
            // =================================================

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    maxZoom: 19,
                    subdomains: ['a', 'b', 'c'],
                    attribution: '&copy; OpenStreetMap contributors'
                }
            ).addTo(map);


            // =================================================
            // GROUP GEOJSON
            // =================================================

            var group = L.featureGroup().addTo(map);

            var fetchPromises = [];


            <?php foreach ($wilayah as $row): ?>

            var geojsonUrl =
                "<?= base_url(
                    'uploads/wilayah/' .
                    $row['file_geojson']
                ) ?>";


            var p = fetch(geojsonUrl)

                .then(res => {

                    if (!res.ok) {

                        throw new Error(
                            "HTTP " +
                            res.status +
                            " saat akses " +
                            geojsonUrl
                        );

                    }

                    return res.json();

                })


                .then(data => {

                    var layer = L.geoJSON(
                        data,
                        {

                            onEachFeature:
                                function(feature, layer) {

                                    layer.bindPopup(

                                        "<b><?= esc(
                                            $row['nama_wilayah']
                                        ) ?></b><br>" +

                                        "Keterangan: <?= esc(
                                            $row['keterangan']
                                        ) ?>"

                                    );

                                }

                        }
                    );


                    group.addLayer(layer);

                })


                .catch(err => {

                    console.error(
                        "Gagal load GeoJSON:",
                        err
                    );

                });


            fetchPromises.push(p);

            <?php endforeach; ?>


            // =================================================
            // FIT BOUNDS SETELAH SEMUA DATA SELESAI
            // =================================================

            Promise.all(fetchPromises).then(() => {

                if (group.getLayers().length > 0) {

                    map.fitBounds(
                        group.getBounds()
                    );

                }


                // Paksa Leaflet menghitung ulang ukuran

                setTimeout(function() {

                    map.invalidateSize();

                }, 300);

            });

            </script>


        <?php else : ?>


            <!-- =================================================
                 DATA BELUM TERSEDIA
            ================================================== -->

            <div class="alert alert-warning">

                <h5>
                    Data Wilayah Kerja Belum Tersedia
                </h5>

                <p class="mb-0">
                    Belum ada data wilayah kerja yang
                    diinput untuk Kecamatan
                    <?= esc($korsda['nama_kecamatan']) ?>.
                </p>

            </div>


        <?php endif; ?>



        <!-- =================================================
             KEMBALI
        ================================================== -->

        <div class="back-wrapper">

            <button
                type="button"
                class="btn btn-outline-primary btn-kembali"
                onclick="window.location.href='<?= base_url('korsda') ?>'"
            >

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </button>

        </div>


    </div>

</section>



<?= $this->include('layout/footer') ?>