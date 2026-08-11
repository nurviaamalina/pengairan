<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Wilayah Kerja</h5>
            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/wilayah/store') ?>" method="post" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Kecamatan / KORSDA</label>

                        <select name="korsda_id" class="form-select" required>

                            <option value="">-- Pilih Kecamatan --</option>

                            <?php foreach ($korsda as $k): ?>

                                <option value="<?= $k['id'] ?>">
                                    <?= esc($k['nama_kecamatan']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Wilayah</label>

                        <input type="text"
                               name="nama_wilayah"
                               class="form-control"
                               required>
                    </div>

                   <div class="mb-3">
    <label class="form-label">File Shapefile (ZIP)</label>

    <input type="file"
           name="file_peta"
           class="form-control"
           accept=".zip"
           required>

    <small class="text-muted">
        Upload file ZIP yang berisi .shp, .shx, .dbf, dan .prj.
    </small>
</div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>

                        <select name="keterangan" class="form-select">

                            <option value="jaringan irigasi">Jaringan Irigasi</option>
                            <option value="bendungan">Bendungan</option>
                            <option value="embung">Embung</option>
                            <option value="bangunan pengairan">Bangunan Pengairan</option>

                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i>
                        Simpan
                    </button>

                    <a href="<?= base_url('admin/wilayah') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>