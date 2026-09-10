<?= $this->include('layout/header') ?>

<?php helper('text'); ?>
<?php $uri = service('uri'); ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatankorsda.css') ?>"
>


<!-- =====================================================
     HERO
===================================================== -->

<section class="hero-korsda">

    <div class="container text-center">

        <h1>
            Korsda
        </h1>

        <h2>
            Kecamatan <?= esc($korsda['nama_kecamatan']) ?>
        </h2>

    </div>

</section>



<!-- =====================================================
     MENU TAB
===================================================== -->

<div class="container">

    <div class="korsda-tabs">


        <!-- PROFIL -->

        <a
            href="<?= base_url(
                'korsda/profil/' .
                $korsda['id']
            ) ?>"
            class="tab-link <?= $uri->getSegment(2) == 'profil'
                ? 'active'
                : '' ?>"
        >

            Profil

        </a>


        <!-- PETA -->

        <a
            href="<?= base_url(
                'korsda/peta/' .
                $korsda['id']
            ) ?>"
            class="tab-link <?= $uri->getSegment(2) == 'peta'
                ? 'active'
                : '' ?>"
        >

            Peta Wilayah Kerja

        </a>


        <!-- KEGIATAN -->

        <a
            href="<?= base_url(
                'korsda/kegiatan/' .
                $korsda['id']
            ) ?>"
            class="tab-link <?= $uri->getSegment(2) == 'kegiatan'
                ? 'active'
                : '' ?>"
        >

            Kegiatan

        </a>

    </div>

</div>



<!-- =====================================================
     KONTEN KEGIATAN
===================================================== -->

<section class="korsda-content">

    <div class="container">


        <?php if (!empty($kegiatan)) : ?>


            <?php foreach ($kegiatan as $row) : ?>


                <a
                    href="<?= base_url(
                        'korsda/detail_kegiatan/' .
                        $row['id']
                    ) ?>"
                    class="kegiatan-item"
                >


                    <!-- =================================================
                         GAMBAR UTAMA
                    ================================================== -->

                    <div class="kegiatan-img">

                        <?php

                        /*
                        |--------------------------------------------------------------------------
                        | PATH BARU
                        |--------------------------------------------------------------------------
                        */

                        $pathBaru =
                            FCPATH .
                            'uploads/Kegiatan/thumbnail/' .
                            ($row['gambar'] ?? '');


                        /*
                        |--------------------------------------------------------------------------
                        | PATH LAMA
                        |--------------------------------------------------------------------------
                        | Untuk data lama yang mungkin masih berada
                        | di uploads/kegiatan/
                        */

                        $pathLama =
                            FCPATH .
                            'uploads/kegiatan/' .
                            ($row['gambar'] ?? '');


                        /*
                        |--------------------------------------------------------------------------
                        | TENTUKAN URL GAMBAR
                        |--------------------------------------------------------------------------
                        */

                        if (
                            !empty($row['gambar']) &&
                            file_exists($pathBaru)
                        ) {

                            $gambarUrl =
                                base_url(
                                    'uploads/Kegiatan/thumbnail/' .
                                    $row['gambar']
                                );

                        } elseif (
                            !empty($row['gambar']) &&
                            file_exists($pathLama)
                        ) {

                            $gambarUrl =
                                base_url(
                                    'uploads/kegiatan/' .
                                    $row['gambar']
                                );

                        } else {

                            $gambarUrl =
                                base_url(
                                    'assets/img/no-image.png'
                                );
                        }

                        ?>


                        <img
                            src="<?= $gambarUrl ?>"
                            alt="<?= esc($row['judul']) ?>"
                            loading="lazy"
                        >

                    </div>



                    <!-- =================================================
                         INFORMASI KEGIATAN
                    ================================================== -->

                    <div class="kegiatan-body">

                        <h3>
                            <?= esc(
                                $row['judul']
                            ) ?>
                        </h3>


                        <?php if (!empty($row['tanggal'])) : ?>

                            <p class="tanggal">

                                <i class="bi bi-calendar-event me-1"></i>

                                <?= date(
                                    'l, d F Y',
                                    strtotime(
                                        $row['tanggal']
                                    )
                                ) ?>

                            </p>

                        <?php endif; ?>


                    </div>


                </a>


            <?php endforeach; ?>


        <?php else : ?>


            <!-- =================================================
                 BELUM ADA KEGIATAN
            ================================================== -->

            <div class="alert alert-warning text-center">

                <h5>
                    Belum Ada Kegiatan
                </h5>

                <p class="mb-0">

                    Belum ada kegiatan yang diinput untuk Kecamatan
                    <?= esc(
                        $korsda['nama_kecamatan']
                    ) ?>.

                </p>

            </div>


        <?php endif; ?>



        <!-- =====================================================
             KEMBALI
        ====================================================== -->

        <div class="back-wrapper">

            <button
                type="button"
                class="btn btn-outline-primary btn-kembali"
                onclick="
                    window.location.href='<?= base_url('korsda') ?>'
                "
            >

                <i class="bi bi-arrow-left me-2"></i>

                Kembali

            </button>

        </div>


    </div>

</section>



<?= $this->include('layout/footer') ?>