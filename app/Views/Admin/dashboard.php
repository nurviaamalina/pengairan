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
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <i class="bi bi-geo-alt fs-1"></i>

                                    <h6 class="mt-3">
                                        Geografis Information System
                                    </h6>

                                    <small class="text-muted">
                                        Jelajahi peta digital jaringan sungai,
                                        irigasi dan bendungan.
                                    </small>

                                    <div class="mt-4">
                                        <a href="#">Selengkapnya →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <i class="bi bi-list fs-1"></i>

                                    <h6 class="mt-3">SI AIR</h6>

                                    <small class="text-muted">
                                        Monitoring sumber daya air secara terintegrasi.
                                    </small>

                                    <div class="mt-4">
                                        <a href="#">Selengkapnya →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <i class="bi bi-building fs-1"></i>

                                    <h6 class="mt-3">Data Center</h6>

                                    <small class="text-muted">
                                        Infrastruktur pengairan dan bendungan.
                                    </small>

                                    <div class="mt-4">
                                        <a href="#">Selengkapnya →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-md-3">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body">
                                    <i class="bi bi-telephone fs-1"></i>

                                    <h6 class="mt-3">Layanan Pengaduan</h6>

                                    <small class="text-muted">
                                        Laporkan masalah dengan mudah.
                                    </small>

                                    <div class="mt-4">
                                        <a href="#">Selengkapnya →</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- MAP -->
                    <div class="card border-0 shadow-sm rounded-4 mt-4">
                        <div class="card-body">

                            <h5>Peta Jaringan Irigasi</h5>

                            <iframe
                                src="https://maps.google.com/maps?q=jakarta&t=&z=12&ie=UTF8&iwloc=&output=embed"
                                width="100%"
                                height="300"
                                style="border:0;">
                            </iframe>

                        </div>
                    </div>

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