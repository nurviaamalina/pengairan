<?= $this->include('layout/header') ?>

<section class="hero-detail">
    <div class="container">
        <h1><?= esc($kategori['nama_kategori']) ?></h1>
    </div>
</section>

<section class="detail-section">
    <div class="container">

        <div class="detail-wrapper">

            <!-- Filter -->
            <form action="<?= base_url('dokumen/detail/' . $kategori['id']) ?>" method="get">

                <div class="filter-wrapper">

                    <!-- Cari -->
                    <div class="search-item">
                        <!-- <div class="search-box">
                            <i class="fas fa-search"></i>

                            <input
                                type="text"
                                class="form-control"
                                name="keyword"
                                placeholder="Cari Dokumen"
                                value="<?= esc($keyword ?? '') ?>">
                        </div> -->
                    </div>

                    <!-- Kategori -->
                    <div class="kategori-item">

                        <select
                            name="kategori"
                            class="form-select">

                            <option value="">Semua Kategori</option>

                            <?php foreach ($allKategori as $k): ?>

                                <option
                                    value="<?= $k['id']; ?>"
                                    <?= ($kategoriDipilih == $k['id']) ? 'selected' : ''; ?>>

                                    <?= esc($k['nama_kategori']); ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- Tahun -->
                    <div class="tahun-item">

                        <select
                            name="tahun"
                            class="form-select">

                            <option value="">Tahun</option>

                            <?php foreach ($tahunList as $t): ?>

                                <option
                                    value="<?= $t['tahun']; ?>"
                                    <?= ($tahunDipilih == $t['tahun']) ? 'selected' : ''; ?>>

                                    <?= $t['tahun']; ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="button-item">

                        <button
                            type="submit"
                            class="btn btn-warning">

                            Cari

                        </button>

                    </div>

                </div>

            </form>

            <!-- Jumlah Dokumen -->
            <p class="result-count">
                Menampilkan <?= count($dokumen); ?> Dokumen
            </p>

            <!-- Daftar Dokumen -->
            <?php if (!empty($dokumen)): ?>

                <?php foreach ($dokumen as $row): ?>

                    <div class="dokumen-card">

                        <div class="dokumen-left">

                            <div class="folder-icon">
                                <i class="fa-regular fa-folder"></i>
                            </div>

                            <div class="dokumen-title">
                                <?= esc($row['judul']); ?>
                            </div>

                        </div>

                        <div class="dokumen-right">

                            <a
                                href="<?= base_url('dokumen/download/' . $row['id']); ?>"
                                class="btn-download">

                                Unduh

                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="alert alert-warning">
                    Tidak ada dokumen yang ditemukan.
                </div>

            <?php endif; ?>

            <!-- Tombol Kembali -->
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