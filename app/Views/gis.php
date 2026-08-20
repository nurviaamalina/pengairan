<?= $this->include('layout/header') ?>

<link rel="stylesheet"
      href="<?= base_url('assets/css/gis.css') ?>">

<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


<!-- =====================================================
     BANNER
===================================================== -->

<section class="gis-banner">

    <div class="container text-center">

        <h1>
            GIS Kabupaten Banyuwangi
        </h1>

        <p>
            Sistem Informasi Geografis Sumber Daya Air dan
            Infrastruktur Pengairan
        </p>

    </div>

</section>


<!-- =====================================================
     CONTENT
===================================================== -->

<section class="gis-content">

    <div class="container">


        <!-- BREADCRUMB -->

        <div class="breadcrumb-box">

            <a href="<?= base_url() ?>">
                Beranda
            </a>

            >

            <span>
                GIS
            </span>

        </div>


        <div class="row mt-4">


            <!-- =================================================
                 FILTER
            ================================================== -->

            <div class="col-md-3">

                <div class="filter-card">


                    <div class="filter-header">

                        ☰ Filter Infrastruktur

                    </div>


                    <div class="p-3">


                        <!-- KECAMATAN -->

                        <label class="form-label fw-bold">

                            Kecamatan

                        </label>

                        <select
                            class="form-select"
                            id="filterKecamatan">

                            <option value="">
                                Semua Kecamatan
                            </option>


                            <?php foreach ($kecamatan as $k): ?>

                                <option
                                    value="<?= esc($k['id']) ?>">

                                    <?= esc(
                                        $k['nama_kecamatan']
                                    ) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>


                        <!-- KATEGORI -->

                        <label
                            class="form-label fw-bold mt-3">

                            Kategori Infrastruktur

                        </label>


                        <select
                            class="form-select"
                            id="filterKategori">

                            <option value="">
                                Semua Infrastruktur
                            </option>

                            <option value="jaringan irigasi">
                                Jaringan Irigasi
                            </option>

                            <option value="bendung">
                                Bendung
                            </option>

                            <option value="bendungan">
                                Bendungan
                            </option>

                            <option value="embung">
                                Embung
                            </option>

                            <option value="bangunan pengairan">
                                Bangunan Pengairan
                            </option>

                        </select>


                        <!-- RESET -->

                        <button
                            class="btn btn-secondary w-100 mt-3"
                            id="resetFilter">

                            Reset Filter

                        </button>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 MAP
            ================================================== -->

            <div class="col-md-9">

                <div
                    id="map"
                    style="
                        height:600px;
                        border-radius:10px;
                    ">
                </div>

            </div>

        </div>

    </div>

</section>


<script>


// =========================================================
// DATA DARI CONTROLLER
// =========================================================

const dataGIS =
    <?= json_encode($wilayah ?? []) ?>;


