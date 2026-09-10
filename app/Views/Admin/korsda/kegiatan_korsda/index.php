<?= $this->include('admin/layout/header') ?>

<div class="d-flex min-vh-100">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">

        <div class="container-fluid py-4">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="fw-bold mb-1">
                        Data Kegiatan KORSDA
                    </h2>

                    <p class="text-muted mb-0">
                        Kelola data kegiatan dan dokumentasi KORSDA.
                    </p>
                </div>

                <div class="d-flex gap-2">

                    <a
                        href="<?= base_url('admin/korsda/kegiatan/import') ?>"
                        class="btn btn-success"
                    >
                        <i class="bi bi-upload me-1"></i>
                        Import
                    </a>

                    <a
                        href="<?= base_url('admin/korsda/kegiatan/create') ?>"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Tambah Kegiatan
                    </a>

                </div>

            </div>


            <!-- FLASH SUCCESS -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="bi bi-check-circle me-2"></i>

                    <?= nl2br(
                        esc(
                            session()->getFlashdata('success')
                        )
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- FLASH ERROR -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="bi bi-exclamation-triangle me-2"></i>

                    <?= nl2br(
                        esc(
                            session()->getFlashdata('error')
                        )
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>

                                <tr>

                                    <th width="50">
                                        No
                                    </th>

                                    <th width="120">
                                        Gambar
                                    </th>

                                    <th>
                                        Wilayah
                                    </th>

                                    <th>
                                        Judul Kegiatan
                                    </th>

                                    <th width="130">
                                        Tanggal
                                    </th>

                                    <th width="130">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                <?php if (!empty($kegiatan)) : ?>

                                    <?php foreach ($kegiatan as $no => $item) : ?>

                                        <tr>

                                            <td>
                                                <?= $no + 1 ?>
                                            </td>


                                            <td>

                                                <?php
                                                $gambarPathBaru =
                                                    FCPATH .
                                                    'uploads/Kegiatan/thumbnail/' .
                                                    ($item['gambar'] ?? '');

                                                $gambarPathLama =
                                                    FCPATH .
                                                    'uploads/kegiatan/' .
                                                    ($item['gambar'] ?? '');

                                                if (
                                                    !empty($item['gambar']) &&
                                                    file_exists($gambarPathBaru)
                                                ) {

                                                    $gambarUrl =
                                                        base_url(
                                                            'uploads/Kegiatan/thumbnail/' .
                                                            $item['gambar']
                                                        );

                                                } elseif (
                                                    !empty($item['gambar']) &&
                                                    file_exists($gambarPathLama)
                                                ) {

                                                    $gambarUrl =
                                                        base_url(
                                                            'uploads/kegiatan/' .
                                                            $item['gambar']
                                                        );

                                                } else {

                                                    $gambarUrl =
                                                        base_url(
                                                            'assets/img/no-image.png'
                                                        );
                                                }
                                                ?>

                                                <img
                                                    src="<?= $gambarUrl ?>"
                                                    alt="<?= esc($item['judul']) ?>"
                                                    style="
                                                        width:75px;
                                                        height:55px;
                                                        object-fit:cover;
                                                        border-radius:8px;
                                                    "
                                                >

                                            </td>


                                            <td>

                                                <strong>
                                                    <?= esc(
                                                        $item['nama_wilayah']
                                                        ?? '-'
                                                    ) ?>
                                                </strong>

                                            </td>


                                            <td>

                                                <strong>
                                                    <?= esc(
                                                        $item['judul']
                                                    ) ?>
                                                </strong>

                                            </td>


                                            <td>

                                                <?= !empty($item['tanggal'])
                                                    ? date(
                                                        'd/m/Y',
                                                        strtotime(
                                                            $item['tanggal']
                                                        )
                                                    )
                                                    : '-'
                                                ?>

                                            </td>


                                            <td>

                                                <div class="d-flex gap-1">

                                                    <a
                                                        href="<?= base_url(
                                                            'admin/korsda/kegiatan/edit/' .
                                                            $item['id']
                                                        ) ?>"
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit"
                                                    >
                                                        <i class="bi bi-pencil"></i>
                                                    </a>


                                                    <a
                                                        href="<?= base_url(
                                                            'admin/korsda/kegiatan/delete/' .
                                                            $item['id']
                                                        ) ?>"
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus"
                                                        onclick="return confirm(
                                                            'Yakin ingin menghapus kegiatan ini beserta seluruh dokumentasinya?'
                                                        )"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                    </a>

                                                </div>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php else : ?>

                                    <tr>

                                        <td
                                            colspan="6"
                                            class="text-center py-5 text-muted"
                                        >
                                            Belum ada data kegiatan KORSDA.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        <?= $this->include('admin/layout/footer') ?>

    </div>

</div>