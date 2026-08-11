<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <div class="card shadow">

            <div class="card-header">
                <h4 class="mb-0">
                    Edit Profil KORSDA
                </h4>
            </div>

            <div class="card-body">

                <!-- FLASH ERROR -->

                <?php if (session()->getFlashdata('error')): ?>

                    <div class="alert alert-danger">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>

                <?php endif; ?>


                <?php if (session()->getFlashdata('errors')): ?>

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            <?php foreach (
                                session()->getFlashdata('errors')
                                as $error
                            ): ?>

                                <li>
                                    <?= esc($error) ?>
                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <form
                    action="<?= base_url(
                        'admin/korsda/profil_korsda/update/' .
                        $profil['id']
                    ) ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field() ?>


                    <!-- =================================================
                         KORSDA / KECAMATAN
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="korsda_id"
                            class="form-label"
                        >
                            Kecamatan
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="korsda_id"
                            id="korsda_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Kecamatan --
                            </option>

                            <?php foreach ($korsda as $k): ?>

                                <option
                                    value="<?= esc($k['id']) ?>"
                                    <?= (
                                        ($profil['korsda_id'] ?? '')
                                        == $k['id']
                                    )
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= esc($k['nama'] ?? '-') ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- =================================================
                         VISI
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="visi"
                            class="form-label"
                        >
                            Visi
                        </label>

                        <textarea
                            name="visi"
                            id="visi"
                            class="form-control"
                            rows="4"
                            required
                        ><?= esc($profil['visi'] ?? '') ?></textarea>

                    </div>


                    <!-- =================================================
                         MISI
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="misi"
                            class="form-label"
                        >
                            Misi
                        </label>

                        <textarea
                            name="misi"
                            id="misi"
                            class="form-control"
                            rows="5"
                            required
                        ><?= esc($profil['misi'] ?? '') ?></textarea>

                    </div>


                    <!-- =================================================
                         TUGAS
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="tugas"
                            class="form-label"
                        >
                            Tugas
                        </label>

                        <textarea
                            name="tugas"
                            id="tugas"
                            class="form-control"
                            rows="5"
                            required
                        ><?= esc($profil['tugas'] ?? '') ?></textarea>

                    </div>


                    <!-- =================================================
                         FUNGSI
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="fungsi"
                            class="form-label"
                        >
                            Fungsi
                        </label>

                        <textarea
                            name="fungsi"
                            id="fungsi"
                            class="form-control"
                            rows="5"
                        ><?= esc($profil['fungsi'] ?? '') ?></textarea>

                    </div>


                    <!-- =================================================
                         STRUKTUR SAAT INI
                    ================================================== -->

                    <div class="mb-3">

                        <label class="form-label">
                            Struktur Saat Ini
                        </label>

                        <?php if (
                            !empty(
                                $profil['struktur_organisasi']
                            )
                        ): ?>

                            <div class="mb-3">

                                <img
                                    src="<?= base_url(
                                        'uploads/korsda/' .
                                        $profil[
                                            'struktur_organisasi'
                                        ]
                                    ) ?>"
                                    width="300"
                                    class="img-thumbnail"
                                    alt="Struktur Organisasi"
                                >

                            </div>

                        <?php else: ?>

                            <div class="text-muted">
                                Belum ada gambar struktur.
                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- =================================================
                         GANTI STRUKTUR
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="struktur_organisasi"
                            class="form-label"
                        >
                            Ganti Struktur
                        </label>

                        <input
                            type="file"
                            name="struktur_organisasi"
                            id="struktur_organisasi"
                            class="form-control"
                            accept="image/*"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti
                            gambar struktur.
                        </small>

                    </div>


                    <!-- =================================================
                         DESKRIPSI
                    ================================================== -->

                    <div class="mb-3">

                        <label
                            for="deskripsi"
                            class="form-label"
                        >
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            class="form-control"
                            rows="4"
                        ><?= esc($profil['deskripsi'] ?? '') ?></textarea>

                    </div>


                    <!-- =================================================
                         BUTTON
                    ================================================== -->

                    <div class="d-flex justify-content-end">

                        <a
                            href="<?= base_url(
                                'admin/korsda/profil_korsda'
                            ) ?>"
                            class="btn btn-secondary me-2"
                        >

                            <i class="bi bi-arrow-left me-1"></i>

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="bi bi-save me-1"></i>

                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>