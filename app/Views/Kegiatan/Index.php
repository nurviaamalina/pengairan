<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatan.css') ?>">

<section class="berita-page">

    <div class="container py-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kegiatan
                </li>
            </ol>
        </nav>

        <?php if (!empty($kegiatan)) : ?>
        <?php endif; ?>

    </div>

</section>

<!-- Hero -->
<section class="tahun-list">

    <div class="container">

        <div class="hero-indexkegiatan">

            <h1>Recap Kegiatan Dinas Pengairan</h1>

            <p>
                Pilih tahun untuk melihat seluruh kegiatan
                Dinas Pengairan Kabupaten Banyuwangi.
            </p>

        </div>

        <div class="row g-4">

            <?php foreach ($tahun as $item): ?>

                <div class="col-lg-3 col-md-4 col-sm-6">

                    <a href="<?= base_url('kegiatan/tahun/'.$item['tahun']) ?>" class="tahun-card">

                        <img
                            src="<?= base_url('uploads/kegiatan/thumbnail/'.$item['thumbnail']) ?>"
                            alt="<?= esc($item['tahun']) ?>">

                        <div class="overlay">

                            <h5><?= esc($item['tahun']) ?></h5>

                        </div>

                    </a>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="d-flex justify-content-start mt-5">

            <a href="<?= base_url('/') ?>" class="btn btn-kembali">

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </a>

        </div>

    </div>

</section>



<?= $this->include('layout/footer') ?>