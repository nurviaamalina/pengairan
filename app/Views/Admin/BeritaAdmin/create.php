<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Judul -->
           <div class="page-header">

    <div>
        <h3>Tambah Berita</h3>
        <p>Tambahkan berita baru ke dalam website.</p>
    </div>

    <a href="<?= base_url('admin/berita') ?>" class="btn btn-kembaliberita">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

</div>

            <!-- Card Form -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form action="<?= base_url('admin/berita/store') ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Judul Berita
                            </label>
                            <input type="text"
                                   name="judul"
                                   class="form-control"
                                   placeholder="Masukkan judul berita"
                                   required>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Slug
                            </label>
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   placeholder="contoh-judul-berita"
                                   required>
                            <small class="text-muted">
                                Gunakan huruf kecil dan tanda minus (-).
                            </small>
                        </div>

                        <!-- Isi Berita -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Isi Berita
                            </label>
                            <textarea
                                name="isi"
                                class="form-control"
                                rows="8"
                                placeholder="Tuliskan isi berita..."
                                required></textarea>
                        </div>

                        <!-- Publikator -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Publikator
                            </label>
                            <input type="text"
                                   name="publikator"
                                   class="form-control"
                                   placeholder="Nama publikator"
                                   required>
                        </div>

                        <!-- Upload Thumbnail -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Upload Thumbnail
                            </label>
                            <input
                                class="form-control"
                                type="file"
                                name="gambar"
                                accept="image/*"
                                required>

                            <small class="text-muted">
                                Format: JPG, JPEG, PNG. Maksimal 2 MB.
                            </small>
                        </div>

                        <!-- Tombol -->
                        <div class="button-group">

                            <a href="<?= base_url('admin/berita') ?>" class="btn-batalberita">
                                Batal
                            </a>

                            <button type="submit" class="btn-simpanberita">
                                Simpan Berita
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>