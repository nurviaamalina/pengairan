<?= $this->include('admin/layout/header') ?>

<div class="d-flex">

    <?= $this->include('admin/layout/sidebar') ?>

    <main class="content-wrapper">

<div class="user-page-header">

    <div>
        <h3>
            Edit Kecamatan
        </h3>

        <p>
            Perbarui data kecamatan KORSDA.
        </p>
    </div>

</div>


<!-- CARD FORM -->
<div class="card shadow-sm">

    <div class="card-body">

        <?php if (session()->getFlashdata('errors')) : ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                        <li>
                            <?= esc($error) ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <form action="<?= base_url('admin/korsda/kecamatan/update/' . $kecamatan['id']) ?>"
              method="post">

            <?= csrf_field(); ?>


            <!-- NAMA KECAMATAN -->
            <div class="mb-3">

                <label class="form-label">
                    Nama Kecamatan
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="nama_kecamatan"
                    class="form-control"
                    value="<?= old('nama_kecamatan', $kecamatan['nama_kecamatan']) ?>"
                    required
                >

            </div>


            <!-- LANJUTKAN FIELD FORM DI SINI -->


        </form>

    </div>

</div>


                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update
                        </button>

                        <a href="<?= base_url('admin/korsda/kecamatan') ?>" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

<?= $this->include('admin/layout/footer') ?>