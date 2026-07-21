<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Daftar Pengaduan</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus"></i> Buat Pengaduan Baru
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($pengaduan)): ?>
        <div class="alert alert-info">
            Belum ada pengaduan. <a href="<?= base_url('pengaduan/create') ?>">Buat pengaduan baru</a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($pengaduan as $item): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $item['nama'] ?></td>
                        <td><?= $item['judul'] ?></td>
                        <td><span class="badge bg-info"><?= $item['kategori'] ?></span></td>
                        <td>
                            <?php
                            $statusColor = match($item['status']) {
                                'pending' => 'warning',
                                'diproses' => 'info',
                                'selesai' => 'success',
                                'ditolak' => 'danger',
                                default => 'secondary'
                            };
                            ?>
                            <span class="badge bg-<?= $statusColor ?>"><?= ucfirst($item['status']) ?></span>
                        </td>
                        <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>