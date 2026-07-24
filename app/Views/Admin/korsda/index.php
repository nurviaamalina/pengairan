<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Data KORSDA</h4>
                <small class="text-muted">
                    Kelola seluruh data KORSDA yang akan ditampilkan pada website.
                </small>
            </div>

            <a href="<?= base_url('admin/korsda/create') ?>" class="btn btn-tambah">
                <i class="bi bi-plus-circle"></i>
                Tambah KORSDA
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
                                <th width="120">Gambar</th>
                                <th>Nama Kecamatan</th>
                                <th>Ketua</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Tanggal Dibuat</th>
                                <th width="170">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($korsda)) : ?>

                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada data KORSDA
                                    </td>
                                </tr>

                            <?php else : ?>

                                <?php $no = 1; ?>

                                <?php foreach ($korsda as $row) : ?>

                                    <tr>

                                        <td class="text-center">
                                            <?= $no++ ?>
                                        </td>

                                        <td class="text-center">

                                            <?php if (!empty($row['gambar'])) : ?>

                                                <img src="<?= base_url('uploads/korsda/' . $row['gambar']) ?>"
                                                    width="90"
                                                    class="img-thumbnail">

                                            <?php else : ?>

                                                <span class="text-muted">-</span>

                                            <?php endif; ?>

                                        </td>

                                        <td>
                                            <?= esc($row['nama_kecamatan']) ?>
                                        </td>

                                        <td>
                                            <?= esc($row['ketua']) ?>
                                        </td>

                                        <td>
                                            <?= esc($row['alamat']) ?>
                                        </td>

                                        <td>
                                            <?= esc($row['telepon']) ?>
                                        </td>

                                        <td class="text-center">

                                            <?= !empty($row['created_at'])
                                                ? date('d-m-Y', strtotime($row['created_at']))
                                                : '-' ?>

                                        </td>

                                        <td class="text-center">

                                            <a href="<?= base_url('admin/korsda/edit/'.$row['id']) ?>" class="btn btn-warning btn-action">
    <i class="bi bi-pencil-square"></i>
    Edit
</a>

<a href="<?= base_url('admin/korsda/delete/'.$row['id']) ?>"
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