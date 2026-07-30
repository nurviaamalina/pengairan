<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Judul -->
            <div class="page-header">

                <div>

                    <h3>Tambah Feed Instagram</h3>

                    <p>Tambahkan postingan Instagram yang akan ditampilkan pada website.</p>

                </div>

                <a href="<?= base_url('admin/instagram') ?>" class="btn btn-kembaliberita">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

            <!-- Card -->
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-4">

                    <form action="<?= base_url('admin/instagram/store') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- Judul -->

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Judul

                            </label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                placeholder="Masukkan judul postingan"
                                required>

                        </div>

                        <!-- Caption -->

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Caption

                            </label>

                            <textarea
                                name="caption"
                                class="form-control"
                                rows="6"
                                placeholder="Masukkan caption Instagram..."
                                required></textarea>

                        </div>

                        <!-- Link Instagram -->

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Link Instagram

                            </label>

                            <input
                                type="url"
                                name="instagram_url"
                                class="form-control"
                                placeholder="https://www.instagram.com/p/xxxxx/"
                                required>

                        </div>

                        <!-- Tanggal Posting -->

                        <div class="mb-3">

                            <label class="form-label fw-semibold">

                                Tanggal Posting

                            </label>

                            <input
                                type="date"
                                name="tanggal_post"
                                class="form-control"
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
                                name="thumbnail"
                                accept="image/*"
                                required>

                            <small class="text-muted">

                                Format JPG, JPEG, PNG, WEBP. Maksimal 4 MB.

                            </small>

                        </div>

                        <!-- Tombol -->

                        <div class="button-group">

                            <a href="<?= base_url('admin/instagram') ?>" class="btn-batalberita">

                                Batal

                            </a>

                            <button
                                type="submit"
                                class="btn-simpanberita">

                                Simpan Feed

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>