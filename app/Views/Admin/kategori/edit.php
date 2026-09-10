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
            Edit Kategori
        </h3>

        <p>
            Perbarui informasi kategori dokumen.
        </p>
    </div>


</div>


    <!-- FORM EDIT -->
    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-body">

                <form
                    action="<?= base_url('admin/kategori/update/' . $kategori['id']) ?>"
                    method="post"
                >

                    <?= csrf_field(); ?>


                    <!-- NAMA KATEGORI -->
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama_kategori"
                            class="form-control"
                            value="<?= esc($kategori['nama_kategori']); ?>"
                            required
                        >

                    </div>


                    <!-- SLUG -->
                    <div class="mb-3">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            value="<?= esc($kategori['slug']); ?>"
                            required
                        >

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
                            href="<?= base_url('admin/kategori'); ?>"
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
