<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

```
<?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

    <h2 class="fw-bold mb-4">Edit Kegiatan KORSDA</h2>

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="<?= site_url('admin/korsda/kegiatan/update/' . $kegiatan['id']) ?>"
                  method="post"
                  enctype="multipart/form-data">

                <?= csrf_field() ?>

                <!-- KORSDA / KECAMATAN -->
                <div class="mb-3">

                    <label class="form-label">
                        Kecamatan
                    </label>

                    <select name="korsda_id" class="form-select" required>

                        <option value="">
                            -- Pilih Kecamatan --
                        </option>

                        <?php foreach ($korsda as $item): ?>

                            <option
                                value="<?= $item['id'] ?>"
                                <?= ((int) $item['id'] === (int) ($kegiatan['korsda_id'] ?? 0)) ? 'selected' : '' ?>
                            >
                                <?= esc($item['nama_kecamatan']) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- JUDUL -->
                <div class="mb-3">

                    <label class="form-label">
                        Judul
                    </label>

                    <input
                        type="text"
                        name="judul"
                        class="form-control"
                        value="<?= esc($kegiatan['judul'] ?? '') ?>"
                        required>

                </div>


                <!-- TANGGAL -->
                <div class="mb-3">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="<?= esc($kegiatan['tanggal'] ?? '') ?>"
                        required>

                </div>


                <!-- GAMBAR LAMA -->
                <div class="mb-3">

                    <label class="form-label">
                        Gambar Lama
                    </label>

                    <br>

                    <?php if (!empty($kegiatan['gambar'])): ?>

                        <img
                            src="<?= base_url('uploads/kegiatan/' . $kegiatan['gambar']) ?>"
                            width="180"
                            class="img-thumbnail">

                    <?php else: ?>

                        <div class="text-muted">
                            Belum ada gambar
                        </div>

                    <?php endif; ?>

                </div>


                <!-- GANTI GAMBAR -->
                <div class="mb-3">

                    <label class="form-label">
                        Ganti Gambar
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept="image/*">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>


                <!-- ISI KEGIATAN -->
                <div class="mb-3">

                    <label class="form-label">
                        Isi Kegiatan
                    </label>

                    <textarea
                        name="isi"
                        rows="8"
                        class="form-control"
                        required><?= esc($kegiatan['isi'] ?? '') ?></textarea>

                </div>


                <!-- BUTTON -->
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i>
                    Update
                </button>

                <a
                    href="<?= site_url('admin/korsda/kegiatan') ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>
```

</div>

<?= $this->include('admin/layout/footer') ?>
