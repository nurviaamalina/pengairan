<?= $this->include('layout/header') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/kegiatankorsda.css') ?>"
>


<section class="detail-kegiatan-page">

    <!-- =====================================================
         HERO / THUMBNAIL UTAMA
    ====================================================== -->

    <div class="detail-hero">

        <?php

        /*
        |--------------------------------------------------------------------------
        | PATH THUMBNAIL BARU
        |--------------------------------------------------------------------------
        */

        $pathBaru =
            FCPATH .
            'uploads/Kegiatan/thumbnail/' .
            ($kegiatan['gambar'] ?? '');


        /*
        |--------------------------------------------------------------------------
        | PATH THUMBNAIL LAMA
        |--------------------------------------------------------------------------
        */

        $pathLama =
            FCPATH .
            'uploads/kegiatan/' .
            ($kegiatan['gambar'] ?? '');


        /*
        |--------------------------------------------------------------------------
        | TENTUKAN URL GAMBAR
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
            alt="<?= esc($kegiatan['judul']) ?>"
            class="detail-hero-image"
        >


        <!-- =================================================
             BREADCRUMB
        ================================================== -->

        <nav
            class="detail-breadcrumb"
            aria-label="breadcrumb"
        >

            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('/') ?>">
                        Beranda
                    </a>

                </li>


                <li class="breadcrumb-item">

                    <a href="<?= base_url('korsda') ?>">
                        Korsda
                    </a>

                </li>


                <li class="breadcrumb-item active">

                    <?= esc($kegiatan['judul']) ?>

                </li>

            </ol>

        </nav>

    </div>



    <!-- =====================================================
         JUDUL & TANGGAL
    ====================================================== -->

    <div class="detail-info">

        <h1 class="detail-title">

            <?= esc($kegiatan['judul']) ?>

        </h1>


        <?php if (!empty($kegiatan['tanggal'])) : ?>

            <div class="detail-date">

                <i class="bi bi-calendar3"></i>

                <span>

                    <?= date(
                        'd F Y',
                        strtotime($kegiatan['tanggal'])
                    ) ?>

                </span>

            </div>

        <?php endif; ?>

    </div>



    <!-- =====================================================
         GARIS PEMBATAS
    ====================================================== -->

    <div class="detail-divider"></div>



    <!-- =====================================================
         DOKUMENTASI
    ====================================================== -->

    <?php if (!empty($foto)) : ?>

        <section class="detail-dokumentasi">

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
                        file_exists($fotoPathBaru)
                    ) {

                        $fotoUrl =
                            base_url(
                                'uploads/Kegiatan/dokumentasi_korsda/' .
                                $item['foto']
                            );

                    } elseif (
                        file_exists($fotoPathLama)
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


                    <div class="dokumentasi-item">

                        <img
                            src="<?= $fotoUrl ?>"
                            alt="Dokumentasi <?= esc($kegiatan['judul']) ?>"
                            loading="lazy"
                        >

                    </div>


                <?php endforeach; ?>

            </div>

        </section>

    <?php endif; ?>



    <!-- =====================================================
         TOMBOL KEMBALI
    ====================================================== -->

    <div class="detail-back">

        <a
            href="<?= previous_url() ?>"
            class="btn-kembali"
        >

            <i class="bi bi-arrow-left"></i>

            <span>Kembali</span>

        </a>

    </div>

</section>


<?= $this->include('layout/footer') ?>