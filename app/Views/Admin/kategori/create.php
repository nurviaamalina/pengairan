<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

<?= $this->include('Admin/layout/sidebar'); ?>

<div class="main">

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold">Tambah </h3>

            <a href="<?= base_url('admin/kategori'); ?>" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </div>
        
    </div>

        <div class="card shadow">

            <div class="card-body">


                    <form action="<?= base_url('admin/kategori/store'); ?>" method="post" enctype="multipart/form-data">

                <form action="<?= base_url('admin/kategori/store'); ?>" method="post" enctype="multipart/form-data">


                        <?= csrf_field(); ?>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama_kategori"
                            class="form-control"
                            value="<?= old('nama_kategori'); ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            value="<?= old('slug'); ?>"
                            required>

                    </div>


                    <div class="text-end">

                        <button type="submit" class="btn btn-primary">

                            <i class="fa fa-save"></i>

                            Simpan

                        </button>

                        <a href="<?= base_url('admin/kategori'); ?>" class="btn btn-danger">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>