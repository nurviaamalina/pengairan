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
                                    <i class="bi bi-list fs-1"></i>

                                    <h6 class="mt-3">
                                        Korsda
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
                                    <i class="bi bi-telephone fs-1"></i>

                                    <h6 class="mt-3">Layanan Pengaduan</h6>

                                    <small class="text-muted">
                                        Monitoring sumber daya air secara terintegrasi.
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

                                    <h6 class="mt-3">Live CCTV</h6>

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
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15795.284123220945!2d114.38147724999999!3d-8.22074595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15adf979095a9%3A0x1c00c5eb5b542e20!2sKec.%20Banyuwangi%2C%20Kabupaten%20Banyuwangi%2C%20Jawa%20Timur%2068411!5e0!3m2!1sid!2sid!4v1784694141106!5m2!1sid!2sid"
                                width="100%"
                                height="450"
                                style="border:0;"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin">
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