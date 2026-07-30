<?= $this->include('admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Judul -->
            <div class="page-header">

                <div>
                    <h3>Edit Feed Instagram</h3>
                    <p>Perbarui data feed Instagram yang sudah ada.</p>
                </div>

                <a href="<?= base_url('admin/instagram') ?>" class="btn btn-kembaliberita">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

            </div>

            <!-- Card Form -->
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-4">

                    <form action="<?= base_url('admin/instagram/update/' . $instagram['id']) ?>"
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
                                value="<?= esc($instagram['judul']) ?>"
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
                                required><?= esc($instagram['caption']) ?></textarea>

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
                                value="<?= esc($instagram['instagram_url']) ?>"
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
                                value="<?= $instagram['tanggal_post'] ?>"
                                required>

                        </div>

                        <!-- Thumbnail Saat Ini -->

                        <?php if (!empty($instagram['thumbnail'])) : ?>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Thumbnail Saat Ini
                                </label>

                                <br>

                                <img
                                    src="<?= base_url('uploads/instagram/' . $instagram['thumbnail']) ?>"
                                    class="img-thumbnail"
                                    width="180">

                            </div>

                        <?php endif; ?>

                        <!-- Upload Thumbnail -->

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Ganti Thumbnail
                            </label>

                            <input
                                class="form-control"
                                type="file"
                                name="thumbnail"
                                accept="image/*">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti thumbnail.
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

                                Perbarui Feed

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>