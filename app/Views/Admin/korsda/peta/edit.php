<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 p-4 bg-light">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Edit Peta Wilayah KORSDA
                </h4>

                <small class="text-muted">
                    Perbarui data peta wilayah kerja KORSDA.
                </small>
            </div>

            <a href="<?= base_url('admin/korsda/wilayah') ?>"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Kembali

            </a>

        </div>


        <!-- PESAN ERROR -->
        <?php if (session()->getFlashdata('error')) : ?>

            <div class="alert alert-danger alert-dismissible fade show">

                <i class="bi bi-exclamation-triangle me-2"></i>

                <?= esc(session()->getFlashdata('error')) ?>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('errors')) : ?>

            <div class="alert alert-danger">

                <strong>
                    <i class="bi bi-exclamation-circle me-2"></i>
                    Terdapat kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    <?php foreach (
                        session()->getFlashdata('errors')
                        as $error
                    ) : ?>

                        <li>
                            <?= esc($error) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <!-- CARD FORM -->
        <div class="card border-0 shadow-sm">

            <div class="card-header bg-warning text-dark">

                <h5 class="mb-0 fw-semibold">

                    <i class="bi bi-pencil-square me-2"></i>

                    Edit Wilayah Kerja

                </h5>

            </div>


            <div class="card-body p-4">

                <form
                    action="<?= base_url('admin/korsda/wilayah/update/' . $wilayah['id']) ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field() ?>


                    <!-- KORSDA -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            KORSDA
                            <span class="text-danger">*</span>

                        </label>


                        <select
                            name="korsda_id"
                            id="korsda_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih KORSDA --
                            </option>


                            <?php foreach ($korsda as $k) : ?>

                                <option
                                    value="<?= $k['id'] ?>"
                                    data-wilayah="<?= esc($k['nama_wilayah']) ?>"
                                    data-kecamatan="<?= esc($k['nama_kecamatan']) ?>"
                                    <?= $k['id'] == $wilayah['korsda_id']
                                        ? 'selected'
                                        : '' ?>
                                >

                                    <?= esc($k['nama_wilayah']) ?>

                                    -

                                    <?= esc($k['nama_kecamatan']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>


                        <div class="form-text">

                            Pilih KORSDA yang memiliki wilayah kerja
                            pada peta ini.

                        </div>

                    </div>


                    <!-- INFORMASI KORSDA -->
                    <div
                        id="informasiWilayah"
                        class="alert alert-light border mb-4"
                    >

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


                    <!-- FILE PETA LAMA -->
                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            File Peta Saat Ini

                        </label>


                        <?php if (!empty($wilayah['file_peta'])) : ?>

                            <div class="border rounded p-3 bg-light">

                                <i class="bi bi-file-earmark-zip text-warning me-2"></i>

                                <?= esc($wilayah['file_peta']) ?>

                                <a
                                    href="<?= base_url('uploads/wilayah/' . $wilayah['file_peta']) ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary float-end"
                                >

                                    <i class="bi bi-eye me-1"></i>
                                    Lihat

                                </a>

                            </div>

                        <?php else : ?>

                            <div class="text-muted">
                                Belum ada file peta.
                            </div>

                        <?php endif; ?>

                    </div>


                    <!-- GANTI FILE -->
                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Ganti File Peta

                        </label>


                        <input
                            type="file"
                            name="file_peta"
                            class="form-control"
                            accept=".zip"
                        >


                        <div class="form-text">

                            Kosongkan jika tidak ingin mengganti
                            file peta.

                            File harus berupa ZIP dan maksimal 50 MB.

                        </div>

                    </div>


                    <!-- GEOJSON -->
                    <?php if (!empty($wilayah['file_geojson'])) : ?>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                File GeoJSON

                            </label>

                            <div class="border rounded p-3 bg-light">

                                <i class="bi bi-map text-success me-2"></i>

                                <?= esc($wilayah['file_geojson']) ?>

                            </div>

                            <div class="form-text">

                                File GeoJSON dibuat otomatis dari
                                file SHP di dalam ZIP.

                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- INFO -->
                    <div class="alert alert-info">

                        <div class="d-flex">

                            <i class="bi bi-info-circle fs-5 me-2"></i>

                            <div>

                                <strong>Perhatian</strong>

                                <div class="small mt-1">

                                    Jika file ZIP baru diupload,
                                    sistem akan menghapus file peta lama,
                                    kemudian memproses SHP baru menjadi
                                    GeoJSON.

                                    Jika tidak mengupload file baru,
                                    file peta lama tetap digunakan.

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

                            <i class="bi bi-x-circle me-1"></i>

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="btn btn-warning"
                        >

                            <i class="bi bi-save me-1"></i>

                            Simpan Perubahan

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

    const namaWilayah =
        document.getElementById('namaWilayah');

    const namaKecamatan =
        document.getElementById('namaKecamatan');


    function tampilkanInformasi() {

        const option =
            selectKorsda.options[
                selectKorsda.selectedIndex
            ];


        if (!option || !option.value) {

            namaWilayah.textContent = '-';

            namaKecamatan.textContent = '-';

            return;
        }


        namaWilayah.textContent =
            option.dataset.wilayah || '-';

        namaKecamatan.textContent =
            option.dataset.kecamatan || '-';

    }


    selectKorsda.addEventListener(
        'change',
        tampilkanInformasi
    );


    tampilkanInformasi();

});

</script>


<?= $this->include('admin/layout/footer') ?>