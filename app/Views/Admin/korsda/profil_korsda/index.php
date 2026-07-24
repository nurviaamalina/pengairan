<?php helper('text'); ?>
<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Profil KORSDA</h4>
                <small class="text-muted">
                    Kelola profil setiap KORSDA.
                </small>
            </div>

            <a href="<?= base_url('admin/korsda/profil_korsda/create') ?>"
               class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Tambah Profil
            </a>

        </div>

        <?php if(session()->getFlashdata('success')) : ?>

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
                                <th>Visi</th>
                                <th>Misi</th>
                                <th>Tugas</th>
                                <th width="150">Struktur</th>
                                <th width="170">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                        <?php if(empty($profil)) : ?>

                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada data Profil KORSDA
                                </td>
                            </tr>

                        <?php else : ?>

                            <?php $no = 1; ?>

                            <?php foreach($profil as $row) : ?>

                                <tr>

                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>

                                    <td>
                                        <?= esc($row['nama_kecamatan']) ?>
                                    </td>

                                    <td>
                                        <?= word_limiter(strip_tags($row['visi']), 10) ?>
                                    </td>

                                    <td>
                                        <?= word_limiter(strip_tags($row['misi']), 10) ?>
                                    </td>

                                    <td>
                                        <?= word_limiter(strip_tags($row['tugas']), 10) ?>
                                    </td>

                                    <td class="text-center">

                                        <?php if(!empty($row['struktur'])) : ?>

                                            <img src="<?= base_url('uploads/struktur/'.$row['struktur']) ?>"
                                                 class="img-thumbnail"
                                                 width="120">

                                        <?php else : ?>

                                            <span class="text-muted">
                                                Belum ada
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td class="text-center">

                                        <a href="<?= base_url('admin/korsda/profil_korsda/edit/'.$row['id']) ?>"
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>

                                        <a href="<?= base_url('admin/korsda/profil_korsda/delete/'.$row['id']) ?>"
                                           class="btn btn-danger btn-sm"
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

        <!-- Tombol Kembali -->
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