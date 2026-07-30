<?= $this->include('layout/header') ?>

<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<section class="hero-korsda">
    <div class="container text-center">
        <h1>Korsda</h1>
        <h2><?= esc($korsda['nama_kecamatan']) ?></h2>
    </div>
</section>

<div class="container">

    <div class="korsda-tabs">

        <a href="<?= base_url('korsda/profil/'.$korsda['id']) ?>" class="tab-link">
            Profil
        </a>

        <a href="<?= base_url('korsda/peta/'.$korsda['id']) ?>" class="tab-link active">
            Peta Wilayah Kerja
        </a>

        <a href="<?= base_url('korsda/kegiatan/'.$korsda['id']) ?>" class="tab-link">
            Kegiatan
        </a>

    </div>

</div>

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Peta Wilayah KORSDA <?= esc($korsda['nama_kecamatan']) ?>
    </h2>

    <?php if (!empty($wilayah)) : ?>

        <div class="card shadow-sm">

            <div class="card-body">

                <div id="map"
                    style="height:500px;width:100%;border:1px solid #ccc;border-radius:10px;">
                </div>

            </div>

        </div>

        <script>

            var map = L.map('map');

            L.tileLayer(
'https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',
{
    maxZoom:20,
    subdomains:['mt0','mt1','mt2','mt3']
}).addTo(map);

            var bounds = [];

            <?php foreach($wilayah as $row): ?>

                var marker = L.marker([
                    <?= $row['latitude'] ?>,
                    <?= $row['longitude'] ?>
                ]).addTo(map);

                marker.bindPopup(`
                    <b><?= esc($row['nama_lokasi']) ?></b><br>
                    <?= esc($row['keterangan']) ?>
                `);

                bounds.push([
                    <?= $row['latitude'] ?>,
                    <?= $row['longitude'] ?>
                ]);

            <?php endforeach; ?>

            if(bounds.length > 0){
                map.fitBounds(bounds);
            }

        </script>

        <div class="row mt-4">

            <div class="col-12">

                <div class="card shadow-sm">

                    <div class="card-header bg-primary text-white">
                        Daftar Lokasi Wilayah Kerja
                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th width="60">No</th>
                                        <th>Nama Lokasi</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Zoom</th>
                                        <th>Keterangan</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php $no=1; ?>

                                    <?php foreach($wilayah as $row): ?>

                                        <tr>

                                            <td><?= $no++ ?></td>

                                            <td><?= esc($row['nama_lokasi']) ?></td>

                                            <td><?= esc($row['latitude']) ?></td>

                                            <td><?= esc($row['longitude']) ?></td>

                                            <td><?= esc($row['zoom']) ?></td>

                                            <td><?= esc($row['keterangan']) ?></td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    <?php else: ?>

        <div class="alert alert-warning">
            Data wilayah kerja belum tersedia.
        </div>

    <?php endif; ?>

    <div class="back-wrapper mt-4">

        <button
            class="btn btn-outline-primary btn-kembali"
            onclick="window.location.href='<?= base_url('korsda') ?>'">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </button>

    </div>

</div>

<?= $this->include('layout/footer') ?>