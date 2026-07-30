<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

<?= $this->include('Admin/layout/sidebar'); ?>

<div class="main">

    <div class="container-fluid">

          <div class="topbar">
            <h3>Edit</h3>

        </div>
        
    </div>

        <div class="card shadow">

            <div class="card-body">

                <form action="<?= base_url('admin/dokumen/update/'.$dokumen['id']); ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field(); ?>

                    <div class="mb-3">

                        <label class="form-label">
                            Kategori
                        </label>

                        <select name="kategori_id" class="form-control">

                    <?php foreach($kategori as $k) : ?>

                        <option
                            value="<?= $k['id']; ?>"
                            <?= ($k['id'] == $dokumen['kategori_id']) ? 'selected' : ''; ?>>

                            <?= esc($k['nama_kategori']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Judul Dokumen
                        </label>

                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            value="<?= esc($dokumen['judul']); ?>"
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
                            value="<?= esc($dokumen['tahun']); ?>"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            File PDF Saat Ini
                        </label>

                        <div class="mb-2">

                            <a href="<?= base_url('uploads/dokumen/'.$dokumen['file']); ?>"
                                target="_blank"
                                class="btn btn-success btn-sm">

                                 <?= esc($dokumen['file']); ?>
                            </a>

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Ganti File PDF

                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            accept=".pdf">

                        <small class="text-muted">

                            Kosongkan jika tidak ingin mengganti file PDF.

                        </small>

                    </div>

                    <div class="text-end">

                        <button type="submit"
                            class="btn btn-primary">

                            <i class="fa fa-save"></i>

                            Update

                        </button>

                        <a href="<?= base_url('admin/kategori/'.$dokumen['slug']); ?>"
                            class="btn btn-danger">

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>