<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

<?= $this->include('Admin/layout/sidebar'); ?>

<div class="main">

    <div class="container-fluid">

       

             <div class="topbar">
            <h3>Tambah Dokumen</h3>
</div>
        
    </div>

        <div class="card shadow">

            <div class="card-body">

                <form action="<?= base_url('admin/dokumen/store'); ?>" method="post" enctype="multipart/form-data">

                    <?= csrf_field(); ?>

                    <div class="mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select name="kategori_id" class="form-control" required>

                    <option value="">-- Pilih Kategori --</option>

                    <?php foreach($kategori as $k) : ?>

                        <option value="<?= $k['id']; ?>">

                            <?= esc($k['nama_kategori']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>


                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Judul 
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Tahun
                        </label>

                        <input
                            type="number"
                            name="tahun"
                            class="form-control"
                            min="2000"
                            max="<?= date('Y'); ?> "
                            required>

                    </div>


                    <div class="mb-4">

                        <label class="form-label">
                            Upload File PDF
                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            accept=".pdf"
                            required>

                        <small class="text-muted">
                            File yang diperbolehkan hanya PDF.
                        </small>

                    </div>

                    <div class="text-end">

                        <button type="submit" class="btn btn-primary">

                            <i class="fa fa-save"></i>

                            Simpan

                        </button>

                        <a href="<?= base_url('admin/kategori/' .$slug); ?>" class="btn btn-danger">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>