<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<?= $this->include('admin/layout/sidebar') ?>

<main class="content-wrapper">

    <div class="dashboard-content">

        <!-- Isi Dashboard -->
        <div class="p-4 flex-grow-1">

            <h5 class="mb-4 fw-bold">Layanan Unggulan</h5>

            <div class="row">

                <!-- Kiri -->
                <div class="col-lg-8">

                    <div class="row g-4">

                        <!-- Card 1 -->
                        <div class="col-lg-4 col-md-6">
        <a href="<?= base_url('admin/korsda/dashboard') ?>" class="text-decoration-none text-dark">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <i class="bi bi-people fs-1"></i>

                    <h5 class="mt-3">Korsda</h5>

                    <p class="text-muted">
                        Jelajahi peta digital jaringan sungai,
                        irigasi dan bendungan.
                    </p>
                </div>
            </div>
        </a>
    </div>
    
                        <!-- Card 2 -->
        <div class="col-lg-4 col-md-6">
        <a href="<?= base_url('admin/pengaduan') ?>" class="text-decoration-none text-dark">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body">
                    <i class="bi bi-telephone fs-1"></i>

                    <h5 class="mt-3">Layanan Pengaduan</h5>

                    <p class="text-muted">
                        Laporkan permasalahan pengairan dengan mudah dan cepat.
                    </p>
                </div>
            </div>
        </a>
    </div>
                        <!-- Card 4 -->
                       <div class="col-lg-4 col-md-6">
    <a href="<?= base_url('admin/dokumen') ?>" class="text-decoration-none text-dark">
        <div class="card shadow-sm border-0 rounded-4 h-100">
            <div class="card-body">
                <i class="bi bi-file-earmark-text fs-1"></i>

                <h5 class="mt-3">Dokumen</h5>

                <p class="text-muted">
                    Kelola dan akses dokumen Dinas Pengairan dengan mudah.
                </p>
            </div>
        </div>
    </a>
</div>

                    </div>

                    <!-- MAP -->
                    <div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-body">

        <h5 class="mb-3">Peta Jaringan Irigasi</h5>

        <div id="map" style="height:450px;border-radius:15px;"></div>

    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const dataGIS = <?= json_encode(
        $gis ?? [],
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    ) ?>;

    const map = L.map('map', {
        scrollWheelZoom: true,
        touchZoom: true,
        doubleClickZoom: true,
        dragging: true,
        zoomControl: true
    }).setView(
        [-8.2192, 114.3691],
        10
    );


    // =====================================================
    // BASE MAP
    // =====================================================

    L.tileLayer(
        'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
        {
            maxZoom: 20,
            subdomains: [
                'mt0',
                'mt1',
                'mt2',
                'mt3'
            ],
            attribution: 'Google Maps'
        }
    ).addTo(map);


    // =====================================================
    // SIMPAN SEMUA LAYER
    // =====================================================

    const layers = [];


    // =====================================================
    // LOAD GEOJSON
    // =====================================================

    const promises = dataGIS.map(function (item) {

        if (!item.file_geojson) {
            return Promise.resolve();
        }


        const geojsonUrl =
            "<?= base_url('uploads/wilayah/') ?>" +
            item.file_geojson;


        return fetch(geojsonUrl)

            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'GeoJSON tidak ditemukan: ' +
                        geojsonUrl
                    );

                }

                return response.json();

            })

            .then(function (geojson) {

                const layer = L.geoJSON(
                    geojson,
                    {

                        style: function () {

                            return {
                                color: '#3388ff',
                                weight: 4,
                                opacity: 0.9,
                                fillColor: '#3388ff',
                                fillOpacity: 0.20
                            };

                        },


                        pointToLayer:
                            function (feature, latlng) {

                                return L.circleMarker(
                                    latlng,
                                    {
                                        radius: 7,
                                        fillColor: '#3388ff',
                                        color: '#ffffff',
                                        weight: 2,
                                        fillOpacity: 0.9
                                    }
                                );

                            },


                        onEachFeature:
                            function (
                                feature,
                                layer
                            ) {

                                const properties =
                                    feature.properties || {};


                                const nama =
                                    properties.nama ||
                                    properties.nama_lokasi ||
                                    item.nama_wilayah ||
                                    'Infrastruktur Pengairan';


                                const kategori =
                                    properties.kategori ||
                                    item.keterangan ||
                                    '-';


                                layer.bindPopup(`

                                    <div
                                        style="
                                            min-width:220px;
                                        "
                                    >

                                        <h6 class="fw-bold">
                                            ${nama}
                                        </h6>

                                        <hr>

                                        <b>
                                            Kecamatan
                                        </b>

                                        <br>

                                        ${item.nama_kecamatan ?? '-'}

                                        <br><br>

                                        <b>
                                            Kategori
                                        </b>

                                        <br>

                                        ${kategori}

                                        <br><br>

                                        <b>
                                            Keterangan
                                        </b>

                                        <br>

                                        ${item.keterangan ?? '-'}

                                    </div>

                                `);

                            }

                    }
                );


                layer.addTo(map);

                layers.push(layer);

            })

            .catch(function (error) {

                console.error(
                    'Gagal memuat GeoJSON:',
                    error
                );

            });

    });


    // =====================================================
    // FIT KE SEMUA DATA
    // =====================================================

    Promise.all(promises)
        .then(function () {

            if (layers.length === 0) {
                return;
            }


            const group =
                L.featureGroup(layers);


            if (group.getBounds().isValid()) {

                map.fitBounds(
                    group.getBounds(),
                    {
                        padding: [30, 30]
                    }
                );

            }

        });


    // =====================================================
    // FIX LEAFLET SIZE
    // =====================================================

    setTimeout(function () {

        map.invalidateSize();

    }, 500);

});
</script>

                </div>

                <!-- Kanan -->
                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">

                            <h5>Berita</h5>

                           <?php if (!empty($berita)) : ?>

                                    <?php foreach ($berita as $item) : ?>

                                        <div class="d-flex mt-3">

                                            <img
                                                src="<?= base_url('uploads/berita/' . $item['gambar']) ?>"
                                                style="width:80px;height:60px;object-fit:cover;border-radius:8px;">

                                            <div class="ms-3">

                                                <strong style="font-size:14px;">
                                                    <?= esc($item['judul']) ?>
                                                </strong>

                                                <br>

                                                <small class="text-muted">
                                                    <?= date('d M Y', strtotime($item['created_at'])) ?>
                                                </small>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                <?php else : ?>

                                    <p class="text-muted mt-3">
                                        Belum ada berita.
                                    </p>

                                <?php endif; ?>

                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mt-4">
                        <div class="card-body">

                            <h5>Gallery Kegiatan</h5>

                            <div class="row mt-3">

                                <?php if (!empty($kegiatan)) : ?>

                                        <?php foreach ($kegiatan as $item) : ?>

                                            <div class="col-4 mb-3">

                                                <img
                                                    src="<?= base_url('uploads/kegiatan/thumbnail/' . $item['thumbnail']) ?>"
                                                    class="img-fluid rounded"
                                                    style="height:90px;width:100%;object-fit:cover;"
                                                    title="<?= esc($item['judul']) ?>">

                                            </div>

                                        <?php endforeach; ?>

                                    <?php else : ?>

                                        <div class="col-12">

                                            <small class="text-muted">
                                                Belum ada kegiatan.
                                            </small>

                                        </div>

                                    <?php endif; ?>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <?= $this->include('Admin/layout/footer'); ?>
        </div>
</main>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
