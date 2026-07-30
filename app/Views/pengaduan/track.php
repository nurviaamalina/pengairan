<?= $this->include('layout/header') ?>

<div class="container mt-5">
    <div class="card p-4">
        <h4>Lacak Pengaduan</h4>

        <form action="<?= base_url('pengaduan/track') ?>" method="post" class="mb-4">
            <div class="mb-3">
                <label for="query" class="form-label">Masukkan Kode Pelacakan atau Nama Pelapor</label>
                <input type="text" name="query" id="query" class="form-control" value="<?= isset($query) ? esc($query) : '' ?>" placeholder="Contoh: AB12CD34 atau Nama Lengkap" required>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary">Lacak</button>
            </div>
        </form>

        <?php if(isset($pengaduan) && $pengaduan): ?>
            <?php
                // Normalize to array of rows for consistent table rendering
                $rows = (is_array($pengaduan) && array_values($pengaduan) === $pengaduan) ? $pengaduan : [$pengaduan];
            ?>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Hasil Pencarian</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Pelapor</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tgl Masuk</th>
                                    <th>Kode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($rows as $p): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($p['judul']) ?></td>
                                        <td><?= esc($p['nama']) ?></td>
                                        <td><?= esc($p['kategori']) ?></td>
                                        <td>
                                            <?php if($p['status']=='pending'): ?>
                                                <span class="badge bg-secondary">Pending</span>
                                            <?php elseif($p['status']=='diproses'): ?>
                                                <span class="badge bg-warning">Diproses</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($p['created_at']) ?></td>
                                        <td><code><?= esc($p['tracking_code']) ?></code></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        <?php elseif(isset($pengaduan)): ?>
            <div class="alert alert-danger">Pengaduan tidak ditemukan.</div>
        <?php endif; ?>

    </div>
</div>

<?= $this->include('layout/footer') ?>
