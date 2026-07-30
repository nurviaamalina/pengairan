<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="card shadow-sm">

            <div class="card-header">

                <h4 class="mb-0">Edit Kegiatan</h4>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/kegiatan/update/'.$kegiatan['id']) ?>"
                      method="post"
                      enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <!-- Judul -->

                    <div class="mb-3">

                        <label class="form-label">
                            Judul
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="<?= esc($kegiatan['judul']) ?>"
                            required>

                    </div>

                    <!-- Tanggal -->

                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            value="<?= esc($kegiatan['tanggal']) ?>"
                            required>

                    </div>

                    <!-- Deskripsi -->

                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="6"
                            class="form-control"
                            required><?= esc($kegiatan['deskripsi']) ?></textarea>

                    </div>

                    <!-- Thumbnail Lama -->

                    <div class="mb-3">

                        <label class="form-label">
                            Thumbnail Saat Ini
                        </label>

                        <br>

                        <img
                            src="<?= base_url('uploads/kegiatan/thumbnail/'.$kegiatan['thumbnail']) ?>"
                            class="img-thumbnail"
                            style="max-width:250px;">

                    </div>

                    <!-- Ganti Thumbnail -->

                    <div class="mb-4">

                        <label class="form-label">
                            Ganti Thumbnail
                        </label>

                        <input
                            type="file"
                            name="thumbnail"
                            class="form-control">

                    </div>

                    <hr>

                    <!-- Dokumentasi -->

                    <h5 class="mb-3">

                        Dokumentasi Saat Ini

                    </h5>

                    <div class="row">

                        <?php if(!empty($foto)): ?>

                            <?php foreach($foto as $f): ?>

                                <div class="col-md-3 mb-4">

                                    <img
                                        src="<?= base_url('uploads/kegiatan/dokumentasi/'.$f['foto']) ?>"
                                        class="img-fluid rounded shadow">

                                    <a
                                        href="<?= base_url('admin/kegiatan/foto/delete/'.$f['id']) ?>"
                                        class="btn btn-danger btn-sm w-100 mt-2"
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')">

                                        <i class="bi bi-trash"></i>

                                        Hapus

                                    </a>

                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="col-12">

                                <div class="alert alert-warning">

                                    Belum ada dokumentasi.

                                </div>

                            </div>

                        <?php endif; ?>

                    </div>

                    <hr>

                    <!-- Upload Dokumentasi Baru -->

                    <div class="mb-4">

                        <label class="form-label">

                            Tambah Dokumentasi Baru

                        </label>

                        <input
                            type="file"
                            name="dokumentasi[]"
                            class="form-control"
                            multiple>

                    </div>

                    <!-- Tombol -->

                    <div class="button-group">

                            <a href="<?= base_url('admin/kegiatan') ?>" class="btn-batalkegiatan">
                                Batal
                            </a>

                            <button type="submit" class="btn-simpankegiatan">
                                Perbarui Kegiatan
                            </button>

                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>