<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper flex-grow-1 p-4">

        <div class="card shadow-sm">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Data Kecamatan</h4>

                <a href="<?= base_url('admin/korsda/kecamatan/create/') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </a>
            </div>

            <div class="card-body">

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered table-hover">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Kecamatan</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($kecamatan)) : ?>

                            <?php $no = 1; ?>

                            <?php foreach ($kecamatan as $row) : ?>

                                <tr>

                                    <td><?= $no++ ?></td>

                                    <td><?= esc($row['nama_kecamatan']) ?></td>

                                    <td class="text-center">

                                        <a href="<?= base_url('admin/korsda/kecamatan/edit/' . $row['id']) ?>"
                                            class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <a href="<?= base_url('admin/korsda/kecamatan/delete/' . $row['id']) ?>"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="3" class="text-center">

                                    Belum ada data kecamatan.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

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
    </main>

</div>

<?= $this->include('admin/layout/footer') ?>