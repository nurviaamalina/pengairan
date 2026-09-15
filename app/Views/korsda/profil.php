<?= $this->include('layout/header') ?>

<?php $uri = service('uri'); ?>

<link rel="stylesheet" href="<?= base_url('assets/css/korsda.css') ?>">


<!-- =====================================================
     HERO KORSDA
===================================================== -->

<section class="hero-korsda">

    <div class="container text-center">

        <h1>
            KORSDA
        </h1>

        <h2>
            Kecamatan <?= esc($korsda['nama_kecamatan']) ?>
        </h2>

    </div>

</section>



<!-- =====================================================
     TAB KORSDA
===================================================== -->

<div class="container tab-container">

    <div class="korsda-tabs">


        <!-- PROFIL -->

        <a
            href="<?= base_url('korsda/profil/' . $korsda['id']) ?>"
            class="tab-link <?= $uri->getSegment(2) == 'profil' ? 'active' : '' ?>"
        >
            Profil
        </a>


        <!-- PETA WILAYAH -->

        <a
            href="<?= base_url('korsda/peta/' . $korsda['id']) ?>"
            class="tab-link <?= $uri->getSegment(2) == 'peta' ? 'active' : '' ?>"
        >
            Peta Wilayah Kerja
        </a>


        <!-- KEGIATAN -->

        <a
            href="<?= base_url('korsda/kegiatan/' . $korsda['id']) ?>"
            class="tab-link <?= $uri->getSegment(2) == 'kegiatan' ? 'active' : '' ?>"
        >
            Kegiatan
        </a>


    </div>

</div>



<!-- =====================================================
     CONTENT PROFIL
===================================================== -->

<section class="korsda-content">

    <div class="container">


        <?php if (
            !empty($profil) &&
            !empty($profil['struktur_organisasi'])
        ) : ?>


            <!-- =================================================
                 JUDUL
            ================================================== -->

            <div class="struktur-header">

                <h2>
                    Struktur KORSDA Kecamatan
                    <?= esc(
                        $korsda['nama_wilayah']
                        ?? $korsda['nama_kecamatan']
                    ) ?>
                </h2>


                <p>
                    Struktur Organisasi Koordinator Pengelola
                    Sumber Daya Air di Kecamatan
                    <?= esc(
                        $korsda['nama_wilayah']
                        ?? $korsda['nama_kecamatan']
                    ) ?>
                </p>

            </div>



            <!-- =================================================
                 GAMBAR STRUKTUR
            ================================================== -->

            <div class="struktur-image-wrapper">

                <img
                    src="<?= base_url(
                        'uploads/korsda/' .
                        $profil['struktur_organisasi']
                    ) ?>"
                    class="struktur-image"
                    alt="Struktur Organisasi KORSDA Kecamatan <?= esc(
                        $korsda['nama_kecamatan']
                    ) ?>"
                >

            </div>


        <?php else : ?>


            <!-- =================================================
                 STRUKTUR BELUM TERSEDIA
            ================================================== -->

            <div class="struktur-empty">

                <h5>
                    Struktur KORSDA Belum Tersedia
                </h5>

                <p>
                    Data struktur organisasi KORSDA untuk
                    kecamatan ini belum diinput oleh administrator.
                </p>

            </div>


        <?php endif; ?>



        <!-- =================================================
             KEMBALI
        ================================================== -->

        <div class="back-wrapper">

            <button
                type="button"
                class="btn btn-kembali"
                onclick="window.location.href='<?= base_url('korsda') ?>'"
            >

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </button>

        </div>


    </div>

</section>



<?= $this->include('layout/footer') ?>