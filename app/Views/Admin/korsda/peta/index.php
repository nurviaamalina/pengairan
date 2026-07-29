<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Data Wilayah Kerja</h4>
                <small class="text-muted">
                    Kelola titik lokasi wilayah kerja setiap KORSDA.
                </small>
            </div>

            <a href="<?= base_url('admin/wilayah/create') ?>" class="btn btn-tambah">
                <i class="bi bi-plus-circle"></i>
                Tambah Wilayah
            </a>

        </div>

        <?php if (session()->getFlashdata('success')) : ?>

            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>

        <?php endif; ?>

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr class="text-center">

                                <th width="60">No</th>
                                <th>Kecamatan</th>
                                <th>Nama Lokasi</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Zoom</th>
                                <th>Kategori</th>
                                <th width="170">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($wilayah)) : ?>

                                <tr>

                                    <td colspan="8" class="text-center">
                                        Belum ada data Wilayah Kerja
                                    </td>

                                </tr>

                            <?php else : ?>

                                <?php $no = 1; ?>

                                <?php foreach ($wilayah as $row) : ?>

                                    <tr>

                                        <td class="text-center">
                                            <?= $no++ ?>
                                        </td>

                                        <td>
                                            <?= esc($row['nama_kecamatan']) ?>
                                        </td>

                                        <td>
                                            <?= esc($row['nama_lokasi']) ?>
                                        </td>

                                        <td class="text-center">
                                            <?= esc($row['latitude']) ?>
                                        </td>

                                        <td class="text-center">
                                            <?= esc($row['longitude']) ?>
                                        </td>

                                        <td class="text-center">
                                            <?= esc($row['zoom']) ?>
                                        </td>

                                        <td>
                                            <?= esc($row['keterangan']) ?>
                                        </td>

                                        <td class="text-center">

                                            <a href="<?= base_url('admin/wilayah/edit/'.$row['id']) ?>"
                                                class="btn btn-warning btn-action">

                                                <i class="bi bi-pencil-square"></i>
                                                Edit

                                            </a>

                                            <a href="<?= base_url('admin/wilayah/delete/'.$row['id']) ?>"
                                                class="btn btn-danger btn-action"
                                                onclick="return confirm('Yakin ingin menghapus data?')">

                                                <i class="bi bi-trash"></i>
                                                Hapus

                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="mt-3">

            <button
                type="button"
                class="btn btn-kembali"
                onclick="window.location.href='<?= base_url('admin/korsda/dashboard') ?>'">

                <i class="bi bi-arrow-left me-2"></i>
                Kembali

            </button>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>