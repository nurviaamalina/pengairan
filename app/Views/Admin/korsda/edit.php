<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Edit KORSDA</h4>
                <small class="text-muted">
                    Ubah data KORSDA.
                </small>
            </div>

            <a href="<?= base_url('admin/korsda') ?>" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

        <?php if (session()->getFlashdata('errors')) : ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <div class="card shadow-sm">

            <div class="card-body">

                <form action="<?= base_url('admin/korsda/update/' . $korsda['id']) ?>" method="post" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Nama Kecamatan</label>

                            <select name="nama_kecamatan" class="form-select" required>

                                <option value="">-- Pilih Kecamatan --</option>

                                <?php
                                $kecamatan = [
                                    'Bangorejo',
                                    'Banyuwangi',
                                    'Cluring',
                                    'Gambiran',
                                    'Giri',
                                    'Glagah',
                                    'Glenmore',
                                    'Kabat',
                                    'Kalibaru',
                                    'Kalipuro',
                                    'Licin',
                                    'Muncar',
                                    'Pesanggaran',
                                    'Purwoharjo',
                                    'Rogojampi',
                                    'Sempu',
                                    'Singojuruh',
                                    'Songgon',
                                    'Srono',
                                    'Tegaldlimo',
                                    'Tegalsari',
                                    'Wongsorejo',
                                    'Siliragung',
                                    'Genteng'
                                ];

                                foreach ($kecamatan as $item) :
                                ?>

                                    <option value="<?= $item ?>" <?= old('nama_kecamatan', $korsda['nama_kecamatan']) == $item ? 'selected' : '' ?>>
                                        <?= $item ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Ketua</label>

                            <input
                                type="text"
                                name="ketua"
                                class="form-control"
                                value="<?= old('ketua', $korsda['ketua']) ?>">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Alamat</label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="form-control"><?= old('alamat', $korsda['alamat']) ?></textarea>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Telepon</label>

                            <input
                                type="text"
                                name="telepon"
                                class="form-control"
                                value="<?= old('telepon', $korsda['telepon']) ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Gambar Baru</label>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept="image/*">

                        </div>

                    </div>

                    <?php if (!empty($korsda['gambar'])) : ?>

                        <div class="mb-3">

                            <label class="form-label">Gambar Saat Ini</label>

                            <div>
                                <img src="<?= base_url('uploads/korsda/' . $korsda['gambar']) ?>"
                                    class="img-thumbnail"
                                    style="max-width:200px;">
                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="mb-3">

                        <label class="form-label">Deskripsi</label>

                        <textarea
                            name="deskripsi"
                            rows="6"
                            class="form-control"><?= old('deskripsi', $korsda['deskripsi']) ?></textarea>

                    </div>

                    <div class="text-end">

                        <button type="reset" class="btn btn-light">
                            Reset
                        </button>

                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i>
                            Update
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>