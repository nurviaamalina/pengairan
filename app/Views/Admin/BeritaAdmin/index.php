<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h4 class="fw-bold">
                Data Berita
            </h4>

            <small class="text-muted">
            Kelola seluruh berita yang akan ditampilkan pada website.
             </small>

            <a href="<?= base_url('admin/berita/create') ?>" class="btn btn-tambah">
                <i class="bi bi-plus-circle"></i>
                Tambah Berita
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

                            <th>Gambar</th>

                            <th>Judul</th>

                            <th>Publikator</th>

                            <th>Tanggal</th>

                            <th>Views</th>

                            <th width="170">Aksi</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php if(empty($berita)) : ?>

                            <tr>

                                <td colspan="7" class="text-center">

                                    Belum ada data berita

                                </td>

                            </tr>

                        <?php endif; ?>


                        <?php

                        $no = 1;

                        foreach($berita as $row) :

                        ?>

                        <tr>

                            <td>

                                <?= $no++ ?>

                            </td>

                            <td width="120">

                                <?php if($row['gambar']) : ?>

                                    <img
                                            src="<?= base_url('uploads/berita/'.$row['gambar']) ?>"
                                            width="100"
                                            class="img-thumbnail">

                                <?php else : ?>

                                    -

                                <?php endif; ?>

                            </td>

                            <td>

                                <?= esc($row['judul']) ?>

                            </td>

                            <td>

                                <?= esc($row['publikator']) ?>

                            </td>

                            <td>

                                <?= date('d-m-Y', strtotime($row['tanggal'])) ?>

                            </td>

                            <td>

                                <?= $row['views'] ?>

                            </td>

                            <td>

                                <a href="<?= base_url('admin/berita/edit/'.$row['id']) ?>"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </a>

                                <a href="<?= base_url('admin/berita/delete/'.$row['id']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus berita ini?')">

                                    <i class="bi bi-trash"></i>

                                    Hapus

                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>