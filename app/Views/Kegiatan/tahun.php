<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<section class="berita-page">

    <div class="container">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('kegiatan') ?>">Kegiatan</a>
                </li>

                <li class="breadcrumb-item active">
                    Tahun <?= esc($tahun) ?>
                </li>

            </ol>

        </nav>

        <!-- Hero -->
        <div class="hero-kegiatan">

            <h1>Recap Kegiatan Dinas Pengairan</h1>

            <h6>Tahun <?= esc($tahun) ?></h6>

            <p>
                Rangkuman Kegiatan Dinas Pengairan
                Selama Tahun <?= esc($tahun) ?>
            </p>

        </div>

        <!-- Card -->
        <div class="row g-4">

            <?php if(!empty($kegiatan)): ?>

                <?php foreach($kegiatan as $item): ?>

                    <div class="col-lg-4 col-md-6">

                        <a href="<?= base_url('kegiatan/'.$item['slug']) ?>" class="card-kegiatan">

                            <img
                                src="<?= base_url('uploads/kegiatan/thumbnail/'.$item['thumbnail']) ?>"
                                alt="<?= esc($item['judul']) ?>">

                            <div class="overlay">

                                <h6><?= esc($item['judul']) ?></h6>

                            </div>

                        </a>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12 text-center">

                    <h5>
                        Belum ada kegiatan pada Tahun <?= esc($tahun) ?>
                    </h5>

                </div>

            <?php endif; ?>

        </div>

        <!-- Button -->
        <div class="mt-5">

            <button
                type="button"
                class="btn btn-kembali"
                onclick="history.back()">

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </button>

        </div>

    </div>

</section>

<?= $this->include('layout/footer') ?>