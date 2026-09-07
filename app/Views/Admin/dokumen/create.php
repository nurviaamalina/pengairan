<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

```
<!-- SIDEBAR -->
<?= $this->include('Admin/layout/sidebar'); ?>

<!-- MAIN CONTENT -->
<main class="content-wrapper">

    <!-- HEADER HALAMAN -->
    <div class="container-fluid">

        <div class="topbar">
            <h3>Tambah Dokumen</h3>
        </div>

    </div>


    <!-- FORM TAMBAH DOKUMEN -->
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-body">

                <form
                    action="<?= base_url('admin/dokumen/store'); ?>"
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

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            <?php foreach ($kategori as $k): ?>

                                <option
                                    value="<?= $k['id']; ?>"
                                    <?= old('kategori_id') == $k['id'] ? 'selected' : ''; ?>
                                >
                                    <?= esc($k['nama_kategori']); ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>


                    <!-- JUDUL -->
                    <div class="mb-3">

                        <label class="form-label">
                            Judul
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="<?= old('judul'); ?>"
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
                            min="2000"
                            max="<?= date('Y'); ?>"
                            value="<?= old('tahun'); ?>"
                            required
                        >

                    </div>


                    <!-- FILE PDF -->
                    <div class="mb-4">

                        <label class="form-label">
                            Upload File PDF
                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            accept=".pdf,application/pdf"
                            required
                        >

                        <small class="text-muted">
                            File yang diperbolehkan hanya PDF.
                        </small>

                    </div>


                    <!-- BUTTON -->
                    <div class="text-end">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <i class="fa fa-save"></i>
                            Simpan

                        </button>

                        <a
                            href="<?= base_url('admin/kategori/' . $slug); ?>"
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
