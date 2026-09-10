<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper">

        <div class="container-fluid py-4">

            <!-- ==========================================
                 HEADER HALAMAN
            =========================================== -->

            <div class="user-page-header">

                <div>
                    <h3>
                        Data Kegiatan KORSDA
                    </h3>

                    <p>
                        Kelola kegiatan masing-masing KORSDA
                    </p>
                </div>

                <div class="d-flex gap-2">

                    <!-- IMPORT -->
                    <a
                        href="<?= base_url('admin/korsda/kegiatan/import') ?>"
                        class="btn btn-success"
                    >
                        <i class="bi bi-upload me-1"></i>
                        Import
                    </a>

                    <!-- TAMBAH -->
                    <a
                        href="<?= base_url('admin/korsda/kegiatan/create') ?>"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Kegiatan
                    </a>

                </div>

            </div>


            <!-- ==========================================
                 FLASH MESSAGE SUCCESS
            =========================================== -->

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


            <!-- ==========================================
                 FLASH MESSAGE ERROR
            =========================================== -->

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


            <!-- ==========================================
                 CARD DATA KEGIATAN
            =========================================== -->

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <!-- ============================
                                 TABLE HEADER
                            ============================= -->

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


                            <!-- ============================
                                 TABLE BODY
                            ============================= -->

                            <tbody>

                                <?php if (!empty($kegiatan)) : ?>

                                    <?php foreach ($kegiatan as $no => $item) : ?>

                                        <tr>

                                            <!-- NOMOR -->
                                            <td>
                                                <?= $no + 1 ?>
                                            </td>


                                            <!-- GAMBAR -->
                                            <td>

                                                <?php

                                                /*
                                                 * Lokasi thumbnail baru
                                                 */
                                                $gambarPathBaru =
                                                    FCPATH .
                                                    'uploads/Kegiatan/thumbnail/' .
                                                    ($item['gambar'] ?? '');


                                                /*
                                                 * Lokasi gambar lama
                                                 */
                                                $gambarPathLama =
                                                    FCPATH .
                                                    'uploads/kegiatan/' .
                                                    ($item['gambar'] ?? '');


                                                /*
                                                 * Tentukan URL gambar
                                                 */
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
                                                    alt="<?= esc($item['judul'] ?? 'Kegiatan') ?>"
                                                    style="
                                                        width:75px;
                                                        height:55px;
                                                        object-fit:cover;
                                                        border-radius:8px;
                                                    "
                                                >

                                            </td>


                                            <!-- WILAYAH -->
                                            <td>

                                                <strong>

                                                    <?= esc(
                                                        $item['nama_wilayah'] ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <!-- JUDUL -->
                                            <td>

                                                <strong>

                                                    <?= esc(
                                                        $item['judul'] ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <!-- TANGGAL -->
                                            <td>

                                                <?php if (!empty($item['tanggal'])) : ?>

                                                    <?= date(
                                                        'd/m/Y',
                                                        strtotime($item['tanggal'])
                                                    ) ?>

                                                <?php else : ?>

                                                    -

                                                <?php endif; ?>

                                            </td>


                                            <!-- AKSI -->
                                            <td>

                                                <div class="d-flex gap-1">

                                                    <!-- EDIT -->
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


                                                    <!-- HAPUS -->
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

                                    <!-- ============================
                                         DATA KOSONG
                                    ============================= -->

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


    </main>

</div>


<?= $this->include('admin/layout/footer') ?>