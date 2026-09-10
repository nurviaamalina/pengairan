
<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <main class="content-wrapper">

        <!-- FLASH MESSAGE -->
        <?php if (session()->getFlashdata('success')) : ?>

            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>

        <?php endif; ?>


        <!-- HEADER HALAMAN -->
<div class="user-page-header">

    <div>
        <h3>
            <?= esc($kategori['nama_kategori']); ?>
        </h3>

        <p>
            Daftar dokumen dalam kategori ini.
        </p>
    </div>

    <a href="<?= base_url('admin/dokumen/create/'.$kategori['slug']) ?>"
       class="btn btn-primary">

        <i class="fa fa-plus"></i>
        Tambah Dokumen

    </a>

</div>



        <!-- TABEL DOKUMEN -->
        <div class="card shadow">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th width="70">No</th>

                                <th>Judul Dokumen</th>

                                <th width="120">Tahun</th>

                                <th width="120">PDF</th>

                                <th width="180">Aksi</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (empty($dokumen)) : ?>

                                <tr>

                                    <td colspan="5" class="text-center py-4">

                                        Belum ada dokumen.

                                    </td>

                                </tr>

                            <?php else : ?>

                                <?php $no = 1; ?>

                                <?php foreach ($dokumen as $d) : ?>

                                    <tr>

                                        <!-- NO -->
                                        <td>
                                            <?= $no++; ?>
                                        </td>


                                        <!-- JUDUL -->
                                        <td>
                                            <?= esc($d['judul']); ?>
                                        </td>


                                        <!-- TAHUN -->
                                        <td>
                                            <?= esc($d['tahun']); ?>
                                        </td>


                                        <!-- PDF -->
                                        <td>

                                            <a href="<?= base_url('uploads/dokumen/'.$d['file']); ?>"
                                               target="_blank">

                                                <i class="fa fa-file-pdf"></i>

                                                <?= esc($d['file']); ?>

                                            </a>

                                        </td>


                                        <!-- AKSI -->
                                        <td>

                                            <a href="<?= base_url('admin/dokumen/edit/'.$d['id']); ?>"
                                               class="btn btn-warning btn-sm">

                                                <i class="fa fa-edit"></i>
                                                Edit

                                            </a>


                                            <a href="<?= base_url('admin/dokumen/delete/'.$d['id']); ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Yakin ingin menghapus dokumen ini?')">

                                                <i class="fa fa-trash"></i>
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

    </main>

</div>

<?= $this->include('Admin/layout/footer'); ?>

