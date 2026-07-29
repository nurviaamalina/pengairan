<?= $this->include('admin/layout/header') ?>

<div class="d-flex min-vh-100">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">

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
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <i class="bi bi-telephone fs-1"></i>

                                    <h6 class="mt-3">Layanan Pengaduan</h6>

                                    <small class="text-muted">
                                        Monitoring sumber daya air secara terintegrasi.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <i class="bi bi-camera-video fs-1"></i>

                                    <h6 class="mt-3">Live CCTV</h6>

                                    <small class="text-muted">
                                        Laporkan masalah dengan mudah.
                                    </small>
                                </div>
                            </div>
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

const map = L.map('map');

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution:'© OpenStreetMap'
}).addTo(map);

let bounds = [];

<?php foreach($gis as $row): ?>

    <?php if(!empty($row['latitude']) && !empty($row['longitude'])): ?>

        var marker = L.marker([
            <?= $row['latitude'] ?>,
            <?= $row['longitude'] ?>
        ]).addTo(map);

        marker.bindPopup(`
            <strong><?= esc($row['nama_lokasi']) ?></strong><br>
            Kecamatan : <?= esc($row['nama_kecamatan']) ?><br>

            <?php if(!empty($row['keterangan'])): ?>
                <?= esc($row['keterangan']) ?>
            <?php endif; ?>
        `);

        bounds.push([
            <?= $row['latitude'] ?>,
            <?= $row['longitude'] ?>
        ]);

    <?php endif; ?>

<?php endforeach; ?>

if(bounds.length > 0){

    map.fitBounds(bounds,{
        padding:[30,30]
    });

}else{

    map.setView([-8.2192,114.3691],11);

}

</script>

                </div>

                <!-- Kanan -->
                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">

                            <h5>Berita</h5>

                            <?php for($i=1;$i<=3;$i++): ?>

                            <div class="d-flex mt-3">

                                <div class="bg-secondary rounded"
                                    style="width:80px;height:60px;"></div>

                                <div class="ms-3">
                                    <small>
                                        Laporkan permasalahan pengairan
                                        dengan mudah dan cepat.
                                    </small>
                                </div>

                            </div>

                            <?php endfor; ?>

                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mt-4">
                        <div class="card-body">

                            <h5>Gallery Kegiatan</h5>

                            <div class="row mt-3">

                                <?php for($i=1;$i<=3;$i++): ?>

                                <div class="col-4">
                                    <div class="bg-secondary rounded"
                                        style="height:90px;"></div>
                                </div>

                                <?php endfor; ?>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!-- Footer -->
        <?= $this->include('admin/layout/footer') ?>

    </div>

</div>
