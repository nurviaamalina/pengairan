    <?= $this->include('admin/layout/header') ?>

    <div class="d-flex">

        <?= $this->include('admin/layout/sidebar') ?>

        <div class="content flex-grow-1 p-4 bg-light">

            <div class="container-fluid">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h3 class="fw-bold mb-1">
                            Import Data Berita Lama
                        </h3>

                        <p class="text-muted mb-0">
                            Import data berita lama menggunakan file Excel dan ZIP gambar.
                        </p>
                    </div>

                    <a href="<?= base_url('admin/berita') ?>"
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
                                    Pilih file Excel yang berisi data berita lama.
                                </li>

                                <li>
                                    Pilih file ZIP yang berisi gambar berita.
                                </li>

                                <li>
                                    Nama gambar di Excel harus sama dengan
                                    nama gambar yang ada di dalam ZIP.
                                </li>

                                <li>
                                    Data berita harus berada pada sheet
                                    <strong>BERITA</strong>.
                                </li>

                            </ul>

                        </div>


                        <!-- FORM -->
                        <form
                            action="<?= base_url('admin/berita/import') ?>"
                            method="post"
                            enctype="multipart/form-data">

                            <?= csrf_field() ?>


                            <!-- FILE EXCEL -->
                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    <i class="bi bi-file-earmark-excel"></i>
                                    File Excel Berita

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
                                    ZIP Gambar Berita

                                </label>

                                <input
                                    type="file"
                                    name="zip"
                                    class="form-control"
                                    accept=".zip"
                                    required>

                                <small class="text-muted">

                                    ZIP harus berisi folder
                                    <strong>BERITA</strong>.

                                </small>

                            </div>


                            <!-- CONTOH STRUKTUR ZIP -->
                            <div class="alert alert-secondary">

                                <strong>
                                    Contoh struktur ZIP:
                                </strong>

    <pre class="mt-2 mb-0">BERITA/
    ├── BR1.jpg
    ├── BR2.jpg
    ├── BR3.jpg
    └── BR4.jpg</pre>

                            </div>


                            <!-- TOMBOL -->
                            <div class="d-flex gap-2">

                                <a
                                    href="<?= base_url('admin/berita') ?>"
                                    class="btn btn-secondary">

                                    Batal

                                </a>

                            <button
                                    type="submit"
                                    class="btn btn-success">

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