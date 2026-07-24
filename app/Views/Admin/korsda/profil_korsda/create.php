<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="card shadow">

            <div class="card-header">
                <h4 class="mb-0">Tambah Profil KORSDA</h4>
            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/korsda/profil_korsda/store') ?>"
                      method="post"
                      enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Kecamatan</label>

                        <select name="id_korsda" class="form-select" required>

                            <option value="">-- Pilih Kecamatan --</option>

                            <?php foreach ($kecamatan as $k): ?>

                                <option value="<?= $k['id'] ?>">
                                    <?= esc($k['nama_kecamatan']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="mb-3">

                        <label class="form-label">Visi</label>

                        <textarea
                            name="visi"
                            rows="4"
                            class="form-control"
                            required></textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Misi</label>

                        <textarea
                            name="misi"
                            rows="4"
                            class="form-control"
                            required></textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Tugas</label>

                        <textarea
                            name="tugas"
                            rows="5"
                            class="form-control"
                            required></textarea>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Struktur Kepengurusan
                        </label>

                        <input
                            type="file"
                            name="struktur"
                            class="form-control"
                            accept="image/*"
                            required>

                    </div>

                    <div class="d-flex justify-content-end">

                        <a href="<?= base_url('admin/korsda/profil_korsda') ?>"
                           class="btn btn-secondary me-2">

                            Kembali

                        </a>

                        <button class="btn btn-primary">

                            <i class="bi bi-save"></i>

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>