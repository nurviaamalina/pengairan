<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/kegiatanadmin.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Judul -->
            <div class="page-header">

                <div>
                    <h3>Tambah Kegiatan</h3>
                    <p>Tambahkan kegiatan baru ke dalam website.</p>
                </div>

                <a href="<?= base_url('admin/kegiatan') ?>" class="btn btn-kembaliberita">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

            </div>

            <!-- Card Form -->
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-4">

                    <form action="<?= base_url('admin/kegiatan/store') ?>"
                          method="post"
                          enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- Judul -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Judul Kegiatan
                            </label>

                            <input type="text"
                                   name="judul"
                                   class="form-control"
                                   placeholder="Masukkan judul kegiatan"
                                   required>

                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Tanggal Kegiatan
                            </label>

                            <input type="date"
                                   name="tanggal"
                                   class="form-control"
                                   required>

                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="8"
                                placeholder="Tuliskan deskripsi kegiatan..."
                                required></textarea>

                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Upload Thumbnail
                            </label>

                            <input
                                class="form-control"
                                type="file"
                                name="thumbnail"
                                accept="image/*"
                                required>

                            <small class="text-muted">
                                Format JPG, JPEG, PNG. Maksimal 2 MB.
                            </small>

                        </div>
                        <!-- Upload Dokumentasi -->
<div class="mb-4">

    <label class="form-label fw-semibold">
        Upload Dokumentasi Kegiatan
    </label>

    <input
        type="file"
        name="dokumentasi[]"
        class="form-control"
        accept="image/*"
        multiple>

    <small class="text-muted">
        Anda dapat memilih lebih dari satu foto dokumentasi.
    </small>

</div>

<!-- Preview Dokumentasi -->
<div class="mb-4">

    <label class="form-label fw-semibold">
        Preview Dokumentasi
    </label>

    <div id="previewDokumentasi" class="row g-3"></div>

</div>

                        <!-- Tombol -->
                        <div class="button-group">

                            <a href="<?= base_url('admin/kegiatan') ?>"
                               class="btn-batalberita">

                                Batal

                            </a>

                            <button type="submit"
                                    class="btn-simpanberita">

                                Simpan Kegiatan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>