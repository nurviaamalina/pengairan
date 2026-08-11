<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

<div class="content flex-grow-1 p-4 bg-light">

    <div class="card shadow">

        <div class="card-header">
            <h4 class="mb-0">Tambah Profil KORSDA</h4>
        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
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
                action="<?= base_url('admin/korsda/profil_korsda/store') ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>


                <!-- KORSDA -->

                <div class="mb-3">

                    <label
                        for="korsda_id"
                        class="form-label"
                    >
                        KORSDA / Kecamatan
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

                        <?php foreach ($korsda as $item): ?>

                            <?php
                                /*
                                 * Sesuaikan dengan field tabel KORSDA.
                                 * Jika tabel menggunakan nama_kecamatan,
                                 * akan mengambil nama_kecamatan.
                                 * Jika menggunakan nama, akan mengambil nama.
                                 */

                                $namaKecamatan =
                                    $item['nama_kecamatan']
                                    ?? $item['nama']
                                    ?? '-';
                            ?>

                            <option
                                value="<?= esc($item['id']) ?>"
                                <?= old('korsda_id') == $item['id']
                                    ? 'selected'
                                    : '' ?>
                            >
                                <?= esc($namaKecamatan) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- VISI -->

                <div class="mb-3">

                    <label class="form-label">
                        Visi
                    </label>

                    <textarea
                        name="visi"
                        rows="4"
                        class="form-control"
                        required
                    ><?= old('visi') ?></textarea>

                </div>


                <!-- MISI -->

                <div class="mb-3">

                    <label class="form-label">
                        Misi
                    </label>

                    <textarea
                        name="misi"
                        rows="4"
                        class="form-control"
                        required
                    ><?= old('misi') ?></textarea>

                </div>


                <!-- TUGAS -->

                <div class="mb-3">

                    <label class="form-label">
                        Tugas
                    </label>

                    <textarea
                        name="tugas"
                        rows="5"
                        class="form-control"
                        required
                    ><?= old('tugas') ?></textarea>

                </div>


                <!-- FUNGSI -->

                <div class="mb-3">

                    <label class="form-label">
                        Fungsi
                    </label>

                    <textarea
                        name="fungsi"
                        rows="5"
                        class="form-control"
                    ><?= old('fungsi') ?></textarea>

                </div>


                <!-- STRUKTUR -->

                <div class="mb-3">

                    <label class="form-label">
                        Struktur Kepengurusan
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="file"
                        name="struktur_organisasi"
                        class="form-control"
                        accept="image/*"
                        required
                    >

                </div>


                <!-- DESKRIPSI -->

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="form-control"
                    ><?= old('deskripsi') ?></textarea>

                </div>


                <!-- BUTTON -->

                <div class="d-flex justify-content-end">

                    <a
                        href="<?= base_url('admin/korsda/profil_korsda') ?>"
                        class="btn btn-secondary me-2"
                    >
                        Kembali
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

<?= $this->include('admin/layout/footer') ?>