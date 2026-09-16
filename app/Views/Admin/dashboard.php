<?= $this->include('admin/layout/header') ?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<?= $this->include('admin/layout/sidebar') ?>

<main class="content-wrapper">

    <div class="dashboard-content">

        <div class="p-4 flex-grow-1">

            <!-- Judul Halaman -->
            <h5 class="mb-4 fw-bold text-dark">
                <i class="bi bi-grid-fill text-primary me-2"></i>Layanan Unggulan
            </h5>

            <div class="row g-4">

                <!-- ================= KOLOM KIRI ================= -->
                <div class="col-lg-8">

                    <!-- ==============================================
                         CARD 1 & 2: KORSDA & DOKUMEN (BARIS ATAS)
                         ============================================== -->
                    <div class="row g-4 mb-4">

                        <!-- Card Korsda -->
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 rounded-4 position-relative" style="min-height: 180px;">
                                <div class="card-body p-4">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3">
                                        <i class="bi bi-people fs-2"></i>
                                    </div>
                                    <h5 class="fw-bold">
                                        <a href="<?= base_url('admin/korsda/dashboard') ?>" class="stretched-link text-decoration-none text-dark">
                                            Korsda
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        Jelajahi peta digital jaringan sungai, irigasi dan bendungan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Card Dokumen -->
                        <div class="col-md-6">
                            <div class="card shadow-sm border-0 rounded-4 position-relative" style="min-height: 180px;">
                                <div class="card-body p-4">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3">
                                        <i class="bi bi-file-earmark-text fs-2"></i>
                                    </div>
                                    <h5 class="fw-bold">
                                        <a href="<?= base_url('admin/dokumen') ?>" class="stretched-link text-decoration-none text-dark">
                                            Dokumen
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-0">
                                        Kelola dan akses dokumen Dinas Pengairan dengan mudah.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ==============================================
                         CARD 3: PETA JARINGAN IRIGASI (KARTU TERPISAH SENDIRI)
                         ============================================== -->
                    <div class="card shadow-sm border-0 rounded-4 mt-2">
                        <div class="card-body p-4">
                            
                            <!-- Judul di Dalam Card Peta Sendiri -->
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                                    <h5 class="mb-0 fw-bold text-dark">Peta Jaringan Irigasi</h5>
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                                    GIS Wilayah
                                </span>
                            </div>

                            <!-- Area Peta Leaflet -->
                            <div id="map" style="height: 460px; width: 100%; border-radius: 12px;"></div>

                        </div>
                    </div>

                    <!-- Script Peta Leaflet -->
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
                                                radius: 7,
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
                                                <div style="min-width:220px;">
                                                    <h6 class="fw-bold">${nama}</h6>
                                                    <hr class="my-2">
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

                        // Fit ke semua data
                        Promise.all(promises).then(function () {
                            if (layers.length === 0) return;
                            const group = L.featureGroup(layers);
                            if (group.getBounds().isValid()) {
                                map.fitBounds(group.getBounds(), { padding: [30, 30] });
                            }
                        });

                        // Fix render size Leaflet
                        setTimeout(function () {
                            map.invalidateSize();
                        }, 500);

                    });
                    </script>

                </div>

                <!-- ================= KOLOM KANAN ================= -->
                <div class="col-lg-4">

                    <!-- Card Berita -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 16px;">
                                <i class="bi bi-newspaper text-primary me-2"></i>Berita
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <?php if (!empty($berita)) : ?>
                                <?php foreach ($berita as $item) : ?>
                                    <div class="d-flex mb-3 pb-3 border-bottom">
                                        <img
                                            src="<?= base_url('uploads/berita/' . $item['gambar']) ?>"
                                            style="width:80px; height:60px; object-fit:cover; border-radius:8px;"
                                            alt="Gambar Berita">

                                        <div class="ms-3">
                                            <strong style="font-size:13.5px;" class="d-block text-dark">
                                                <?= esc($item['judul']) ?>
                                            </strong>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i><?= date('d M Y', strtotime($item['created_at'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p class="text-muted my-2">
                                    Belum ada berita.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Card Gallery Kegiatan -->
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-bottom py-3 px-4">
                            <h5 class="mb-0 fw-bold text-dark" style="font-size: 16px;">
                                <i class="bi bi-images text-primary me-2"></i>Gallery Kegiatan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-2">
                                <?php if (!empty($kegiatan)) : ?>
                                    <?php foreach ($kegiatan as $item) : ?>
                                        <div class="col-4">
                                            <img
                                                src="<?= base_url('uploads/kegiatan/thumbnail/' . $item['thumbnail']) ?>"
                                                class="img-fluid rounded"
                                                style="height:85px; width:100%; object-fit:cover;"
                                                title="<?= esc($item['judul']) ?>"
                                                alt="Kegiatan">
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

            </div> <!-- /.row -->
            
        </div> <!-- /.p-4 flex-grow-1 -->

    </div> <!-- /.dashboard-content -->

</main>

<?= $this->include('admin/layout/footer') ?>