<?= $this->include('admin/layout/header') ?>

<div class="d-flex min-vh-100">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">

        <div class="container-fluid py-4">

            <div class="mb-4">

                <h2 class="fw-bold">
                    Tambah Kegiatan KORSDA
                </h2>

                <p class="text-muted">
                    Tambahkan kegiatan dan dokumentasi KORSDA.
                </p>

            </div>


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
                action="<?= base_url('admin/korsda/kegiatan/store') ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>


                <div class="card border-0 shadow-sm">

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

                                <option value="">
                                    -- Pilih KORSDA --
                                </option>

                                <?php foreach ($korsda as $item) : ?>

                                    <option
                                        value="<?= $item['id'] ?>"
                                        <?= old('korsda_id') == $item['id']
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
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                value="<?= old('judul') ?>"
                                required
                            >

                        </div>


                        <!-- TANGGAL -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Tanggal
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?= old('tanggal') ?>"
                                required
                            >

                        </div>


                        <!-- GAMBAR UTAMA -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Gambar Utama
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                id="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                required
                            >

                            <div
                                id="previewGambar"
                                class="mt-3"
                            ></div>

                        </div>


                        <!-- DOKUMENTASI -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Dokumentasi Kegiatan
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
                                Kamu dapat memilih lebih dari satu foto.
                            </small>

                            <div
                                id="previewDokumentasi"
                                class="row g-3 mt-2"
                            ></div>

                        </div>


                        <!-- ISI -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Isi Kegiatan
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="isi"
                                class="form-control"
                                rows="8"
                                required
                            ><?= old('isi') ?></textarea>

                        </div>


                        <div class="d-flex gap-2">

                            <a
                                href="<?= base_url('admin/korsda/kegiatan') ?>"
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
                                Simpan
                            </button>

                        </div>

                    </div>

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
            document.getElementById('previewGambar');


        if (gambar) {

            gambar.addEventListener(
                'change',
                function () {

                    previewGambar.innerHTML = '';

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


                    reader.readAsDataURL(file);
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
                                        .appendChild(col);
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