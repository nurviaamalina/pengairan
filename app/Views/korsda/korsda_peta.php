<?= $this->include('layout/header') ?>

<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<section class="hero-korsda">
    <div class="container text-center">
        <h1>KORSDA</h1>
        <h2><?= esc($korsda['nama_kecamatan']) ?></h2>
    </div>
</section>

<div class="container">

    <div class="korsda-tabs">

        <a href="<?= base_url('korsda/profil/'.$korsda['id']) ?>">
            Profil
        </a>

        <a href="<?= base_url('korsda/peta/'.$korsda['id']) ?>" class="active">
            Peta Wilayah Kerja
        </a>

        <a href="<?= base_url('korsda/kegiatan/'.$korsda['id']) ?>">
            Kegiatan
        </a>

    </div>

</div>

<div class="container py-5">

    <h3 class="mb-4">
        Peta Wilayah Kerja <?= esc($korsda['nama_kecamatan']) ?>
    </h3>

    <?php if (!empty($wilayah)) : ?>

        <div class="card shadow">
            <div class="card-body">

                <div id="map" style="height:600px;"></div>

            </div>
        </div>

        <script>
// 1. Inisialisasi Peta dengan koordinat default (misal: Banyuwangi / Jawa Timur)
var map = L.map('map').setView([-8.2192, 114.3692], 12);

// 2. Tile Layer OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    subdomains: ['a', 'b', 'c'],
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var group = L.featureGroup().addTo(map);
var fetchPromises = [];

<?php foreach ($wilayah as $row): ?>
var geojsonUrl = "<?= base_url('uploads/wilayah/' . $row['file_geojson']) ?>";

var p = fetch(geojsonUrl)
    .then(res => {
        if (!res.ok) throw new Error("HTTP " + res.status + " saat akses " + geojsonUrl);
        return res.json();
    })
    .then(data => {
        var layer = L.geoJSON(data, {
            onEachFeature: function(feature, layer) {
                layer.bindPopup(
                    "<b><?= esc($row['nama_wilayah']) ?></b><br>" +
                    "Keterangan: <?= esc($row['keterangan']) ?>"
                );
            }
        });
        group.addLayer(layer);
    })
    .catch(err => {
        console.error("Gagal load GeoJSON:", err);
    });

fetchPromises.push(p);
<?php endforeach; ?>

// 3. Eksekusi penyesuaian posisi kamera setelah semua data selesai diambil
Promise.all(fetchPromises).then(() => {
    if (group.getLayers().length > 0) {
        map.fitBounds(group.getBounds());
    }
    
    // Paksa Leaflet menghitung ulang ukuran layar agar tidak abu-abu
    setTimeout(function() {
        map.invalidateSize();
    }, 300);
});
</script>

    <?php else : ?>

        <div class="alert alert-warning">
            Data wilayah kerja belum tersedia.
        </div>

    <?php endif; ?>

</div>

<?= $this->include('layout/footer') ?>