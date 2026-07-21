<?= $this->include('layout/header') ?>

<div class="container py-5">

    <div class="row align-items-center mb-4">

        <div class="col-md-8">
            <h2 class="fw-bold text-primary">
                Daftar Pengaduan
            </h2>

            <p class="text-muted mb-0">
                Daftar seluruh pengaduan masyarakat yang telah masuk.
            </p>
        </div>

        <div class="col-md-4 text-md-end mt-3 mt-md-0">

            <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary">

                <i class="bi bi-plus-circle me-2"></i>

                Buat Pengaduan

            </a>

        </div>

    </div>

    <?php if(session()->getFlashdata('success')): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <?= session()->getFlashdata('success') ?>

            <button class="btn-close" data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>


    <?php if(empty($pengaduan)): ?>

        <div class="card shadow-sm border-0">

            <div class="card-body text-center py-5">

                <i class="bi bi-inbox display-3 text-secondary"></i>

                <h4 class="mt-3">

                    Belum Ada Pengaduan

                </h4>

                <p class="text-muted">

                    Silakan buat pengaduan pertama Anda.

                </p>

                <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary">

                    Buat Pengaduan

                </a>

            </div>

        </div>

    <?php else: ?>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-primary">

                            <tr>

                                <th width="60">No</th>

                                <th>Nama</th>

                                <th>Judul</th>

                                <th>Kategori</th>

                                <th>Status</th>

                                <th>Tanggal</th>

                                <th width="120">Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $no=1; ?>

                            <?php foreach($pengaduan as $item): ?>

                                <tr>

                                    <td><?= $no++ ?></td>

                                    <td><?= esc($item['nama']) ?></td>

                                    <td><?= esc($item['judul']) ?></td>

                                    <td><?= esc($item['kategori']) ?></td>

                                    <td>

                                        <?php

                                        $badge='secondary';

                                        if($item['status']=='pending'){

                                            $badge='warning';

                                        }elseif($item['status']=='diproses'){

                                            $badge='info';

                                        }elseif($item['status']=='selesai'){

                                            $badge='success';

                                        }elseif($item['status']=='ditolak'){

                                            $badge='danger';

                                        }

                                        ?>

                                        <span class="badge bg-<?= $badge ?>">

                                            <?= ucfirst($item['status']) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?= date('d-m-Y', strtotime($item['created_at'])) ?>

                                    </td>

                                    <td>

                                        <a href="<?= base_url('pengaduan/detail/'.$item['id']) ?>" class="btn btn-sm btn-outline-primary">

                                            <i class="bi bi-eye"></i>

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->include('layout/footer') ?>