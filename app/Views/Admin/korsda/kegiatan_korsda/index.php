<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

<?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Data Kegiatan KORSDA</h2>
            <p class="text-muted">Kelola kegiatan masing-masing KORSDA</p>
        </div>

        <a href="<?= site_url('admin/korsda/kegiatan/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kegiatan
        </a>
    </div>

    <?php if(session()->getFlashdata('success')) : ?>

        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>

    <?php endif; ?>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary text-center">

                    <tr>
                        <th width="60">No</th>
                        <th>Kecamatan</th>
                        <th>Judul</th>
                        <th width="130">Gambar</th>
                        <th width="120">Tanggal</th>
                        <th width="170">Aksi</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php if(!empty($kegiatan)): ?>

                        <?php $no=1; ?>

                        <?php foreach($kegiatan as $item): ?>

                        <tr>

                            <td class="text-center"><?= $no++ ?></td>

                            <td><?= esc($item['nama_kecamatan']) ?></td>

                            <td><?= esc($item['judul']) ?></td>

                            <td class="text-center">

                                <?php if($item['gambar']) : ?>

                                    <img src="<?= base_url('uploads/kegiatan/'.$item['gambar']) ?>"
                                         width="90"
                                         class="img-thumbnail">

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>

                            <td><?= date('d-m-Y', strtotime($item['tanggal'])) ?></td>

                            <td class="text-center">

                                <a href="<?= site_url('admin/korsda/kegiatan/edit/'.$item['id']) ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="<?= site_url('admin/korsda/kegiatan/delete/'.$item['id']) ?>"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')"
                                   class="btn btn-danger btn-sm">
                                    Hapus
                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="text-center">

                                Belum ada data kegiatan.

                            </td>

                        </tr>

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