<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Edit KORSDA
                </h4>

                <small class="text-muted">
                    Ubah data KORSDA yang sudah tersimpan.
                </small>
            </div>

            <a href="<?= base_url('admin/korsda') ?>"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Kembali

            </a>

        </div>


        <!-- CARD -->
        <div class="card shadow-sm">

            <div class="card-body p-4">

                <form
                    action="<?= base_url('admin/korsda/update/' . $korsda['id']) ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>


                    <!-- BARIS 1 -->
                    <div class="row">

                        <!-- Kecamatan -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Kecamatan
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="kecamatan_id"
                                class="form-select"
                                required>

                                <option value="">
                                    -- Pilih Kecamatan --
                                </option>

                                <?php foreach ($kecamatan as $item) : ?>

                                    <option
                                        value="<?= esc($item['id']) ?>"
                                        <?= old(
                                            'kecamatan_id',
                                            $korsda['kecamatan_id']
                                        ) == $item['id']
                                            ? 'selected'
                                            : '' ?>>

                                        <?= esc($item['nama_kecamatan']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- Nama Wilayah -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Nama Wilayah
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_wilayah"
                                class="form-control"
                                value="<?= old(
                                    'nama_wilayah',
                                    $korsda['nama_wilayah'] ?? ''
                                ) ?>"
                                placeholder="Masukkan nama wilayah"
                                maxlength="100"
                                required>

                        </div>

                    </div>


                    <!-- BARIS 2 -->
                    <div class="row">

                        <!-- Nama -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Nama
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                value="<?= old(
                                    'nama',
                                    $korsda['nama'] ?? ''
                                ) ?>"
                                required>

                        </div>


                        <!-- Jabatan -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Jabatan
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="jabatan"
                                class="form-control"
                                value="<?= old(
                                    'jabatan',
                                    $korsda['jabatan'] ?? ''
                                ) ?>"
                                required>

                        </div>

                    </div>


                    <!-- BARIS 3 -->
                    <div class="row">

                        <!-- NIP -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                NIP
                            </label>

                            <input
                                type="text"
                                name="nip"
                                class="form-control"
                                value="<?= old(
                                    'nip',
                                    $korsda['nip'] ?? ''
                                ) ?>">

                        </div>


                        <!-- Email -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?= old(
                                    'email',
                                    $korsda['email'] ?? ''
                                ) ?>">

                        </div>

                    </div>


                    <!-- BARIS 4 -->
                    <div class="row">

                        <!-- No HP -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                No. HP
                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                value="<?= old(
                                    'no_hp',
                                    $korsda['no_hp'] ?? ''
                                ) ?>">

                        </div>


                        <!-- Status -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label fw-semibold">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option
                                    value="Aktif"
                                    <?= old(
                                        'status',
                                        $korsda['status'] ?? 'Aktif'
                                    ) == 'Aktif'
                                        ? 'selected'
                                        : '' ?>>

                                    Aktif

                                </option>

                                <option
                                    value="Nonaktif"
                                    <?= old(
                                        'status',
                                        $korsda['status'] ?? ''
                                    ) == 'Nonaktif'
                                        ? 'selected'
                                        : '' ?>>

                                    Nonaktif

                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- ALAMAT -->
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="form-control"><?= old(
                                'alamat',
                                $korsda['alamat'] ?? ''
                            ) ?></textarea>

                    </div>


                    <!-- FOTO -->
                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Foto
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept="image/png,image/jpeg,image/jpg">

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>

                    </div>


                    <!-- FOTO SAAT INI -->
                    <?php
                    $foto = $korsda['foto'] ?? '';
                    $fotoPath = FCPATH . 'uploads/korsda/' . $foto;
                    ?>

                    <?php if (
                        !empty($foto) &&
                        $foto !== 'default.png' &&
                        file_exists($fotoPath)
                    ) : ?>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Foto Saat Ini
                            </label>

                            <div>

                                <img
                                    src="<?= base_url(
                                        'uploads/korsda/' . $foto
                                    ) ?>"
                                    width="120"
                                    height="120"
                                    class="img-thumbnail"
                                    style="object-fit: cover;"
                                    alt="<?= esc($korsda['nama'] ?? 'Foto KORSDA') ?>">

                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- TOMBOL -->
                    <div class="text-end mt-3">

                        <button
                            type="reset"
                            class="btn btn-light">

                            Reset

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-save"></i>
                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>


        <!-- KEMBALI -->
        <div class="mt-3">

            <button
                type="button"
                class="btn btn-kembali"
                onclick="window.location.href='<?= base_url(
                    'admin/korsda/dashboard'
                ) ?>'">

                <i class="bi bi-arrow-left me-2"></i>
                Kembali

            </button>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>