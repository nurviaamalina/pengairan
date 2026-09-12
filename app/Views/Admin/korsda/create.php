<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper">

        <!-- HEADER -->
        <div class="user-page-header">

            <div>
                <h3>
                    Tambah Profil KORSDA
                </h3>

                <p>
                    Tambahkan informasi profil KORSDA.
                </p>
            </div>

        </div>


        <!-- ERROR -->
        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <i class="bi bi-exclamation-triangle me-2"></i>

                <?= esc(session()->getFlashdata('error')) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <div class="fw-semibold mb-2">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    Terdapat kesalahan:
                </div>

                <ul class="mb-0">

                    <?php foreach (
                        session()->getFlashdata('errors') as $error
                    ): ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <!-- FORM -->
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form action="<?= base_url('admin/korsda/profil_korsda/store') ?>"
                      method="POST"
                      enctype="multipart/form-data">

                    <?= csrf_field() ?>

                   
                    <!-- =========================
                         KECAMATAN
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="kecamatan_id"
                            class="form-label"
                        >

                            Kecamatan

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <select
                            name="kecamatan_id"
                            id="kecamatan_id"
                            class="form-select"
                            required
                        >

                            <option value="">

                                -- Pilih Kecamatan --

                            </option>


                            <?php if (!empty($kecamatan)) : ?>

                                <?php foreach (
                                    $kecamatan as $item
                                ) : ?>

                                    <option
                                        value="<?= esc($item['id']) ?>"
                                        <?= old('kecamatan_id') == $item['id']
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        <?= esc(
                                            $item['nama_kecamatan']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            <?php else : ?>

                                <option
                                    value=""
                                    disabled
                                >

                                    Data kecamatan belum tersedia

                                </option>

                            <?php endif; ?>


                        </select>

                    </div>



                    <!-- =========================
                         NAMA WILAYAH
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="nama_wilayah"
                            class="form-label"
                        >

                            Nama Wilayah

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            name="nama_wilayah"
                            id="nama_wilayah"
                            class="form-control"
                            placeholder="Contoh: Wilayah Banyuwangi"
                            value="<?= esc(old('nama_wilayah')) ?>"
                            maxlength="100"
                            required
                        >

                    </div>



                    <!-- =========================
                         NAMA
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="nama"
                            class="form-label"
                        >

                            Nama

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control"
                            placeholder="Masukkan nama lengkap"
                            value="<?= esc(old('nama')) ?>"
                            maxlength="100"
                            required
                        >

                    </div>



                    <!-- =========================
                         JABATAN
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="jabatan"
                            class="form-label"
                        >

                            Jabatan

                            <span class="text-danger">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            name="jabatan"
                            id="jabatan"
                            class="form-control"
                            placeholder="Masukkan jabatan"
                            value="<?= esc(old('jabatan')) ?>"
                            maxlength="100"
                            required
                        >

                    </div>



                    <!-- =========================
                         NIP
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="nip"
                            class="form-label"
                        >

                            NIP

                        </label>


                        <input
                            type="text"
                            name="nip"
                            id="nip"
                            class="form-control"
                            placeholder="Masukkan NIP"
                            value="<?= esc(old('nip')) ?>"
                            maxlength="30"
                        >

                    </div>



                    <!-- =========================
                         EMAIL
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="email"
                            class="form-label"
                        >

                            Email

                        </label>


                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            placeholder="contoh@email.com"
                            value="<?= esc(old('email')) ?>"
                            maxlength="100"
                        >

                    </div>



                    <!-- =========================
                         NO HP
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="no_hp"
                            class="form-label"
                        >

                            No. HP

                        </label>


                        <input
                            type="text"
                            name="no_hp"
                            id="no_hp"
                            class="form-control"
                            placeholder="08xxxxxxxxxx"
                            value="<?= esc(old('no_hp')) ?>"
                            maxlength="20"
                        >

                    </div>



                    <!-- =========================
                         ALAMAT
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="alamat"
                            class="form-label"
                        >

                            Alamat

                        </label>


                        <textarea
                            name="alamat"
                            id="alamat"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan alamat"
                        ><?= esc(old('alamat')) ?></textarea>

                    </div>



                    <!-- =========================
                         FOTO
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="foto"
                            class="form-label"
                        >

                            Foto

                        </label>


                        <input
                            type="file"
                            name="foto"
                            id="foto"
                            class="form-control"
                            accept="image/png,image/jpeg,image/jpg"
                        >


                        <small class="text-muted">

                            Format JPG/JPEG/PNG.
                            Maksimal 2 MB.

                        </small>

                    </div>



                    <!-- =========================
                         STATUS
                    ========================== -->

                    <div class="mb-3">

                        <label
                            for="status"
                            class="form-label"
                        >

                            Status

                        </label>


                        <select
                            name="status"
                            id="status"
                            class="form-select"
                        >

                            <option
                                value="Aktif"
                                <?= old('status', 'Aktif') == 'Aktif'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Aktif

                            </option>


                            <option
                                value="Nonaktif"
                                <?= old('status') == 'Nonaktif'
                                    ? 'selected'
                                    : '' ?>
                            >

                                Nonaktif

                            </option>

                        </select>

                    </div>


                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="<?= base_url('admin/korsda/profil_korsda') ?>"
                           class="btn btn-light border">

                            <i class="bi bi-arrow-left me-1"></i>
                            Batal

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="bi bi-save me-1"></i>
                            Simpan Profil

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<?= $this->include('admin/layout/footer') ?>