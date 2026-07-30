<?= $this->include('layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatankorsda.css') ?>">

<div class="container py-5">

    <nav class="mb-4">

        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="<?= base_url() ?>">Beranda</a>
            </li>

            <li class="breadcrumb-item">
                <a href="<?= base_url('korsda') ?>">Korsda</a>
            </li>

            <li class="breadcrumb-item active">
                Detail Kegiatan
            </li>

        </ol>

    </nav>

    <div class="detail-kegiatan">

        <div class="detail-kegiatan-img">

            <?php if($kegiatan['gambar']) : ?>

                <img src="<?= base_url('uploads/kegiatan/'.$kegiatan['gambar']) ?>">

            <?php endif; ?>

        </div>

        <div class="detail-kegiatan-info">

            <h1><?= esc($kegiatan['judul']) ?></h1>

            <div class="tanggal">

                <i class="bi bi-calendar-event"></i>

                <?= date('d F Y', strtotime($kegiatan['tanggal'])) ?>

            </div>

        </div>

    </div>

    <div class="detail-isi mt-5">

        <?= $kegiatan['isi'] ?>

    </div>

    <div class="back-wrapper">

        <a href="<?= previous_url() ?>" class="btn btn-kembali">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

</div>

<?= $this->include('layout/footer') ?>