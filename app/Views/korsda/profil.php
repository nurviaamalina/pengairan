<?= $this->include('layout/header') ?>

<?php $uri = service('uri'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/korsda.css') ?>">

<!-- HERO -->
<section class="hero-korsda">
    <div class="container text-center">
        <h1>Korsda</h1>
        <h2>Kecamatan Banyuwangi</h2>
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

    <?php if (!empty($profil)) : ?>

        <h2 class="fw-bold mb-2">
            Struktur KORSDA Kecamatan <?= esc($korsda['nama_kecamatan']) ?>
        </h2>

        <p class="text-muted mb-4">
            Struktur Organisasi Koordinator Pengelola Sumber Daya Air di Kecamatan
            <?= esc($korsda['nama_kecamatan']) ?>
        </p>

        <h3>Visi</h3>
        <p><?= esc($profil['visi']) ?></p>

        <h3>Misi</h3>
        <p><?= nl2br(esc($profil['misi'])) ?></p>

        <h3>Tugas</h3>
        <p><?= nl2br(esc($profil['tugas'])) ?></p>

        <?php if (!empty($profil['struktur'])) : ?>
            <h3>Struktur KORSDA</h3>
            <div class="text-center">
                <img src="<?= base_url('uploads/struktur/'.$profil['struktur']) ?>"
                     class="img-fluid"
                     alt="Struktur KORSDA">
            </div>
        <?php endif; ?>

    <?php else : ?>

        <div class="alert alert-warning text-center mt-4">
            <h5 class="mb-2 ">Profil Belum Tersedia</h5>
            <p class="mb-0">
                Data profil KORSDA untuk kecamatan ini belum diinput oleh administrator.
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