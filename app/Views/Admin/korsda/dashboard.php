<?= $this->include('admin/layout/header') ?>

<div class="d-flex min-vh-100">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>


    <!-- MAIN CONTENT -->
    <div class="content flex-grow-1 bg-light">

        <!-- ================================
             DASHBOARD CONTENT
        ================================= -->
        <main class="korsda-dashboard-content">

            <!-- HEADER -->
            <div class="dashboard-heading">

                <div>
                    <span class="heading-label">
                        <i class="bi bi-grid-fill"></i>
                        KORSDA
                    </span>

                    <h1>Dashboard KORSDA</h1>

                    <p>
                        Kelola seluruh data KORSDA Kabupaten Banyuwangi
                    </p>
                </div>

                <a href="<?= base_url('admin/dashboard') ?>"
                   class="btn-dashboard-back">

                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>


            <!-- ================================
                 STATISTIK
            ================================= -->
            <div class="korsda-statistics">

                <!-- KECAMATAN -->
                <a href="<?= base_url('admin/korsda/kecamatan') ?>"
                   class="stat-card stat-yellow">

                    <div class="stat-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>

                    <div class="stat-title">
                        Kecamatan
                    </div>

                    <div class="stat-number">
                        <?= $jumlahKecamatan ?>
                    </div>

                    <div class="stat-link">
                        Lihat data
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>


                <!-- DATA KORSDA -->
                <a href="<?= base_url('admin/korsda/data') ?>"
                   class="stat-card stat-blue">

                    <div class="stat-icon">
                        <i class="bi bi-building"></i>
                    </div>

                    <div class="stat-title">
                        Data KORSDA
                    </div>

                    <div class="stat-number">
                        <?= $jumlahKorsda ?>
                    </div>

                    <div class="stat-link">
                        Lihat data
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>


                <!-- PROFIL -->
                <a href="<?= base_url('admin/korsda/profil') ?>"
                   class="stat-card stat-green">

                    <div class="stat-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <div class="stat-title">
                        Profil KORSDA
                    </div>

                    <div class="stat-number">
                        <?= $jumlahProfil ?>
                    </div>

                    <div class="stat-link">
                        Lihat data
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>


                <!-- WILAYAH -->
                <a href="<?= base_url('admin/korsda/wilayah') ?>"
                   class="stat-card stat-orange">

                    <div class="stat-icon">
                        <i class="bi bi-map"></i>
                    </div>

                    <div class="stat-title">
                        Wilayah Kerja
                    </div>

                    <div class="stat-number">
                        <?= $jumlahWilayah ?>
                    </div>

                    <div class="stat-link">
                        Lihat data
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>


                <!-- KEGIATAN -->
                <a href="<?= base_url('admin/korsda/kegiatan') ?>"
                   class="stat-card stat-red">

                    <div class="stat-icon">
                        <i class="bi bi-newspaper"></i>
                    </div>

                    <div class="stat-title">
                        Kegiatan
                    </div>

                    <div class="stat-number">
                        <?= $jumlahKegiatan ?>
                    </div>

                    <div class="stat-link">
                        Lihat data
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>

            </div>


            <!-- ================================
                 AKTIVITAS TERBARU
            ================================= -->
            <div class="activity-card">

                <div class="activity-header">

                    <div class="activity-title">

                        <div class="activity-icon">
                            <i class="bi bi-activity"></i>
                        </div>

                        <div>
                            <h3>Aktivitas Terbaru</h3>

                            <p>
                                Data KORSDA yang terakhir ditambahkan
                            </p>
                        </div>

                    </div>

                    <a href="<?= base_url('admin/korsda/data') ?>"
                       class="activity-view">

                        Lihat semua
                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>


                <div class="table-responsive">

                    <table class="korsda-table">

                        <thead>

                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Nama KORSDA</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php if (!empty($korsdaTerbaru)) : ?>

                                <?php $no = 1; ?>

                                <?php foreach ($korsdaTerbaru as $row) : ?>

                                    <tr>

                                        <td>
                                            <?= $no++ ?>
                                        </td>

                                        <td>

                                            <div class="table-location">

                                                <i class="bi bi-geo-alt"></i>

                                                <?= esc($row['nama_kecamatan']) ?>

                                            </div>

                                        </td>

                                        <td>
                                            <strong>
                                                <?= esc($row['nama']) ?>
                                            </strong>
                                        </td>

                                        <td>

                                            <span class="status-active">

                                                <i class="bi bi-check-circle-fill"></i>

                                                Data tersedia

                                            </span>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else : ?>

                                <tr>

                                    <td colspan="4"
                                        class="empty-data">

                                        <i class="bi bi-inbox"></i>

                                        Belum ada data KORSDA.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


            <!-- ================================
                 INFORMASI
            ================================= -->
            <div class="dashboard-info">

                <div class="info-box">

                    <div class="info-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>

                    <div>

                        <strong>
                            Informasi Dashboard
                        </strong>

                        <p>
                            Gunakan menu statistik untuk mengelola
                            data KORSDA, profil, wilayah kerja,
                            dan kegiatan.
                        </p>

                    </div>

                </div>

                <div class="dashboard-version">

                    Sistem Informasi KORSDA<br>

                    <span>
                        Versi 1.0.0
                    </span>

                </div>

            </div>

        </main>


        <!-- FOOTER -->
        <footer class="dashboard-footer">

            <span>
                © <?= date('Y') ?>
                Dinas Pengairan Kabupaten Banyuwangi.
            </span>

            <span>
                KORSDA Kabupaten Banyuwangi
            </span>

        </footer>

    </div>

</div>


<?= $this->include('admin/layout/footer') ?>