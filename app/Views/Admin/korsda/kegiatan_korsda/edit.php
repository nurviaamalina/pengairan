<?= $this->include('admin/layout/header') ?>

<div class="d-flex min-vh-100">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">

        <div class="container-fluid py-4">

            <div class="mb-4">

                <h2 class="fw-bold">
                    Edit Kegiatan KORSDA
                </h2>

                <p class="text-muted">
                    Ubah data kegiatan dan dokumentasi.
                </p>

            </div>


            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success">

                    <?= nl2br(
                        esc(
                            session()->getFlashdata('success')
                        )
                    ) ?>

                </div>

            <?php endif; ?>


            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger">

                    <?= nl2br(
                        esc(
                            session()->getFlashdata('error')
                        )
                    ) ?>

                </div>

            <?php endif; ?>


            <form
                action="<?= base_url(
                    'admin/korsda/kegiatan/update/' .
                    $kegiatan['id']
                ) ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>


                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">


                        <!-- KORSDA -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                KORSDA
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="korsda_id"
                                class="form-select"
                                required
                            >

                                <?php foreach ($korsda as $item) : ?>

                                    <option
                                        value="<?= $item['id'] ?>"
                                        <?= $item['id'] == $kegiatan['korsda_id']
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        <?= esc(
                                            $item['nama_wilayah']
                                        ) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- JUDUL -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Judul Kegiatan
                            </label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                value="<?= esc(
                                    $kegiatan['judul']
                                ) ?>"
                                required
                            >

                        </div>


                        <!-- TANGGAL -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= esc(
                                    $kegiatan['tanggal']
                                ) ?>"
                                required
                            >

                        </div>


                        <!-- GAMBAR UTAMA -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Gambar Utama
                            </label>


                            <?php if (!empty($kegiatan['gambar'])) : ?>

                                <?php
                                $pathBaru =
                                    FCPATH .
                                    'uploads/Kegiatan/thumbnail/' .
                                    $kegiatan['gambar'];

                                $pathLama =
                                    FCPATH .
                                    'uploads/kegiatan/' .
                                    $kegiatan['gambar'];

                                if (file_exists($pathBaru)) {

                                    $gambarUtama =
                                        base_url(
                                            'uploads/Kegiatan/thumbnail/' .
                                            $kegiatan['gambar']
                                        );

                                } elseif (file_exists($pathLama)) {

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

                                <div class="mb-3">

                                    <img
                                        src="<?= $gambarUtama ?>"
                                        style="
                                            width:220px;
                                            height:140px;
                                            object-fit:cover;
                                            border-radius:10px;
                                        "
                                    >

                                </div>

                            <?php endif; ?>


                            <input
                                type="file"
                                name="gambar"
                                id="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <div
                                id="previewGambar"
                                class="mt-3"
                            ></div>

                        </div>


                        <!-- ISI -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Isi Kegiatan
                            </label>

                            <textarea
                                name="isi"
                                class="form-control"
                                rows="8"
                                required
                            ><?= esc(
                                $kegiatan['isi']
                            ) ?></textarea>

                        </div>

                    </div>

                </div>


                <!-- =====================================================
                     DOKUMENTASI LAMA
                ====================================================== -->

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-3">
                            Dokumentasi Kegiatan
                        </h5>


                        <?php if (!empty($foto)) : ?>

                            <div class="row g-3">

                                <?php foreach ($foto as $item) : ?>

                                    <?php
                                    $fotoPathBaru =
                                        FCPATH .
                                        'uploads/Kegiatan/dokumentasi_korsda/' .
                                        $item['foto'];

                                    $fotoPathLama =
                                        FCPATH .
                                        'uploads/kegiatan/dokumentasi_korsda/' .
                                        $item['foto'];

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


                                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">

                                        <div class="card h-100 border">

                                            <img
                                                src="<?= $fotoUrl ?>"
                                                alt="Dokumentasi"
                                                style="
                                                    width:100%;
                                                    height:180px;
                                                    object-fit:cover;
                                                "
                                            >


                                            <div class="card-body p-2">

                                                <a
                                                    href="<?= base_url(
                                                        'admin/korsda/kegiatan/foto/delete/' .
                                                        $item['id']
                                                    ) ?>"
                                                    class="btn btn-sm btn-danger w-100"
                                                    onclick="return confirm(
                                                        'Yakin ingin menghapus foto ini?'
                                                    )"
                                                >

                                                    <i class="bi bi-trash me-1"></i>

                                                    Hapus Foto

                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        <?php else : ?>

                            <div class="alert alert-light border mb-0">
                                Belum ada dokumentasi.
                            </div>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- =====================================================
                     DOKUMENTASI BARU
                ====================================================== -->

                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <label class="form-label fw-semibold">
                            Tambah Dokumentasi
                        </label>

                        <input
                            type="file"
                            name="dokumentasi[]"
                            id="dokumentasi"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                        >

                        <small class="text-muted">
                            Bisa memilih beberapa foto sekaligus.
                        </small>


                        <div
                            id="previewDokumentasi"
                            class="row g-3 mt-2"
                        ></div>

                    </div>

                </div>


                <!-- BUTTON -->

                <div class="d-flex gap-2 mb-5">

                    <a
                        href="<?= base_url(
                            'admin/korsda/kegiatan'
                        ) ?>"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>


        <?= $this->include('admin/layout/footer') ?>

    </div>

</div>


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const gambar =
            document.getElementById('gambar');

        const previewGambar =
            document.getElementById(
                'previewGambar'
            );


        if (gambar) {

            gambar.addEventListener(
                'change',
                function () {

                    previewGambar.innerHTML =
                        '';

                    const file =
                        this.files[0];


                    if (!file) {
                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            const img =
                                document.createElement(
                                    'img'
                                );


                            img.src =
                                event.target.result;


                            img.style.width =
                                '220px';


                            img.style.height =
                                '140px';


                            img.style.objectFit =
                                'cover';


                            img.style.borderRadius =
                                '10px';


                            previewGambar
                                .appendChild(img);
                        };


                    reader.readAsDataURL(
                        file
                    );
                }
            );
        }


        const dokumentasi =
            document.getElementById(
                'dokumentasi'
            );


        const previewDokumentasi =
            document.getElementById(
                'previewDokumentasi'
            );


        if (dokumentasi) {

            dokumentasi.addEventListener(
                'change',
                function () {

                    previewDokumentasi.innerHTML =
                        '';


                    Array.from(
                        this.files
                    ).forEach(
                        function (file) {

                            const reader =
                                new FileReader();


                            reader.onload =
                                function (event) {

                                    const col =
                                        document.createElement(
                                            'div'
                                        );


                                    col.className =
                                        'col-xl-3 col-lg-4 col-md-4 col-sm-6';


                                    const img =
                                        document.createElement(
                                            'img'
                                        );


                                    img.src =
                                        event.target.result;


                                    img.style.width =
                                        '100%';


                                    img.style.height =
                                        '180px';


                                    img.style.objectFit =
                                        'cover';


                                    img.style.borderRadius =
                                        '10px';


                                    col.appendChild(
                                        img
                                    );


                                    previewDokumentasi
                                        .appendChild(
                                            col
                                        );
                                };


                            reader.readAsDataURL(
                                file
                            );
                        }
                    );
                }
            );
        }

    }
);

</script>