<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper">

        <div class="container-fluid py-4">

            <!-- HEADER -->
            <div class="user-page-header mb-4">

                <div>

                    <h3>
                        Import Kegiatan KORSDA
                    </h3>

                    <p>
                        Import data kegiatan menggunakan Excel dan dokumentasi ZIP.
                    </p>

                </div>

            </div>


            <!-- ERROR -->
            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="bi bi-exclamation-triangle me-2"></i>

                    <?= nl2br(
                        esc(
                            session()->getFlashdata('error')
                        )
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- SUCCESS -->
            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="bi bi-check-circle me-2"></i>

                    <?= nl2br(
                        esc(
                            session()->getFlashdata('success')
                        )
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- FORM IMPORT -->
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <form
                        action="<?= base_url(
                            'admin/korsda/kegiatan/import'
                        ) ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>


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

                            <small class="text-muted">

                                Semua kegiatan dalam Excel akan
                                dimasukkan ke KORSDA yang dipilih.

                            </small>

                        </div>


                        <!-- EXCEL -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                File Excel

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="file"
                                name="excel"
                                class="form-control"
                                accept=".xlsx,.xls"
                                required
                            >

                            <small class="text-muted">
                                Format: .xlsx atau .xls
                            </small>

                        </div>


                        <!-- ZIP -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                File ZIP Dokumentasi

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="file"
                                name="zip"
                                class="form-control"
                                accept=".zip"
                                required
                            >

                            <small class="text-muted">

                                ZIP dapat memiliki folder pembungkus
                                sebelum folder Kegiatan.

                            </small>

                        </div>


                        <!-- INFORMASI -->
                        <div class="alert alert-info">

                            <h5 class="fw-bold">

                                <i class="bi bi-info-circle me-2"></i>

                                Format Excel

                            </h5>

                            <p>
                                Excel terdiri dari 4 kolom:
                            </p>

                            <ol>

                                <li>
                                    Kolom A = Kode Kegiatan
                                </li>

                                <li>
                                    Kolom B = Nama Kegiatan
                                </li>

                                <li>
                                    Kolom C = Tanggal
                                </li>

                                <li>
                                    Kolom D = Nama Thumbnail
                                </li>

                            </ol>


                            <h6 class="fw-bold mt-3">
                                Struktur ZIP
                            </h6>


<pre class="mb-0">GAMBAR KEGIATAN KORSDA/
└── Kegiatan/
    ├── KG1/
    │   ├── thumbnail1.jpg
    │   ├── 1.jpg
    │   ├── 2.jpg
    │   └── foto-lain.jpg
    │
    ├── KG2/
    │   ├── thumbnail2.jpg
    │   ├── 1.jpg
    │   └── 2.jpg
    │
    └── KG10/
        ├── thumbnail10.jpg
        ├── 1.jpg
        └── 2.jpg</pre>


                            <p class="mt-3 mb-0">

                                <strong>Thumbnail</strong>
                                menjadi gambar utama.

                                Semua gambar selain thumbnail
                                menjadi dokumentasi kegiatan.

                            </p>

                        </div>


                        <!-- BUTTON -->
                        <div class="d-flex gap-2">

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
                                class="btn btn-success"
                                onclick="return confirm(
                                    'Yakin ingin melakukan import?'
                                )"
                            >

                                <i class="bi bi-upload me-1"></i>

                                Mulai Import

                            </button>

                        </div>


                    </form>

                </div>

            </div>

        </div>

    </main>

</div>

<?= $this->include('admin/layout/footer') ?>