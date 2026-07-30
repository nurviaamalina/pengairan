<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

<?= $this->include('Admin/layout/sidebar'); ?>

<div class="main">

    <div class="container-fluid">

        <?php if(session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">


            <div>
            <h1><?= esc($kategori['nama_kategori']); ?></h1>
           
        </div>


            <a href="<?= base_url('admin/dokumen/create/'.$kategori['slug']) ?>"
                class="btn btn-primary">

                <i class="fa fa-plus"></i>
                Tambah 

            </a>

        </div>
        
    </div>

        <div class="card shadow">

            <div class="card-body">

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

                        <?php if(empty($dokumen)) : ?>

                            <tr>

                                <td colspan="5" class="text-center">

                                    Belum ada dokumen.

                                </td>

                            </tr>

                        <?php endif; ?>

                        <?php $no = 1; ?>

                        <?php foreach($dokumen as $d) : ?>

                            <tr>

                                <td><?= $no++; ?></td>

                                <td><?= esc($d['judul']); ?></td>

                                <td><?= esc($d['tahun']); ?></td>

                                <td>

                                    <a href="<?= base_url('uploads/dokumen/'.$d['file']); ?>"

                                        target="_blank">

                                         <?= esc($d['file']); ?>


                                    </a>

                                </td>

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

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>