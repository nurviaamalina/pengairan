<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper">

        <div class="container-fluid">

            <!-- HEADER -->
<div class="user-page-header">

    <div>
        <h3>
            Tambah Profil KORSDA
        </h3>

        <p>
            Tambahkan profil Koordinator Pengelola Sumber Daya Air
        </p>
    </div>

</div>



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


            <!-- FORM -->
            <div class="card shadow-sm border-0">

                <div class="card-header bg-white py-3">

                    <h5 class="mb-0 fw-bold">

                        <i class="bi bi-person-plus me-2"></i>

                        Form Tambah Profil KORSDA

                    </h5>

                </div>


                <div class="card-body p-4">

                    <form
                        action="<?= base_url('admin/korsda/profil_korsda/store') ?>"
                        method="post"
                        enctype="multipart/form-data"
                    >

                        <?= csrf_field() ?>


                        <!-- NAMA WILAYAH -->
                        <div class="mb-3">

                            <label
                                for="korsda_id"
                                class="form-label fw-semibold"
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
                                            <?= old('korsda_id') == $item['id']
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            <?= esc($item['nama_wilayah']) ?>

                                            <?php if (!empty($item['nama_kecamatan'])): ?>

                                                -
                                                <?= esc($item['nama_kecamatan']) ?>

                                            <?php endif; ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <option value="" disabled>
                                        Data wilayah belum tersedia
                                    </option>

                                <?php endif; ?>

                            </select>

                            <small class="text-muted">
                                Pilih wilayah yang sudah terdaftar pada data KORSDA.
                            </small>

                        </div>


                        <!-- STRUKTUR -->
                        <div class="mb-3">

                            <label
                                for="struktur_organisasi"
                                class="form-label fw-semibold"
                            >
                                Struktur Kepengurusan
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="file"
                                name="struktur_organisasi"
                                id="struktur_organisasi"
                                class="form-control"
                                accept="image/png,image/jpeg,image/jpg"
                                required
                            >

                            <small class="text-muted">
                                Format JPG/JPEG/PNG.
                            </small>

                        </div>




                        <!-- BUTTON -->
                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="<?= base_url('admin/korsda/profil_korsda') ?>"
                                class="btn btn-secondary"
                            >
                                <i class="bi bi-x-circle"></i>
                                Batal
                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
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

<?= $this->include('admin/layout/footer') ?>