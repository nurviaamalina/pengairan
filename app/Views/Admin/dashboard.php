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
<div class="col-lg-8 mb-4">

   
    <div class="row g-4 mb-5">

<div class="col-lg-4 col-md-6">
    <a href="<?= base_url('admin/korsda/dashboard') ?>" class="text-decoration-none text-dark d-block h-100">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-body p-3 d-flex flex-column">
                <i class="bi bi-people fs-3 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Korsda</h6>
                <p class="text-muted small mb-0" style="font-size: 0.85rem;">
                    Jelajahi peta digital jaringan sungai, irigasi, dan bendungan.
                </p>
            </div>
        </div>
    </a>
</div>

<!-- Card 2: Layanan Pengaduan -->
<div class="col-lg-4 col-md-6">
    <a href="<?= base_url('admin/pengaduan') ?>" class="text-decoration-none text-dark d-block h-100">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-body p-3 d-flex flex-column">
                <i class="bi bi-telephone fs-3 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Layanan Pengaduan</h6>
                <p class="text-muted small mb-0" style="font-size: 0.85rem;">
                    Laporkan permasalahan pengairan dengan mudah dan cepat.
                </p>
            </div>
        </div>
    </a>
</div>

<!-- Card 3: Dokumen -->
<div class="col-lg-4 col-md-6">
    <a href="<?= base_url('admin/dokumen') ?>" class="text-decoration-none text-dark d-block h-100">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-body p-3 d-flex flex-column">
                <i class="bi bi-file-earmark-text fs-3 text-primary mb-2"></i>
                <h6 class="fw-bold mb-1">Dokumen</h6>
                <p class="text-muted small mb-0" style="font-size: 0.85rem;">
                    Kelola dan akses dokumen Dinas Pengairan dengan mudah.
                </p>
            </div>
        </div>
    </a>
</div>

    </div> <!-- End Row 3 Cards -->

    <!-- Card Peta Jaringan Irigasi (Berada di luar div row atas) -->
    <div class="card border-0 shadow-sm rounded-4 mt-4 mx-auto" style="max-width: 800px;">
    <!-- Padding dikurangi jadi p-3 -->
    <div class="card-body p-3"> 
        <h5 class="fw-bold mb-2 fs-6">Peta Jaringan Irigasi</h5>
        <!-- Tinggi peta dikurangi dari 450px jadi 300px -->
        <div id="map" style="height: 250px; border-radius: 12px; width: 100%;"></div>
    </div>
</div>

</div>

<!-- LEAFLET STYLES & SCRIPTS -->
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
    }).setView([-8.2192, 114.3691], 10);

    // BASE MAP
    L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: 'Google Maps'
    }).addTo(map);

    const layers = [];

    // LOAD GEOJSON
    const promises = dataGIS.map(function (item) {
        if (!item.file_geojson) return Promise.resolve();

        const geojsonUrl = "<?= base_url('uploads/wilayah/') ?>" + item.file_geojson;

        return fetch(geojsonUrl)
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('GeoJSON tidak ditemukan: ' + geojsonUrl);
                }
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
                            <div style="min-width: 200px; font-family: sans-serif;">
                                <h6 style="font-weight: 700; margin-bottom: 8px; color: #173b75;">${nama}</h6>
                                <hr style="margin: 6px 0;">
                                <small class="text-muted">Kecamatan:</small><br>
                                <strong>${item.nama_kecamatan ?? '-'}</strong><br><br>
                                <small class="text-muted">Kategori:</small><br>
                                <strong>${kategori}</strong><br><br>
                                <small class="text-muted">Keterangan:</small><br>
                                <strong>${item.keterangan ?? '-'}</strong>
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

    // FIT KE SEMUA DATA
    Promise.all(promises).then(function () {
        if (layers.length === 0) return;
        const group = L.featureGroup(layers);
        if (group.getBounds().isValid()) {
            map.fitBounds(group.getBounds(), { padding: [30, 30] });
        }
    });

    // FIX LEAFLET RENDER & REDRAW
    setTimeout(function () {
        map.invalidateSize();
    }, 300);
});
</script>

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
            
        </div>
</main>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<?= $this->include('admin/layout/footer') ?>