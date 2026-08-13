<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    Tambah Peta Wilayah KORSDA
                </h2>

                <p class="text-muted mb-0">
                    Tambahkan data peta wilayah kerja KORSDA.
                </p>
            </div>

            <a href="<?= base_url('admin/korsda/wilayah') ?>"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

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


        <!-- VALIDATION ERRORS -->
        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <div class="fw-semibold mb-2">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    Terdapat kesalahan:
                </div>

                <ul class="mb-0">

                    <?php foreach (
                        session()->getFlashdata('errors')
                        as $error
                    ): ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <!-- FORM -->
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <form action="<?= base_url('admin/korsda/wilayah/store') ?>"
                      method="POST"
                      enctype="multipart/form-data">

                    <?= csrf_field() ?>


                    <!-- KORSDA -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            KORSDA
                            <span class="text-danger">*</span>
                        </label>

                        <select name="korsda_id"
                                id="korsda_id"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih KORSDA --
                            </option>

                            <?php foreach ($korsda as $item): ?>

                                <option
                                    value="<?= $item['id'] ?>"
                                    data-wilayah="<?= esc($item['nama_wilayah']) ?>"
                                    data-kecamatan="<?= esc($item['nama_kecamatan']) ?>"
                                    <?= old('korsda_id') == $item['id']
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= esc($item['nama_wilayah']) ?>
                                    -
                                    <?= esc($item['nama_kecamatan']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                        <div class="form-text">
                            Pilih KORSDA yang akan ditambahkan peta wilayahnya.
                        </div>

                    </div>


                    <!-- INFORMASI WILAYAH -->
                    <div id="informasiWilayah"
                         class="alert alert-light border mb-4"
                         style="display: none;">

                        <div class="row">

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Nama Wilayah
                                </small>

                                <strong id="namaWilayah">
                                    -
                                </strong>

                            </div>

                            <div class="col-md-6">

                                <small class="text-muted d-block">
                                    Kecamatan
                                </small>

                                <strong id="namaKecamatan">
                                    -
                                </strong>

                            </div>

                        </div>

                    </div>


                    <!-- FILE PETA -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            File Peta

                            <span class="text-danger">*</span>

                        </label>

                        <input
                            type="file"
                            name="file_peta"
                            id="file_peta"
                            class="form-control"
                            accept=".zip"
                            required
                        >

                        <div class="form-text">

                            Upload file ZIP yang berisi file Shapefile
                            (.shp, .shx, .dbf dan file pendukung lainnya).

                            Maksimal 50 MB.

                        </div>

                    </div>


                    <!-- KETERANGAN -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Keterangan

                        </label>

                        <textarea
                            name="keterangan"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan keterangan peta jika diperlukan..."
                        ><?= old('keterangan') ?></textarea>

                    </div>


                    <!-- INFO FORMAT -->
                    <div class="alert alert-info">

                        <div class="d-flex">

                            <i class="bi bi-info-circle fs-5 me-2"></i>

                            <div>

                                <strong>Informasi</strong>

                                <div class="small mt-1">

                                    File ZIP akan diproses secara otomatis.
                                    Sistem akan mencari file SHP dan mengubahnya
                                    menjadi GeoJSON untuk digunakan pada peta.

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- BUTTON -->
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a
                            href="<?= base_url('admin/korsda/wilayah') ?>"
                            class="btn btn-light border"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary"
                            id="btnSimpan"
                        >

                            <i class="bi bi-save me-1"></i>

                            Simpan Peta

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const selectKorsda =
        document.getElementById('korsda_id');

    const informasi =
        document.getElementById('informasiWilayah');

    const namaWilayah =
        document.getElementById('namaWilayah');

    const namaKecamatan =
        document.getElementById('namaKecamatan');


    function tampilkanInformasi() {

        const option =
            selectKorsda.options[
                selectKorsda.selectedIndex
            ];


        if (
            !option ||
            !option.value
        ) {

            informasi.style.display = 'none';

            namaWilayah.textContent = '-';
            namaKecamatan.textContent = '-';

            return;
        }


        const wilayah =
            option.dataset.wilayah || '-';

        const kecamatan =
            option.dataset.kecamatan || '-';


        namaWilayah.textContent =
            wilayah;

        namaKecamatan.textContent =
            kecamatan;


        informasi.style.display =
            'block';
    }


    selectKorsda.addEventListener(
        'change',
        tampilkanInformasi
    );


    // Tampilkan jika old value tersedia
    tampilkanInformasi();

});

</script>

<?= $this->include('admin/layout/footer') ?>