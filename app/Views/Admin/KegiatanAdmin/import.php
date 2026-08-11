<?= $this->include('admin/layout/header') ?>

<div class="d-flex">
    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h3 class="fw-bold mb-1">
                        Import Data Kegiatan Lama
                    </h3>

                    <p class="text-muted mb-0">
                        Import data kegiatan lama menggunakan file Excel dan ZIP gambar.
                    </p>
                </div>

                <a href="<?= base_url('admin/kegiatan') ?>"
                class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </a>

            </div>


            <!-- Card -->
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-4">

                    <!-- Petunjuk -->
                    <div class="alert alert-info">

                        <h6 class="fw-bold">
                            <i class="bi bi-info-circle"></i>
                            Petunjuk Import
                        </h6>

                        <ul class="mb-0">

                            <li>
                                Pilih file Excel yang berisi data kegiatan lama.
                            </li>

                            <li>
                                Pilih file ZIP yang berisi folder foto
                                masing-masing kegiatan.
                            </li>

                            <li>
                                Nama folder di dalam ZIP harus sama dengan
                                <strong>Kode Kegiatan</strong> di Excel,
                                misalnya <strong>KG1</strong>,
                                <strong>KG2</strong>, dan seterusnya.
                            </li>

                            <li>
                                Nama thumbnail di Excel harus sama dengan
                                nama file thumbnail yang ada di dalam folder
                                kegiatan.
                            </li>

                            <li>
                                Semua gambar selain thumbnail akan menjadi
                                foto dokumentasi kegiatan.
                            </li>

                        </ul>

                    </div>


                    <!-- FORM -->
                    <form
                        action="<?= base_url('admin/kegiatan/import') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <?= csrf_field() ?>


                        <!-- FILE EXCEL -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                <i class="bi bi-file-earmark-excel"></i>
                                File Excel Kegiatan

                            </label>

                            <input
                                type="file"
                                name="excel"
                                class="form-control"
                                accept=".xlsx,.xls"
                                required>

                            <small class="text-muted">

                                Format yang diperbolehkan:
                                <strong>.xlsx</strong> atau
                                <strong>.xls</strong>.

                            </small>

                        </div>


                        <!-- FILE ZIP -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                <i class="bi bi-file-earmark-zip"></i>
                                ZIP Foto Kegiatan

                            </label>

                            <input
                                type="file"
                                name="zip"
                                class="form-control"
                                accept=".zip"
                                required>

                            <small class="text-muted">

                                ZIP harus berisi folder berdasarkan
                                <strong>Kode Kegiatan</strong>,
                                seperti <strong>KG1</strong>,
                                <strong>KG2</strong>, dan seterusnya.

                            </small>

                        </div>


                        <!-- CONTOH STRUKTUR ZIP -->
                        <div class="alert alert-secondary">

                            <strong>
                                Contoh struktur ZIP:
                            </strong>

                            <pre class="mt-3 mb-0"><code>Kegiatan.zip
    │
    ├── KG1/
    │   ├── thumbnail1.jpg
    │   ├── foto01.jpg
    │   ├── foto02.jpg
    │   └── dokumentasi.jpg
    │
    ├── KG2/
    │   ├── thumbnail2.jpg
    │   ├── foto01.jpg
    │   ├── foto02.jpg
    │   └── dokumentasi.jpg
    │
    ├── KG3/
    │   ├── thumbnail3.jpg
    │   ├── foto01.jpg
    │   └── foto02.jpg
    │
    └── ...</code></pre>

                        </div>


                        <!-- TOMBOL -->
                        <div class="import-kegiatan-actions">

                            <a
                                href="<?= base_url('admin/kegiatan') ?>"
                                class="btn-import-kegiatan-cancel">

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="btn-import-kegiatan-submit">

                                <i class="bi bi-file-earmark-arrow-up"></i>
                                Import Data

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>