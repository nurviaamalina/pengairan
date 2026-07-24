<?= $this->include('layout/header') ?>
<?php helper('text'); ?>
<?php $uri = service('uri'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/kegiatankorsda.css') ?>">

<!-- HERO -->
<section class="hero-korsda">
    <div class="container text-center">
        <h1>Korsda</h1>
        <h2>Kecamatan <?= esc($korsda['nama_kecamatan']) ?></h2>
    </div>
</section>

<!-- MENU TAB -->
<div class="container">
    <div class="korsda-tabs">

        <a href="<?= base_url('korsda/profil/'.$korsda['id']) ?>"
           class="tab-link <?= $uri->getSegment(2) == 'profil' ? 'active' : '' ?>">
            Profil
        </a>

        <a href="<?= base_url('korsda/peta/'.$korsda['id']) ?>"
           class="tab-link <?= $uri->getSegment(2) == 'peta' ? 'active' : '' ?>">
            Peta Wilayah Kerja
        </a>

        <a href="<?= base_url('korsda/kegiatan/'.$korsda['id']) ?>"
           class="tab-link <?= $uri->getSegment(2) == 'kegiatan' ? 'active' : '' ?>">
            Kegiatan
        </a>

        <a href="<?= base_url('korsda/gis/'.$korsda['id']) ?>"
           class="tab-link <?= $uri->getSegment(2) == 'gis' ? 'active' : '' ?>">
            GIS
        </a>

    </div>
</div>

<!-- KONTEN -->
<section class="korsda-content">
    <div class="container">

        <?php if(!empty($kegiatan)) : ?>

           <?php foreach($kegiatan as $row) : ?>

<a href="<?= base_url('korsda/detail_kegiatan/'.$row['id']) ?>"
   class="kegiatan-item">

    <div class="kegiatan-img">

        <?php if(!empty($row['gambar'])) : ?>

            <img src="<?= base_url('uploads/kegiatan/'.$row['gambar']) ?>"
                 alt="<?= esc($row['judul']) ?>">

        <?php else : ?>

            <img src="<?= base_url('assets/img/no-image.png') ?>">

        <?php endif; ?>

    </div>

    <div class="kegiatan-body">

        <h3><?= esc($row['judul']) ?></h3>

        <p class="tanggal">
            <?= date('l, d F Y', strtotime($row['tanggal'])) ?>
        </p>

    </div>

</a>

<?php endforeach; ?>

        <?php else : ?>

            <div class="alert alert-warning text-center">

                <h5>Belum Ada Kegiatan</h5>

                <p class="mb-0">
                    Belum ada kegiatan yang diinput untuk Kecamatan
                    <?= esc($korsda['nama_kecamatan']) ?>.
                </p>

            </div>

        <?php endif; ?>
            <div class="back-wrapper">
            <button
                type="button"
                class="btn btn-outline-primary btn-kembali"
                onclick="window.location.href='<?= base_url('korsda') ?>'">

                <i class="bi bi-arrow-left me-2"></i>
                Kembali

            </button>
        </div>
    </div>
</section>



<?= $this->include('layout/footer') ?>