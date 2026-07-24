<?= $this->include('Admin/layout/header') ?>

<style>
.page-header {
    background: linear-gradient(135deg, #f7b500 0%, #f9c840 100%);
    padding: 25px 30px;
    border-radius: 20px;
    margin-bottom: 25px;
}

.page-header h3 {
    color: #0a1a3a;
    font-weight: 700;
    margin-bottom: 5px;
}

.page-header p {
    color: rgba(10, 26, 58, 0.75);
    margin-bottom: 0;
}

.card-custom {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    background: #fff;
}

.card-custom .card-header {
    padding: 16px 22px;
    border: none;
    background: #fff;
    border-bottom: 3px solid #f7b500;
}

.card-custom .card-header h5 {
    font-weight: 700;
    margin: 0;
    color: #0a1a3a;
}

.card-custom .card-header h5 i {
    color: #f7b500;
}

.card-custom .card-body {
    padding: 22px 25px;
}

.btn-kembali {
    background: #0a1a3a;
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-kembali:hover {
    background: #1a2a5a;
    color: #fff;
    transform: translateY(-2px);
}

.btn-simpan {
    background: #f7b500;
    color: #0a1a3a;
    border: none;
    padding: 10px 30px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-simpan:hover {
    background: #e0a200;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(247, 181, 0, 0.3);
}

.text-danger {
    font-size: 0.85rem;
}
</style>

<div class="d-flex min-vh-100">
    <?= $this->include('Admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">
        <div class="p-4 flex-grow-1">

            <!-- ===== PAGE HEADER ===== -->
            <div class="page-header">
                <div>
                    <h3>
                        <i class="bi bi-plus-circle me-2"></i>
                        Tambah Profil Dinas Pengairan
                    </h3>
                    <p>Tambahkan informasi profil Dinas Pengairan</p>
                </div>
            </div>

            <!-- ===== FLASH ERROR ===== -->
            <?php if(session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        <?php foreach(session()->getFlashdata('errors') as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- ===== FORM ===== -->
            <div class="card card-custom">
                <div class="card-header">
                    <h5>
                        <i class="bi bi-file-text"></i>
                        Form Profil Dinas
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/profil/save') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- SEJARAH -->
                        <div class="mb-3">
                            <label for="sejarah" class="form-label fw-bold">
                                Sejarah <span class="text-danger">*</span>
                            </label>
                            <textarea name="sejarah" id="sejarah" class="form-control" rows="5"
                                      placeholder="Masukkan sejarah Dinas Pengairan"><?= old('sejarah') ?></textarea>
                            <?php if(isset($validation) && $validation->hasError('sejarah')): ?>
                                <div class="text-danger"><?= $validation->getError('sejarah') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- VISI -->
                        <div class="mb-3">
                            <label for="visi" class="form-label fw-bold">
                                Visi <span class="text-danger">*</span>
                            </label>
                            <textarea name="visi" id="visi" class="form-control" rows="5"
                                      placeholder="Masukkan visi Dinas Pengairan"><?= old('visi') ?></textarea>
                            <?php if(isset($validation) && $validation->hasError('visi')): ?>
                                <div class="text-danger"><?= $validation->getError('visi') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- MISI -->
                        <div class="mb-3">
                            <label for="misi" class="form-label fw-bold">
                                Misi <span class="text-danger">*</span>
                            </label>
                            <textarea name="misi" id="misi" class="form-control" rows="5"
                                      placeholder="Masukkan misi Dinas Pengairan"><?= old('misi') ?></textarea>
                            <?php if(isset($validation) && $validation->hasError('misi')): ?>
                                <div class="text-danger"><?= $validation->getError('misi') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- DESKRIPSI STRUKTUR -->
                        <div class="mb-3">
                            <label for="deskripsi_struktur" class="form-label fw-bold">
                                Deskripsi Struktur Organisasi
                            </label>
                            <textarea name="deskripsi_struktur" id="deskripsi_struktur" class="form-control" rows="3"
                                      placeholder="Masukkan deskripsi struktur organisasi"><?= old('deskripsi_struktur') ?></textarea>
                        </div>

                        <!-- GAMBAR STRUKTUR -->
                        <div class="mb-3">
                            <label for="struktur" class="form-label fw-bold">
                                Gambar Struktur Organisasi
                            </label>
                            <input type="file" name="struktur" id="struktur" class="form-control"
                                   accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Format: JPG, JPEG, PNG | Maks: 2MB</small>
                            <?php if(isset($validation) && $validation->hasError('struktur')): ?>
                                <div class="text-danger"><?= $validation->getError('struktur') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-simpan">
                                <i class="bi bi-save me-2"></i> Simpan
                            </button>
                            <a href="<?= base_url('admin/profil') ?>" class="btn btn-kembali">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->include('Admin/layout/footer') ?>