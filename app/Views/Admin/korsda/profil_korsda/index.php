<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

   <?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Profil KORSDA
            </h4>

            <small class="text-muted">
                Kelola profil setiap KORSDA.
            </small>
        </div>

        <a
            href="<?= base_url('admin/korsda/profil_korsda/create') ?>"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Profil
        </a>

    </div>


    <!-- FLASH SUCCESS -->
    <?php if (session()->getFlashdata('success')): ?>

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-check-circle me-2"></i>

            <?= esc(session()->getFlashdata('success')) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <!-- FLASH ERROR -->
    <?php if (session()->getFlashdata('error')): ?>

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <i class="bi bi-exclamation-triangle me-2"></i>

            <?= esc(session()->getFlashdata('error')) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <!-- CARD -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table
                    class="table table-bordered table-hover align-middle mb-0"
                >

                    <!-- HEADER TABLE -->

                    <thead class="table-light">

                        <tr class="text-center">

                            <th width="60">
                                No
                            </th>

                            <th>
                                Kecamatan
                            </th>

                            <th>
                                Visi
                            </th>

                            <th>
                                Misi
                            </th>

                            <th>
                                Tugas
                            </th>

                            <th width="150">
                                Struktur
                            </th>

                            <th width="180">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <!-- BODY TABLE -->

                    <tbody>

                    <?php if (empty($profil)): ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-4"
                            >

                                <div class="text-muted">

                                    <i
                                        class="bi bi-folder2-open fs-3 d-block mb-2"
                                    ></i>

                                    Belum ada data Profil KORSDA.

                                </div>

                            </td>

                        </tr>

                    <?php else: ?>

                        <?php $no = 1; ?>

                        <?php foreach ($profil as $row): ?>

                            <tr>

                                <!-- NOMOR -->

                                <td class="text-center">

                                    <?= $no++ ?>

                                </td>


                                <!-- KECAMATAN -->

                                <td>

                                    <span class="fw-semibold">

                                        <?= esc(
                                            $row['nama_kecamatan'] ?? '-'
                                        ) ?>

                                    </span>

                                </td>


                                <!-- VISI -->

                                <td>

                                    <?php if (!empty($row['visi'])): ?>

                                        <?= word_limiter(
                                            strip_tags($row['visi']),
                                            10
                                        ) ?>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- MISI -->

                                <td>

                                    <?php if (!empty($row['misi'])): ?>

                                        <?= word_limiter(
                                            strip_tags($row['misi']),
                                            10
                                        ) ?>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- TUGAS -->

                                <td>

                                    <?php if (!empty($row['tugas'])): ?>

                                        <?= word_limiter(
                                            strip_tags($row['tugas']),
                                            10
                                        ) ?>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            -
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- STRUKTUR ORGANISASI -->

                                <td class="text-center">

                                    <?php if (
                                        !empty(
                                            $row['struktur_organisasi']
                                        )
                                    ): ?>

                                        <img
                                            src="<?= base_url(
                                                'uploads/korsda/' .
                                                $row[
                                                    'struktur_organisasi'
                                                ]
                                            ) ?>"
                                            class="img-thumbnail"
                                            width="120"
                                            alt="Struktur Organisasi"
                                        >

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Belum ada
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- AKSI -->

                                <td class="text-center">

                                    <div
                                        class="d-flex justify-content-center gap-1"
                                    >

                                        <!-- EDIT -->

                                        <a
                                            href="<?= base_url(
                                                'admin/korsda/profil_korsda/edit/' .
                                                $row['id']
                                            ) ?>"
                                            class="btn btn-warning btn-sm"
                                            title="Edit"
                                        >

                                            <i
                                                class="bi bi-pencil-square"
                                            ></i>

                                        </a>


                                        <!-- HAPUS -->

                                        <a
                                            href="<?= base_url(
                                                'admin/korsda/profil_korsda/delete/' .
                                                $row['id']
                                            ) ?>"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus"
                                            onclick="return confirm(
                                                'Yakin ingin menghapus profil KORSDA ini?'
                                            )"
                                        >

                                            <i
                                                class="bi bi-trash"
                                            ></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- KEMBALI -->

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