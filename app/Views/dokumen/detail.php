<?= $this->include('layout/header') ?>

<section class="hero-detail">
    <div class="container">
        <h1><?= esc($kategori['nama_kategori']) ?></h1>
    </div>
</section>

<section class="detail-section">
    <div class="container">

        <div class="detail-wrapper">

            <!-- FILTER -->
            <div class="filter-wrapper">

                <div class="search-item">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Cari Dokumen">
                    </div>
                </div>

                <div class="kategori-item">
                    <select>
                        <option>Semua Kategori</option>
                    </select>
                </div>

                <div class="tahun-item">
                    <select>
                        <option>Tahun</option>
                    </select>
                </div>

            </div>

            <!-- LIST DOKUMEN -->
            <?php foreach ($dokumen as $row): ?>

                <div class="dokumen-card">

                    <div class="dokumen-left">

                        <div class="folder-icon">
                            <i class="fa-regular fa-folder"></i>
                        </div>

                        <div class="dokumen-title">
                            <?= esc($row['judul']) ?>
                        </div>

                    </div>

                    <div class="dokumen-right">
                        <a href="<?= base_url('dokumen/download/' . $row['id']) ?>" class="btn-download">
                            Unduh
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

            <!-- Card Kembali -->
            <a href="<?= base_url('dokumen') ?>" class="btn-card-kembali">
                <div class="dokumen-card card-kembali">

                    <div class="dokumen-left">

                        <div class="folder-icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>

                        <div class="dokumen-title">
                            Kembali ke Daftar Dokumen
                        </div>

                    </div>

                </div>
            </a>

        </div>

    </div>
</section>

<?= $this->include('layout/footer') ?>