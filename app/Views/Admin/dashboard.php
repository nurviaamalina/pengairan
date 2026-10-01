<?= $this->include('admin/layout/header') ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<?= $this->include('admin/layout/sidebar') ?>

<main class="content-wrapper">

    <div class="dashboard-content">

            <!-- =========================================================================
                 HERO HEADER / WELCOME BANNER (Dinamis Sesuai Session Login)
                 ========================================================================= -->
            <div class="card border-0 text-white mb-3 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #263b78 0%, #263b78 100%);">
                <div class="card-body p-3 px-md-4">
                    <p class="text-white-50 fw-medium mb-1" style="font-size: 12px;">
                        <?= date('l, d F Y') ?>
                    </p>
                    <h5 class="fw-bold text-white mb-1 fs-5">
                        Selamat datang, <?= session()->get('nama') ?? session()->get('nama_lengkap') ?? session()->get('nama_user') ?? session()->get('username') ?? 'Pengguna' ?>
                    </h5>
                    <p class="text-white-50 mb-0" style="font-size: 12.5px;">
                        <?= session()->get('role') ?? session()->get('jabatan') ?? 'Admin' ?> — <?= session()->get('instansi') ?? 'Dinas Pengairan Kabupaten Banyuwangi' ?>
                    </p>
                </div>
            </div>

            <!-- =========================================================================
                 BARIS ATAS: 4 CARD COMPACT MENYAMPING
                 ========================================================================= -->
            <div class="row g-3 mb-3">

                <!-- 1. Card Korsda -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 rounded-3 position-relative h-100">
                        <div class="card-body p-3 d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; width: 42px; height: 42px;">
                                <i class="bi bi-people fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 fs-6">
                                    <a href="<?= base_url('admin/korsda/dashboard') ?>" class="stretched-link text-decoration-none text-dark">
                                        Korsda
                                    </a>
                                </h6>
                                <p class="text-muted mb-0" style="font-size: 11px; line-height: 1.2;">
                                    Peta digital jaringan sungai & irigasi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Card Dokumen -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 rounded-3 position-relative h-100">
                        <div class="card-body p-3 d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; width: 42px; height: 42px;">
                                <i class="bi bi-file-earmark-text fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 fs-6">
                                    <a href="<?= base_url('admin/dokumen') ?>" class="stretched-link text-decoration-none text-dark">
                                        Dokumen
                                    </a>
                                </h6>
                                <p class="text-muted mb-0" style="font-size: 11px; line-height: 1.2;">
                                    Akses dan kelola dokumen pengairan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Card Berita -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 rounded-3 position-relative h-100">
                        <div class="card-body p-3 d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; width: 42px; height: 42px;">
                                <i class="bi bi-newspaper fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 fs-6">
                                    <a href="<?= base_url('admin/berita') ?>" class="stretched-link text-decoration-none text-dark">
                                        Berita
                                    </a>
                                </h6>
                                <p class="text-muted mb-0" style="font-size: 11px; line-height: 1.2;">
                                    <?= !empty($berita) ? count($berita) . ' kabar terbaru dipublikasi.' : 'Informasi dan berita terbaru.' ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Card Kegiatan -->
                <div class="col-xl-3 col-md-6">
                    <div class="card shadow-sm border-0 rounded-3 position-relative h-100">
                        <div class="card-body p-3 d-flex align-items-center gap-3">
                            <div class="rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0" style="background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; width: 42px; height: 42px;">
                                <i class="bi bi-images fs-5"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 fs-6">
                                    <a href="<?= base_url('admin/kegiatan') ?>" class="stretched-link text-decoration-none text-dark">
                                        Kegiatan
                                    </a>
                                </h6>
                                <p class="text-muted mb-0" style="font-size: 11px; line-height: 1.2;">
                                    Galeri & dokumentasi lapangan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- /.row -->


            <!-- =========================================================================
                 BARIS BAWAH: PETA GIS FULL WIDTH
                 ========================================================================= -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body p-3">
                            
                            <!-- Header Card Peta -->
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="mb-0 fw-bold text-dark fs-6">
                                        <i class="bi bi-geo-alt-fill me-2" style="color: #263b78;"></i>Peta Jaringan Irigasi (GIS)
                                    </h6>
                                </div>
                                <span class="badge px-3 py-1 rounded-pill fw-semibold" style="background-color: rgba(13, 110, 253, 0.1); color: #263b78; font-size: 11px;">
                                    GIS Wilayah
                                </span>
                            </div>

                            <!-- Map Container -->
                            <div id="map" style="height: 320px; width: 100%; border-radius: 8px;"></div>

                        </div>
                    </div>
                </div>
            </div> <!-- /.row (Peta GIS) -->

        </div> <!-- /.px-4 pt-3 pb-3 -->

    </div> <!-- /.dashboard-content -->

</main>

<!-- Leaflet JavaScript -->
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
    }).setView([-8.2192, 114.3691], 10);

    // Base Map Google Maps
    L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Google Maps'
    }).addTo(map);

    const layers = [];

    // Load GeoJSON
    const promises = dataGIS.map(function (item) {
        if (!item.file_geojson) return Promise.resolve();

        const geojsonUrl = "<?= base_url('uploads/wilayah/') ?>" + item.file_geojson;

        return fetch(geojsonUrl)
            .then(function (response) {
                if (!response.ok) throw new Error('GeoJSON tidak ditemukan: ' + geojsonUrl);
                return response.json();
            })
            .then(function (geojson) {
                const layer = L.geoJSON(geojson, {
                    style: function () {
                        return {
                            color: '#3388ff',
                            weight: 4,
                            opacity: 0.9,
                            fillColor: '#3388ff',
                            fillOpacity: 0.20
                        };
                    },
                    pointToLayer: function (feature, latlng) {
                        return L.circleMarker(latlng, {
                            radius: 6,
                            fillColor: '#3388ff',
                            color: '#ffffff',
                            weight: 2,
                            fillOpacity: 0.9
                        });
                    },
                    onEachFeature: function (feature, layer) {
                        const properties = feature.properties || {};
                        const nama = properties.nama || properties.nama_lokasi || item.nama_wilayah || 'Infrastruktur Pengairan';
                        const kategori = properties.kategori || item.keterangan || '-';

                        layer.bindPopup(`
                            <div style="min-width:200px; font-size:12px;">
                                <h6 class="fw-bold mb-1" style="font-size:13px;">${nama}</h6>
                                <hr class="my-1">
                                <b>Kecamatan:</b> ${item.nama_kecamatan ?? '-'}<br>
                                <b>Kategori:</b> ${kategori}<br>
                                <b>Keterangan:</b> ${item.keterangan ?? '-'}
                            </div>
                        `);
                    }
                });

                layer.addTo(map);
                layers.push(layer);
            })
            .catch(function (error) {
                console.error('Gagal memuat GeoJSON:', error);
            });
    });

    // Fit ke semua bounds layer
    Promise.all(promises).then(function () {
        if (layers.length === 0) return;
        const group = L.featureGroup(layers);
        if (group.getBounds().isValid()) {
            map.fitBounds(group.getBounds(), { padding: [20, 20] });
        }
    });

    // Fix ukuran render Leaflet
    setTimeout(function () {
        map.invalidateSize();
    }, 300);

});
</script>

<?= $this->include('admin/layout/footer') ?>