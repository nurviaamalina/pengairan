<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatankorsda.css') ?>"
>


<div class="container py-5">


    <!-- =====================================================
         BREADCRUMB
    ====================================================== -->

    <nav class="mb-4">

        <ol class="breadcrumb">


            <li class="breadcrumb-item">

                <a href="<?= base_url() ?>">
                    Beranda
                </a>

            </li>


            <li class="breadcrumb-item">

                <a href="<?= base_url('korsda') ?>">
                    Korsda
                </a>

            </li>


            <li class="breadcrumb-item active">

                Detail Kegiatan

            </li>


        </ol>

    </nav>



    <!-- =====================================================
         DETAIL UTAMA
    ====================================================== -->

    <div class="detail-kegiatan">


        <!-- =================================================
             GAMBAR UTAMA
        ================================================== -->

        <div class="detail-kegiatan-img">

            <?php

            /*
            |--------------------------------------------------------------------------
            | PATH BARU
            |--------------------------------------------------------------------------
            */

            $pathBaru =
                FCPATH .
                'uploads/Kegiatan/thumbnail/' .
                ($kegiatan['gambar'] ?? '');


            /*
            |--------------------------------------------------------------------------
            | PATH LAMA
            |--------------------------------------------------------------------------
            */

            $pathLama =
                FCPATH .
                'uploads/kegiatan/' .
                ($kegiatan['gambar'] ?? '');


            /*
            |--------------------------------------------------------------------------
            | TENTUKAN URL
            |--------------------------------------------------------------------------
            */

            if (
                !empty($kegiatan['gambar']) &&
                file_exists($pathBaru)
            ) {

                $gambarUtama =
                    base_url(
                        'uploads/Kegiatan/thumbnail/' .
                        $kegiatan['gambar']
                    );

            } elseif (
                !empty($kegiatan['gambar']) &&
                file_exists($pathLama)
            ) {

                $gambarUtama =
                    base_url(
                        'uploads/kegiatan/' .
                        $kegiatan['gambar']
                    );

            } else {

                $gambarUtama =
                    base_url(
                        'assets/img/no-image.png'
                    );
            }

            ?>


            <img
                src="<?= $gambarUtama ?>"
                alt="<?= esc(
                    $kegiatan['judul']
                ) ?>"
            >

        </div>



        <!-- =================================================
             INFORMASI
        ================================================== -->

        <div class="detail-kegiatan-info">


            <h1>

                <?= esc(
                    $kegiatan['judul']
                ) ?>

            </h1>


            <?php if (!empty($kegiatan['tanggal'])) : ?>

                <div class="tanggal">

                    <i class="bi bi-calendar-event"></i>

                    <?= date(
                        'd F Y',
                        strtotime(
                            $kegiatan['tanggal']
                        )
                    ) ?>

                </div>

            <?php endif; ?>


        </div>


    </div>



    <!-- =====================================================
         ISI KEGIATAN
    ====================================================== -->

    <div class="detail-isi mt-5">

        <?= $kegiatan['isi'] ?>

    </div>



    <!-- =====================================================
         DOKUMENTASI
    ====================================================== -->

    <?php if (!empty($foto)) : ?>


        <div class="dokumentasi-kegiatan">


            <h2 class="dokumentasi-title">

                Dokumentasi Kegiatan

            </h2>



            <div class="dokumentasi-grid">


                <?php foreach ($foto as $item) : ?>


                    <?php

                    /*
                    |--------------------------------------------------------------------------
                    | PATH DOKUMENTASI BARU
                    |--------------------------------------------------------------------------
                    */

                    $fotoPathBaru =
                        FCPATH .
                        'uploads/Kegiatan/dokumentasi_korsda/' .
                        $item['foto'];


                    /*
                    |--------------------------------------------------------------------------
                    | PATH DOKUMENTASI LAMA
                    |--------------------------------------------------------------------------
                    */

                    $fotoPathLama =
                        FCPATH .
                        'uploads/kegiatan/dokumentasi_korsda/' .
                        $item['foto'];


                    /*
                    |--------------------------------------------------------------------------
                    | TENTUKAN URL FOTO
                    |--------------------------------------------------------------------------
                    */

                    if (
                        file_exists(
                            $fotoPathBaru
                        )
                    ) {

                        $fotoUrl =
                            base_url(
                                'uploads/Kegiatan/dokumentasi_korsda/' .
                                $item['foto']
                            );

                    } elseif (
                        file_exists(
                            $fotoPathLama
                        )
                    ) {

                        $fotoUrl =
                            base_url(
                                'uploads/kegiatan/dokumentasi_korsda/' .
                                $item['foto']
                            );

                    } else {

                        $fotoUrl =
                            base_url(
                                'assets/img/no-image.png'
                            );
                    }

                    ?>


                    <div class="dokumentasi-card">


                        <img
                            src="<?= $fotoUrl ?>"
                            alt="Dokumentasi kegiatan"
                            loading="lazy"
                        >


                    </div>


                <?php endforeach; ?>


            </div>


        </div>


    <?php endif; ?>



    <!-- =====================================================
         KEMBALI
    ====================================================== -->

    <div class="back-wrapper">

        <a
            href="<?= previous_url() ?>"
            class="btn btn-kembali"
        >

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>


</div>



<?= $this->include('layout/footer') ?>