<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

```
<!-- SIDEBAR -->
<?= $this->include('Admin/layout/sidebar'); ?>

<!-- MAIN CONTENT -->
<main class="content-wrapper">

    <!-- HEADER HALAMAN -->
    <div class="user-page-header">

    <div>
        <h3>
            <i class="bi bi-pencil-square me-2"></i>
            Edit Dokumen
        </h3>

        <p>
            Perbarui data dokumen yang sudah ada.
        </p>
    </div>

    <div>
        <a href="<?= base_url('admin/dokumen') ?>"
           class="btn btn-kembaliberita">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

</div>


    <!-- FORM EDIT DOKUMEN -->
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-body">

                <form
                    action="<?= base_url('admin/dokumen/update/' . $dokumen['id']); ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field(); ?>


                    <!-- KATEGORI -->
                    <div class="mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select
                            name="kategori_id"
                            class="form-control"
                            required
                        >

                            <?php foreach ($kategori as $k): ?>

                                <option
                                    value="<?= $k['id']; ?>"
                                    <?= ($k['id'] == $dokumen['kategori_id']) ? 'selected' : ''; ?>
                                >
                                    <?= esc($k['nama_kategori']); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- JUDUL -->
                    <div class="mb-3">

                        <label class="form-label">
                            Judul Dokumen
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="<?= esc($dokumen['judul']); ?>"
                            required
                        >

                    </div>


                    <!-- TAHUN -->
                    <div class="mb-3">

                        <label class="form-label">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            class="form-control"
                            value="<?= esc($dokumen['tahun']); ?>"
                            min="2000"
                            max="<?= date('Y'); ?>"
                            required
                        >

                    </div>


                    <!-- FILE PDF SAAT INI -->
                    <div class="mb-3">

                        <label class="form-label">
                            File PDF Saat Ini
                        </label>

                        <div class="mb-2">

                            <a
                                href="<?= base_url('uploads/dokumen/' . $dokumen['file']); ?>"
                                target="_blank"
                                class="btn btn-success btn-sm"
                            >
                                <i class="fa fa-file-pdf"></i>
                                <?= esc($dokumen['file']); ?>
                            </a>

                        </div>

                    </div>


                    <!-- GANTI FILE -->
                    <div class="mb-4">

                        <label class="form-label">
                            Ganti File PDF
                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            accept=".pdf,application/pdf"
                        >

                        <small class="text-muted">
                            Kosongkan jika tidak ingin mengganti file PDF.
                        </small>

                    </div>


                    <!-- BUTTON -->
                    <div class="text-end">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="fa fa-save"></i>
                            Update
                        </button>

                        <a
                            href="<?= base_url('admin/kategori/' . $dokumen['slug']); ?>"
                            class="btn btn-danger"
                        >
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</main>
```

</div>

<?= $this->include('Admin/layout/footer'); ?>
