<?= $this->include('Admin/layout/header'); ?>
<?= $this->include('Admin/layout/sidebar'); ?>

<div class="content-wrapper">

    <div class="page-header">

        <h2>Edit Kategori Dokumen</h2>

    </div>

    <div class="card">

        <form action="<?= base_url('admin/kategori/update/'.$kategori['id']); ?>" method="post">

            <?= csrf_field(); ?>

            <div class="form-group">

                <label>Nama Kategori</label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-control"
                    value="<?= esc($kategori['nama_kategori']); ?>"
                    required>

            </div>

            <div class="form-group">

                <label>Slug</label>

                <input
                    type="text"
                    name="slug"
                    class="form-control"
                    value="<?= esc($kategori['slug']); ?>"
                    required>

            </div>

            <button type="submit" class="btn btn-success">
                Update
            </button>

            <a href="<?= base_url('admin/kategori'); ?>" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>