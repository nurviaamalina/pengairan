<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <h2 class="fw-bold mb-4">
            Edit Kegiatan KORSDA
        </h2>


        <!-- ERROR -->
        <?php if (session()->getFlashdata('error')): ?>

            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (
                        session()->getFlashdata('errors') as $error
                    ): ?>

                        <li>
                            <?= esc($error) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <div class="card shadow-sm">

            <div class="card-body">

                <form
                    action="<?= site_url(
                        'admin/korsda/kegiatan/update/' . $kegiatan['id']
                    ) ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field() ?>


                    <!-- NAMA WILAYAH -->
                    <div class="mb-3">

                        <label
                            for="korsda_id"
                            class="form-label"
                        >
                            Nama Wilayah
                            <span class="text-danger">*</span>
                        </label>


                        <select
                            name="korsda_id"
                            id="korsda_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Nama Wilayah --
                            </option>


                            <?php if (!empty($korsda)): ?>

                                <?php foreach ($korsda as $item): ?>

                                    <option
                                        value="<?= esc($item['id']) ?>"
                                        <?= (
                                            ($kegiatan['korsda_id'] ?? '')
                                            == $item['id']
                                        )
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        <?= esc(
                                            $item['nama_wilayah']
                                        ) ?>

                                    </option>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <option value="" disabled>
                                    Data nama wilayah belum tersedia
                                </option>

                            <?php endif; ?>

                        </select>

                    </div>


                    <!-- JUDUL -->
                    <div class="mb-3">

                        <label
                            for="judul"
                            class="form-label"
                        >
                            Judul
                            <span class="text-danger">*</span>
                        </label>


                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            class="form-control"
                            value="<?= esc(
                                $kegiatan['judul'] ?? ''
                            ) ?>"
                            required
                        >

                    </div>


                    <!-- TANGGAL -->
                    <div class="mb-3">

                        <label
                            for="tanggal"
                            class="form-label"
                        >
                            Tanggal
                            <span class="text-danger">*</span>
                        </label>


                        <input
                            type="date"
                            name="tanggal"
                            id="tanggal"
                            class="form-control"
                            value="<?= esc(
                                $kegiatan['tanggal'] ?? ''
                            ) ?>"
                            required
                        >

                    </div>


                    <!-- GAMBAR LAMA -->
                    <div class="mb-3">

                        <label class="form-label">
                            Gambar Saat Ini
                        </label>


                        <?php if (
                            !empty($kegiatan['gambar'])
                        ): ?>

                            <div class="mb-2">

                                <img
                                    src="<?= base_url(
                                        'uploads/kegiatan/' .
                                        $kegiatan['gambar']
                                    ) ?>"
                                    alt="Gambar Kegiatan"
                                    class="img-thumbnail"
                                    style="
                                        max-width: 250px;
                                        max-height: 180px;
                                        object-fit: cover;
                                    "
                                >

                            </div>

                        <?php else: ?>

                            <p class="text-muted">
                                Belum ada gambar.
                            </p>

                        <?php endif; ?>

                    </div>


                    <!-- GANTI GAMBAR -->
                    <div class="mb-3">

                        <label
                            for="gambar"
                            class="form-label"
                        >
                            Ganti Gambar
                        </label>


                        <input
                            type="file"
                            name="gambar"
                            id="gambar"
                            class="form-control"
                            accept="image/png,image/jpeg,image/jpg"
                        >


                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </small>

                    </div>


                    <!-- ISI KEGIATAN -->
                    <div class="mb-4">

                        <label
                            for="isi"
                            class="form-label"
                        >
                            Isi Kegiatan
                            <span class="text-danger">*</span>
                        </label>


                        <textarea
                            name="isi"
                            id="isi"
                            rows="6"
                            class="form-control"
                            required
                        ><?= esc(
                            $kegiatan['isi'] ?? ''
                        ) ?></textarea>

                    </div>


                    <!-- BUTTON -->
                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="bi bi-save me-1"></i>
                            Update
                        </button>


                        <a
                            href="<?= site_url(
                                'admin/korsda/kegiatan'
                            ) ?>"
                            class="btn btn-secondary"
                        >
                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('admin/layout/footer') ?>