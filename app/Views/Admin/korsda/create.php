<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="container-fluid">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="fw-bold mb-1">
                        Tambah Data KORSDA
                    </h2>

                    <p class="text-muted mb-0">
                        Tambahkan data Koordinator Pengelola Sumber Daya Air
                    </p>
                </div>

                <a href="<?= base_url('admin/korsda') ?>"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </a>

            </div>


            <!-- ERROR -->
            <?php if (session()->getFlashdata('errors')): ?>

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        <?php foreach (session()->getFlashdata('errors') as $error): ?>

                            <li><?= esc($error) ?></li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>


            <!-- FORM -->
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0 fw-bold">

                        <i class="bi bi-person-plus me-2"></i>

                        Form Tambah KORSDA

                    </h5>

                </div>


                <div class="card-body p-4">

                    <form action="<?= base_url('admin/korsda/store') ?>"
                          method="post"
                          enctype="multipart/form-data">

                        <?= csrf_field() ?>


                        <!-- KECAMATAN -->
                        <div class="mb-3">

                            <label for="kecamatan_id"
                                   class="form-label fw-semibold">

                                Kecamatan
                                <span class="text-danger">*</span>

                            </label>


                            <select name="kecamatan_id"
                                    id="kecamatan_id"
                                    class="form-select"
                                    required>

                                <option value="">
                                    -- Pilih Kecamatan --
                                </option>


                                <?php if (!empty($kecamatan)): ?>

                                    <?php foreach ($kecamatan as $item): ?>

                                        <option
                                            value="<?= esc($item['id']) ?>"
                                            <?= old('kecamatan_id') == $item['id'] ? 'selected' : '' ?>>

                                            <?= esc($item['nama_kecamatan']) ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php endif; ?>

                            </select>

                        </div>


                        <!-- NAMA WILAYAH -->
                        <div class="mb-3">

                            <label for="nama_wilayah"
                                   class="form-label fw-semibold">

                                Nama Wilayah
                                <span class="text-danger">*</span>

                            </label>


                            <input type="text"
                                   name="nama_wilayah"
                                   id="nama_wilayah"
                                   class="form-control"
                                   value="<?= old('nama_wilayah') ?>"
                                   placeholder="Contoh: Wilayah Banyuwangi"
                                   maxlength="100"
                                   required>

                        </div>


                        <!-- NAMA -->
                        <div class="mb-3">

                            <label for="nama"
                                   class="form-label fw-semibold">

                                Nama
                                <span class="text-danger">*</span>

                            </label>


                            <input type="text"
                                   name="nama"
                                   id="nama"
                                   class="form-control"
                                   value="<?= old('nama') ?>"
                                   placeholder="Masukkan nama lengkap"
                                   maxlength="100"
                                   required>

                        </div>


                        <!-- JABATAN -->
                        <div class="mb-3">

                            <label for="jabatan"
                                   class="form-label fw-semibold">

                                Jabatan
                                <span class="text-danger">*</span>

                            </label>


                            <input type="text"
                                   name="jabatan"
                                   id="jabatan"
                                   class="form-control"
                                   value="<?= old('jabatan') ?>"
                                   placeholder="Masukkan jabatan"
                                   maxlength="100"
                                   required>

                        </div>


                        <!-- NIP -->
                        <div class="mb-3">

                            <label for="nip"
                                   class="form-label fw-semibold">

                                NIP

                            </label>


                            <input type="text"
                                   name="nip"
                                   id="nip"
                                   class="form-control"
                                   value="<?= old('nip') ?>"
                                   placeholder="Masukkan NIP"
                                   maxlength="30">

                        </div>


                        <!-- EMAIL -->
                        <div class="mb-3">

                            <label for="email"
                                   class="form-label fw-semibold">

                                Email

                            </label>


                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control"
                                   value="<?= old('email') ?>"
                                   placeholder="contoh@email.com"
                                   maxlength="100">

                        </div>


                        <!-- NO HP -->
                        <div class="mb-3">

                            <label for="no_hp"
                                   class="form-label fw-semibold">

                                No. HP

                            </label>


                            <input type="text"
                                   name="no_hp"
                                   id="no_hp"
                                   class="form-control"
                                   value="<?= old('no_hp') ?>"
                                   placeholder="08xxxxxxxxxx"
                                   maxlength="20">

                        </div>


                        <!-- ALAMAT -->
                        <div class="mb-3">

                            <label for="alamat"
                                   class="form-label fw-semibold">

                                Alamat

                            </label>


                            <textarea name="alamat"
                                      id="alamat"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Masukkan alamat"><?= old('alamat') ?></textarea>

                        </div>


                        <!-- FOTO -->
                        <div class="mb-3">

                            <label for="foto"
                                   class="form-label fw-semibold">

                                Foto

                            </label>


                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="form-control"
                                   accept="image/png,image/jpeg,image/jpg">


                            <small class="text-muted">

                                Format JPG/JPEG/PNG. Maksimal 2 MB.

                            </small>

                        </div>


                        <!-- STATUS -->
                        <div class="mb-4">

                            <label for="status"
                                   class="form-label fw-semibold">

                                Status

                            </label>


                            <select name="status"
                                    id="status"
                                    class="form-select">

                                <option value="Aktif"
                                    <?= old('status', 'Aktif') == 'Aktif' ? 'selected' : '' ?>>

                                    Aktif

                                </option>

                                <option value="Nonaktif"
                                    <?= old('status') == 'Nonaktif' ? 'selected' : '' ?>>

                                    Nonaktif

                                </option>

                            </select>

                        </div>


                        <!-- BUTTON -->
                        <div class="d-flex justify-content-end gap-2">

                            <a href="<?= base_url('admin/korsda') ?>"
                               class="btn btn-secondary">

                                <i class="bi bi-x-circle"></i>
                                Batal

                            </a>


                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-save"></i>
                                Simpan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>