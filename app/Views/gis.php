<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/gis.css') ?>">

<section class="gis-banner">
    <div class="container text-center">

        <h1>GIS Kabupaten Banyuwangi</h1>

        <p>
            Sistem Informasi Geografis Sumber Daya Air dan
            Infrastruktur Pengairan
        </p>

    </div>
</section>

<section class="gis-content">

    <div class="container">

        <div class="breadcrumb-box">

            <a href="<?= base_url() ?>">Beranda</a>

            >

            <span>GIS</span>

        </div>


        <div class="row mt-4">

            <!-- FILTER -->

            <div class="col-md-3">

                <div class="filter-card">

                    <div class="filter-header">
                        ☰ Filter Peta
                    </div>

                    <div class="p-3">

                        <select class="form-select mb-3">

                            <option>Pilih Kecamatan</option>

                            <option>Banyuwangi</option>

                            <option>Rogojampi</option>

                            <option>Genteng</option>

                            <option>Glenmore</option>

                        </select>

                        <h6>Infrastruktur Pengairan</h6>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Jaringan Irigasi
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Bendungan
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Embung
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">
                                Bangunan Air
                            </label>
                        </div>

                        <button class="btn btn-light w-100 mt-4">
                            Reset Filter
                        </button>

                    </div>

                </div>

            </div>


            <!-- MAP -->

            <div class="col-md-9">

                <div id="map"></div>

            </div>

        </div>

        <div class="legend mt-4">

            <strong>Kategori Infrastruktur</strong>

            <span class="badge bg-primary">Jaringan Irigasi</span>

            <span class="badge bg-success">Bendungan</span>

            <span class="badge bg-warning text-dark">Embung</span>

            <span class="badge bg-secondary">Bangunan Air</span>

        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>