<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    Tambah Wilayah Kerja
                </h5>
            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/wilayah/store') ?>" method="post">

                    <?= csrf_field() ?>

                    <!-- Kecamatan -->
                    <div class="mb-3">
                        <label class="form-label">Kecamatan / KORSDA</label>

                        <select name="id_korsda" class="form-select" required>

                            <option value="">-- Pilih Kecamatan --</option>

                            <?php foreach ($korsda as $k) : ?>

                                <option value="<?= $k['id'] ?>">
                                    <?= esc($k['nama_kecamatan']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- Nama Lokasi -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lokasi
                        </label>

                        <input
                            type="text"
                            name="nama_lokasi"
                            class="form-control"
                            placeholder="Contoh : Bendung Karangdoro"
                            required>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">
                                    Latitude
                                </label>

                                <input
                                    type="text"
                                    name="latitude"
                                    class="form-control"
                                    placeholder="-8.21920000"
                                    required>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">
                                    Longitude
                                </label>

                                <input
                                    type="text"
                                    name="longitude"
                                    class="form-control"
                                    placeholder="114.36910000"
                                    required>

                            </div>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Zoom
                        </label>

                        <input
                            type="number"
                            name="zoom"
                            class="form-control"
                            value="15"
                            min="1"
                            max="20"
                            required>

                    </div>

                   <div class="mb-3">
    <label class="form-label">Kategori</label>

    <select name="keterangan" class="form-select" required>

        <option value="">-- Pilih Kategori --</option>

        <option value="jaringan irigasi"
            <?= old('keterangan', $wilayah['keterangan'] ?? '') == 'jaringan irigasi' ? 'selected' : '' ?>>
            Jaringan Irigasi
        </option>

        <option value="bendungan"
            <?= old('keterangan', $wilayah['keterangan'] ?? '') == 'bendungan' ? 'selected' : '' ?>>
            Bendungan
        </option>

        <option value="embung"
            <?= old('keterangan', $wilayah['keterangan'] ?? '') == 'embung' ? 'selected' : '' ?>>
            Embung
        </option>

        <option value="bangunan pengairan"
            <?= old('keterangan', $wilayah['keterangan'] ?? '') == 'bangunan pengairan' ? 'selected' : '' ?>>
            Bangunan Pengairan
        </option>

    </select>
</div>

                    <hr>

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