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

    <label
        for="korsda_id"
        class="form-label fw-semibold"
    >
        Nama Wilayah
        <span class="text-danger">*</span>
    </label>

    <select
        name="korsda_id"
        id="korsda_id"
        class="form-select"
        required
    >

        <option value="">
            -- Pilih Nama Wilayah --
        </option>

        <?php if (!empty($korsda)): ?>

            <?php foreach ($korsda as $item): ?>

                <option
                    value="<?= esc($item['id']) ?>"
                    <?= old('korsda_id') == $item['id']
                        ? 'selected'
                        : '' ?>
                >

                    <?= esc($item['nama_wilayah']) ?>

                    <?php if (!empty($item['nama_kecamatan'])): ?>

                        - <?= esc($item['nama_kecamatan']) ?>

                    <?php endif; ?>

                </option>

            <?php endforeach; ?>

        <?php else: ?>

            <option value="" disabled>
                Data wilayah belum tersedia
            </option>

        <?php endif; ?>

    </select>

    <small class="text-muted">
        Pilih nama wilayah yang sudah terdaftar pada data KORSDA.
    </small>

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