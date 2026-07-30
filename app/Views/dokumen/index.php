<?= $this->include('layout/header') ?>

<section class="hero-section">
    <div class="container text-center">
        <h1 class="hero-title">DOKUMEN RESMI</h1>
        <p class="hero-subtitle">
            Regulasi dan Peraturan Pengairan
        </p>
    </div>
</section>

<section class="dokumen-section">

    <div class="container">

        <div class="dokumen-wrapper">

            <div class="row g-3 align-items-center mb-4">

                <div class="col-lg-6">
                    <div class="search-box">
                        <i class="fas fa-search"></i>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="Cari Dokumen">
                    </div>
                </div>

                <div class="col-lg-3">
                    <select class="form-select filter-select">
                        <option>Semua Kategori</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <select class="form-select filter-select">
                        <option>Tahun</option>
                    </select>
                </div>

            </div>

            <p class="result-count">
                Menampilkan <?= count($kategori) ?>
                dari <?= count($kategori) ?> Dokumen
            </p>

            <?php foreach($kategori as $row): ?>

                <a href="<?= base_url('dokumen/'.$row['id']) ?>"
                   class="kategori-card">

                    <div class="folder-icon">
                        <i class="fa-regular fa-folder"></i>
                    </div>

                    <div class="kategori-title">
                        <?= esc($row['nama_kategori']) ?>
                    </div>

                </a>

            <?php endforeach ?>

        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>