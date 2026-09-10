<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper">

        <div class="card shadow-sm">

<div class="user-page-header">

    <div>
        <h3>
            Tambah Kecamatan
        </h3>

        <p>
            Tambahkan data kecamatan KORSDA.
        </p>
    </div>

</div>


            <div class="card-body">

                <?php if (session()->getFlashdata('errors')) : ?>

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                                <li><?= esc($error) ?></li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>

                <form action="<?= base_url('admin/korsda/kecamatan/store') ?>" method="post">

                    <?= csrf_field(); ?>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Kecamatan <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama_kecamatan"
                            class="form-control"
                            placeholder="Masukkan Nama Kecamatan"
                            value="<?= old('nama_kecamatan') ?>"
                            required
                        >

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan
                        </button>

                        <a href="<?= base_url('admin/korsda/kecamatan') ?>" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<?= $this->include('admin/layout/footer') ?>