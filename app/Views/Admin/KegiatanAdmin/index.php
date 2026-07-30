<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4">

        <div class="container-fluid">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h4 class="page-title">
                        Data Kegiatan
                    </h4>

                    <small class="page-subtitle">
                        Kelola seluruh kegiatan yang akan ditampilkan pada website.
                    </small>
                </div>

                <a href="<?= base_url('admin/kegiatan/create') ?>" class="btn btn-tambah">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Kegiatan
                </a>

            </div>

            <!-- Flash Message -->
            <?php if(session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <?= session()->getFlashdata('success') ?>

                    <button class="btn-close" data-bs-dismiss="alert"></button>

                </div>

            <?php endif; ?>

            <!-- Card -->
            <div class="card kegiatan-card">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle kegiatan-table">

                            <thead>

                                <tr>

                                    <th width="60">No</th>

                                    <th width="130">Thumbnail</th>

                                    <th>Judul</th>

                                    <th width="150">Tanggal</th>

                                    <th width="100">Tahun</th>

                                    <th width="180">Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if(empty($kegiatan)) : ?>

                                    <tr>

                                        <td colspan="6" class="text-center text-muted py-4">

                                            Belum ada data kegiatan.

                                        </td>

                                    </tr>

                                <?php else : ?>

                                    <?php $no=1; ?>

                                    <?php foreach($kegiatan as $row): ?>

                                        <tr>

                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>

                                            <td class="text-center">

                                                <?php if($row['thumbnail']) : ?>

                                                    <img src="<?= base_url('uploads/kegiatan/'.$row['thumbnail']) ?>"
                                                         class="table-thumbnail">

                                                <?php else : ?>

                                                    <span class="text-muted">
                                                        Tidak ada gambar
                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                            <td>

                                                <strong>

                                                    <?= esc($row['judul']) ?>

                                                </strong>

                                            </td>

                                            <td class="text-center">

                                                <?= date('d-m-Y',strtotime($row['tanggal'])) ?>

                                            </td>

                                            <td class="text-center">

                                                <?= esc($row['tahun']) ?>

                                            </td>

                                            <td class="text-center">

                                                <a href="<?= base_url('admin/kegiatan/edit/'.$row['id']) ?>"
                                                   class="btn btn-warning btn-sm">

                                                    <i class="bi bi-pencil-square"></i>

                                                    Edit

                                                </a>

                                                <a href="<?= base_url('admin/kegiatan/delete/'.$row['id']) ?>"
                                                   onclick="return confirm('Apakah yakin ingin menghapus kegiatan ini?')"
                                                   class="btn btn-danger btn-sm">

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

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>