<?= $this->include('layout/header') ?>

<?php $uri = service('uri'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/korsda.css') ?>">

<!-- HERO -->
<section class="hero-korsda">
    <div class="container text-center">
       <h1>
    Korsda <br>
    Kecamatan <?= esc($korsda['nama_kecamatan']) ?>
</h1>
    </div>
</section>

<!-- MENU TAB -->
<div class="container">
    <!-- TAB KORSDA -->

<div class="korsda-tabs">

    <a
        href="<?= base_url('korsda/profil/' . $korsda['id']) ?>"
        class="tab-link <?= $uri->getSegment(2) == 'profil' ? 'active' : '' ?>"
    >
        Profil
    </a>

    <a
        href="<?= base_url('korsda/peta/' . $korsda['id']) ?>"
        class="tab-link <?= $uri->getSegment(2) == 'peta' ? 'active' : '' ?>"
    >
        Peta Wilayah Kerja
    </a>

    <a
        href="<?= base_url('korsda/kegiatan/' . $korsda['id']) ?>"
        class="tab-link <?= $uri->getSegment(2) == 'kegiatan' ? 'active' : '' ?>"
    >
        Kegiatan
    </a>

</div>


<!-- PROFIL -->

<?php if (!empty($profil)): ?>

    <h2 class="fw-bold mb-2">
        Struktur KORSDA Kecamatan
        <?= esc($korsda['nama_wilayah']) ?>
    </h2>

    <p class="text-muted mb-4">
    Struktur Organisasi Koordinator Pengelola
    Sumber Daya Air di Kecamatan
    <?= esc($korsda['nama_wilayah']) ?>
</p>


    <!-- VISI -->

    <?php if (!empty($profil['visi'])): ?>

        <h3>Visi</h3>

        <p>
            <?= nl2br(esc($profil['visi'])) ?>
        </p>

    <?php endif; ?>


    <!-- MISI -->

    <?php if (!empty($profil['misi'])): ?>

        <h3>Misi</h3>

        <p>
            <?= nl2br(esc($profil['misi'])) ?>
        </p>

    <?php endif; ?>


    <!-- TUGAS -->

    <?php if (!empty($profil['tugas'])): ?>

        <h3>Tugas</h3>

        <p>
            <?= nl2br(esc($profil['tugas'])) ?>
        </p>

    <?php endif; ?>


    <!-- FUNGSI -->

    <?php if (!empty($profil['fungsi'])): ?>

        <h3>Fungsi</h3>

        <p>
            <?= nl2br(esc($profil['fungsi'])) ?>
        </p>

    <?php endif; ?>


    <!-- STRUKTUR ORGANISASI -->

    <?php if (!empty($profil['struktur_organisasi'])): ?>

        <h3 class="mt-4">
            Struktur KORSDA
        </h3>

        <div class="text-center mt-3">

            <img
                src="<?= base_url(
                    'uploads/korsda/' .
                    $profil['struktur_organisasi']
                ) ?>"
                class="img-fluid rounded shadow-sm"
                alt="Struktur Organisasi KORSDA Kecamatan <?= esc($korsda['nama']) ?>"
                style="max-width: 100%; height: auto;"
            >

        </div>

    <?php endif; ?>


    <!-- DESKRIPSI -->

    <?php if (!empty($profil['deskripsi'])): ?>

        <h3 class="mt-4">
            Deskripsi
        </h3>

        <p>
            <?= nl2br(esc($profil['deskripsi'])) ?>
        </p>

    <?php endif; ?>


<?php else: ?>

    <div class="alert alert-warning text-center mt-4">

        <h5 class="mb-2">
            Profil Belum Tersedia
        </h5>

        <p class="mb-0">
            Data profil KORSDA untuk kecamatan ini
            belum diinput oleh administrator.
        </p>

    </div>

<?php endif; ?>


<!-- KEMBALI -->

<div class="back-wrapper mt-4">

    <button
        type="button"
        class="btn btn-outline-primary btn-kembali"
        onclick="window.location.href='<?= base_url('korsda') ?>'"
    >

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </button>
        </div>
    </div>
</section>


<?= $this->include('layout/footer') ?>