// =========================================================
// MAP
// =========================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {


        const map = L.map('map')
            .setView(
                [-8.2192, 114.3691],
                10
            );


        // =================================================
        // BASE MAP
        // =================================================

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            {

                maxZoom: 19,

                attribution:
                    '&copy; OpenStreetMap contributors'

            }
        ).addTo(map);


        // =================================================
        // MENYIMPAN SEMUA LAYER
        // =================================================

        let infrastructureLayers = [];


        // =================================================
        // LOAD GEOJSON
        // =================================================

        function loadAllGeoJSON() {


            infrastructureLayers.forEach(
                function (item) {

                    if (map.hasLayer(item.layer)) {

                        map.removeLayer(item.layer);

                    }

                }
            );


            infrastructureLayers = [];


            const promises = dataGIS.map(
                function (item) {


                    if (!item.file_geojson) {

                        return Promise.resolve();

                    }


                    const url =
                        "<?= base_url('uploads/wilayah/') ?>" +
                        item.file_geojson;


                    return fetch(url)

                        .then(
                            function (response) {

                                if (!response.ok) {

                                    throw new Error(
                                        "Gagal mengambil GeoJSON: " +
                                        url
                                    );

                                }

                                return response.json();

                            }
                        )

                        .then(
                            function (geojson) {


                                // =================================
                                // KATEGORI
                                // =================================

                                const kategori =
                                    (
                                        item.keterangan ||
                                        ''
                                    )
                                    .toLowerCase()
                                    .trim();


                                // =================================
                                // GEOJSON LAYER
                                // =================================

                                const layer =
                                    L.geoJSON(
                                        geojson,
                                        {


                                            style:
                                                function () {

                                                    return {

                                                        weight: 3,

                                                        fillOpacity:
                                                            0.25

                                                    };

                                                },


                                            onEachFeature:
                                                function (
                                                    feature,
                                                    layer
                                                ) {


                                                    layer.bindPopup(`

                                                        <div
                                                            style="
                                                                min-width:220px;
                                                            "
                                                        >

                                                            <h6
                                                                class="fw-bold"
                                                            >
                                                                ${
                                                                    item.nama_wilayah
                                                                    ||
                                                                    'Infrastruktur Pengairan'
                                                                }
                                                            </h6>


                                                            <hr>


                                                            <b>
                                                                Kecamatan
                                                            </b>

                                                            <br>

                                                            ${
                                                                item.nama_kecamatan
                                                                ||
                                                                '-'
                                                            }


                                                            <br><br>


                                                            <b>
                                                                Keterangan
                                                            </b>

                                                            <br>

                                                            ${
                                                                item.keterangan
                                                                ||
                                                                '-'
                                                            }

                                                        </div>

                                                    `);

                                                }

                                        }
                                    );


                                // =================================
                                // SIMPAN
                                // =================================

                                infrastructureLayers.push({

                                    id_kecamatan:
                                        String(
                                            item.id_kecamatan ||
                                            ''
                                        ),

                                    kategori:
                                        kategori,

                                    layer:
                                        layer

                                });

                            }
                        )

                        .catch(
                            function (error) {

                                console.error(
                                    error
                                );

                            }
                        );

                }
            );


            Promise.all(promises)

                .then(
                    function () {

                        tampilkanPeta();

                    }
                );

        }


        // =================================================
        // TAMPILKAN PETA SESUAI FILTER
        // =================================================

        function tampilkanPeta() {


            const kecamatan =
                document
                    .getElementById(
                        'filterKecamatan'
                    )
                    .value;


            const kategori =
                document
                    .getElementById(
                        'filterKategori'
                    )
                    .value
                    .toLowerCase()
                    .trim();


            let visibleLayers = [];


            infrastructureLayers.forEach(
                function (item) {


                    // =================================
                    // FILTER KECAMATAN
                    // =================================

                    if (
                        kecamatan !== '' &&
                        item.id_kecamatan !== kecamatan
                    ) {

                        return;

                    }


                    // =================================
                    // FILTER KATEGORI
                    // =================================

                    if (
                        kategori !== '' &&
                        !item.kategori.includes(kategori)
                    ) {

                        return;

                    }


                    // =================================
                    // TAMPILKAN
                    // =================================

                    item.layer.addTo(map);

                    visibleLayers.push(
                        item.layer
                    );

                }
            );


            // =============================================
            // FIT MAP
            // =============================================

            if (
                visibleLayers.length > 0
            ) {

                const group =
                    L.featureGroup(
                        visibleLayers
                    );


                map.fitBounds(
                    group.getBounds(),
                    {
                        padding: [30, 30]
                    }
                );

            }

        }


        // =================================================
        // LOAD PERTAMA
        // =================================================

        loadAllGeoJSON();


        // =================================================
        // FILTER KECAMATAN
        // =================================================

        document
            .getElementById(
                'filterKecamatan'
            )
            .addEventListener(
                'change',
                tampilkanPeta
            );


        // =================================================
        // FILTER KATEGORI
        // =================================================

        document
            .getElementById(
                'filterKategori'
            )
            .addEventListener(
                'change',
                tampilkanPeta
            );


        // =================================================
        // RESET
        // =================================================

        document
            .getElementById(
                'resetFilter'
            )
            .addEventListener(
                'click',
                function () {


                    document
                        .getElementById(
                            'filterKecamatan'
                        )
                        .value = '';


                    document
                        .getElementById(
                            'filterKategori'
                        )
                        .value = '';


                    tampilkanPeta();

                }
            );


        // =================================================
        // FIX MAP SIZE
        // =================================================

        setTimeout(
            function () {

                map.invalidateSize();

            },
            500
        );


    }
);

</script>


<?= $this->include('layout/footer') ?>