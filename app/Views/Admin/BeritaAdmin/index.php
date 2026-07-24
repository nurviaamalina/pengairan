<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h4 class="fw-bold mb-1">
                        Data Berita
                    </h4>

                    <small class="text-muted">
                        Kelola seluruh berita yang akan ditampilkan pada website.
                    </small>
                </div>

                <a href="<?= base_url('admin/berita/create') ?>" class="btn btn-tambah">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Berita
                </a>

            </div>

            <!-- Flash Message -->
            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show" role="alert">

                    <?= session()->getFlashdata('success') ?>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                    </button>

                </div>

            <?php endif; ?>

            <!-- Card -->
            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover align-middle">

                            <thead class="table-light text-center">

                                <tr>

                                    <th width="60">No</th>

                                    <th width="120">Thumbnail</th>

                                    <th>Judul</th>

                                    <th width="180">Publikator</th>

                                    <th width="120">Tanggal</th>

                                    <th width="80">Views</th>

                                    <th width="180">Aksi</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php if (empty($berita)) : ?>

                                    <tr>

                                        <td colspan="7" class="text-center text-muted">

                                            Belum ada data berita.

                                        </td>

                                    </tr>

                                <?php else : ?>

                                    <?php $no = 1; ?>

                                    <?php foreach ($berita as $row) : ?>

                                        <tr>

                                            <td class="text-center">

                                                <?= $no++ ?>

                                            </td>

                                            <td class="text-center">

                                                <?php if (!empty($row['gambar'])) : ?>

                                                    <img
                                                        src="<?= base_url('uploads/berita/' . $row['gambar']) ?>"
                                                        class="img-thumbnail"
                                                        width="100">

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

                                            <td>

                                                <?= esc($row['publikator']) ?>

                                            </td>

                                            <td class="text-center">

                                                <?= date('d-m-Y', strtotime($row['tanggal'])) ?>

                                            </td>

                                            <td class="text-center">

                                                <?= $row['views'] ?>

                                            </td>

                                            <td class="text-center">

                                                <a href="<?= base_url('admin/berita/edit/' . $row['id']) ?>"
                                                   class="btn btn-warning btn-sm">

                                                    <i class="bi bi-pencil-square"></i>

                                                    Edit

                                                </a>

                                                <a href="<?= base_url('admin/berita/delete/' . $row['id']) ?>"
                                                   class="btn btn-danger btn-sm"
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">

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