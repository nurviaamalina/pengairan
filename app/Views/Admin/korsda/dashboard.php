<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

<?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

<div class="mb-4">
    <h2 class="fw-bold">Dashboard KORSDA</h2>
    <p class="text-muted">
        Kelola seluruh data KORSDA Kabupaten Banyuwangi
    </p>
</div>

<div class="row">

    <div class="col-lg-2 col-md-4 mb-4">
        <a href="<?= base_url('admin/korsda/data') ?>" class="text-decoration-none">

            <div class="card shadow border-0 dashboard-card">

                <div class="card-body text-center">

                    <div class="icon bg-primary">
                        <i class="bi bi-building"></i>
                    </div>

                    <h6>Data KORSDA</h6>

                    <h2><?= $jumlahKorsda ?></h2>

                </div>

            </div>

        </a>
    </div>

    <div class="col-lg-2 col-md-4 mb-4">

        <a href="<?= base_url('admin/korsda/profil') ?>" class="text-decoration-none">

            <div class="card shadow border-0 dashboard-card">

                <div class="card-body text-center">

                    <div class="icon bg-success">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <h6>Profil KORSDA</h6>

                    <h2><?= $jumlahProfil ?></h2>

                </div>

            </div>

        </a>

    </div>

    <div class="col-lg-2 col-md-4 mb-4">

        <a href="<?= base_url('admin/korsda/wilayah') ?>" class="text-decoration-none">

            <div class="card shadow border-0 dashboard-card">

                <div class="card-body text-center">

                    <div class="icon bg-warning">
                        <i class="bi bi-map"></i>
                    </div>

                    <h6>Wilayah Kerja</h6>

                    <h2><?= $jumlahWilayah ?></h2>

                </div>

            </div>

        </a>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <a href="<?= base_url('admin/korsda/gis') ?>" class="text-decoration-none">

            <div class="card shadow border-0 dashboard-card">

                <div class="card-body text-center">

                    <div class="icon bg-info">
                        <i class="bi bi-globe2"></i>
                    </div>

                    <h6>GIS</h6>

                    <h2><?= $jumlahGis ?></h2>

                </div>

            </div>

        </a>

    </div>

    <div class="col-lg-3 col-md-6 mb-4">

        <a href="<?= base_url('admin/korsda/kegiatan') ?>" class="text-decoration-none">

            <div class="card shadow border-0 dashboard-card">

                <div class="card-body text-center">

                    <div class="icon bg-danger">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <h6>Kegiatan</h6>

                    <h2><?= $jumlahKecamatan ?></h2>

                </div>

            </div>

        </a>

    </div>

</div>

<div class="card shadow border-0">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Aktivitas Terbaru
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Kecamatan</th>

                    <th>Ketua</th>

                </tr>

            </thead>

            <tbody>

            <?php $no=1; ?>

            <?php foreach($korsdaTerbaru as $row): ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td><?= $row['nama_kecamatan'] ?></td>

                    <td><?= $row['ketua'] ?></td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
<div class="mt-3">
            <button
                type="button"
                class="btn btn-kembali"
                onclick="window.location.href='<?= base_url('admin/dashboard') ?>'">

                <i class="bi bi-arrow-left me-2"></i>
                Kembali

            </button>
        </div>
</div>

</div>

<?= $this->include('admin/layout/footer') ?>