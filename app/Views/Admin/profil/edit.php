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

.btn-update {
    background: #f7b500;
    color: #0a1a3a;
    border: none;
    padding: 10px 30px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-update:hover {
    background: #e0a200;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(247, 181, 0, 0.3);
}

.text-danger {
    font-size: 0.85rem;
}

.preview-image {
    max-width: 300px;
    border-radius: 8px;
    border: 1px solid #ddd;
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
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Profil Dinas Pengairan
                    </h3>
                    <p>Edit informasi profil Dinas Pengairan</p>
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
                        Form Edit Profil Dinas
                    </h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/profil/update/'.$profil['id']) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <!-- SEJARAH -->
                        <div class="mb-3">
                            <label for="sejarah" class="form-label fw-bold">
                                Sejarah <span class="text-danger">*</span>
                            </label>
                            <textarea name="sejarah" id="sejarah" class="form-control" rows="5"
                                      placeholder="Masukkan sejarah Dinas Pengairan"><?= old('sejarah', $profil['sejarah']) ?></textarea>
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
                                      placeholder="Masukkan visi Dinas Pengairan"><?= old('visi', $profil['visi']) ?></textarea>
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
                                      placeholder="Masukkan misi Dinas Pengairan"><?= old('misi', $profil['misi']) ?></textarea>
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
                                      placeholder="Masukkan deskripsi struktur organisasi"><?= old('deskripsi_struktur', $profil['deskripsi_struktur']) ?></textarea>
                        </div>

                        <!-- GAMBAR STRUKTUR SAAT INI -->
                        <?php if(!empty($profil['struktur'])): ?>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Gambar Struktur Saat Ini</label>
                                <br>
                                <img src="<?= base_url('uploads/struktur/'.$profil['struktur']) ?>" 
                                     alt="Struktur Organisasi" class="preview-image">
                            </div>
                        <?php endif; ?>

                        <!-- GAMBAR STRUKTUR BARU -->
                        <div class="mb-3">
                            <label for="struktur" class="form-label fw-bold">
                                <?= !empty($profil['struktur']) ? 'Ganti Gambar Struktur' : 'Gambar Struktur Organisasi' ?>
                            </label>
                            <input type="file" name="struktur" id="struktur" class="form-control"
                                   accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Format: JPG, JPEG, PNG | Maks: 2MB</small>
                            <?php if(isset($validation) && $validation->hasError('struktur')): ?>
                                <div class="text-danger"><?= $validation->getError('struktur') ?></div>
                            <?php endif; ?>
                            <?php if(!empty($profil['struktur'])): ?>
                                <small class="text-warning d-block mt-1">* Kosongkan jika tidak ingin mengganti gambar</small>
                            <?php endif; ?>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-update">
                                <i class="bi bi-save me-2"></i> Update
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