    <?= $this->include('admin/layout/header') ?>

    <div class="d-flex">

        <?= $this->include('admin/layout/sidebar') ?>

       <main class="content-wrapper">

            <div class="container-fluid">

                <!-- Header -->
                <div class="user-page-header">

    <div>
        <h3>
            <i class="bi bi-file-earmark-excel me-2"></i>
            Import Data Berita Lama
        </h3>

        <p>
            Import data berita lama menggunakan file Excel dan ZIP gambar.
        </p>
    </div>

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


                           <!-- ==========================================
     FILE EXCEL
=========================================== -->

<div class="import-file-group">

    <label class="import-file-label">

        <i class="bi bi-file-earmark-excel"></i>

        File Excel Berita

    </label>


    <div class="import-upload-box">

        <i class="bi bi-cloud-arrow-up import-upload-icon"></i>

        <div class="import-upload-text">

            <strong>
                Pilih file Excel
            </strong>

            <span>
                atau drag & drop file di sini
            </span>

        </div>


        <label class="import-browse-button">

            Browse File

            <input
                type="file"
                name="excel"
                id="excel"
                accept=".xlsx,.xls"
                required
            >

        </label>

    </div>


    <small class="import-file-help">

        Format yang diperbolehkan:
        <strong>.xlsx</strong> atau
        <strong>.xls</strong>.

    </small>

</div>


<!-- ==========================================
     FILE ZIP
=========================================== -->

<div class="import-file-group">

    <label class="import-file-label">

        <i class="bi bi-file-earmark-zip"></i>

        ZIP Gambar Berita

    </label>


    <div class="import-upload-box">

        <i class="bi bi-cloud-arrow-up import-upload-icon"></i>

        <div class="import-upload-text">

            <strong>
                Pilih file ZIP
            </strong>

            <span>
                atau drag & drop file di sini
            </span>

        </div>


        <label class="import-browse-button">

            Browse File

            <input
                type="file"
                name="zip"
                id="zip"
                accept=".zip"
                required
            >

        </label>

    </div>


    <small class="import-file-help">

        ZIP harus berisi folder
        <strong>BERITA</strong>
        yang berisi thumbnail berita.

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