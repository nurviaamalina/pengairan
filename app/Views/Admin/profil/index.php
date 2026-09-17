<?= $this->include('Admin/layout/header') ?>

<style>
/* ===== PAGE HEADER ===== */
.page-header,
.user-page-header {
    background: linear-gradient(135deg, #0a2558 0%, #163773 100%);
    padding: 25px 30px;
    border-radius: 20px;
    margin-bottom: 25px;
    position: relative;
    overflow: hidden;
    color: #ffffff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.page-header::before,
.user-page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 250px;
    height: 250px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
}

.page-header h3,
.user-page-header h3 {
    color: #ffffff;
    font-weight: 700;
    margin-bottom: 5px;
    position: relative;
    z-index: 1;
}

.page-header h3 i,
.user-page-header h3 i {
    color: #ffffff;
}

.page-header p,
.user-page-header p {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

.btn-tambah {
    background: #ffffff;
    color: #0a2558;
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    position: relative;
    z-index: 1;
}

.btn-tambah:hover {
    background: #f0f4f9;
    color: #0a2558;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

/* ===== CARD STYLES ===== */
.card-custom {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: all 0.3s ease;
    background: #fff;
    clear: both; /* Mencegah bentrokan dengan float/grid */
}

.card-custom:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}

.card-custom .card-header {
    padding: 16px 22px;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-bottom: 3px solid #0a2558;
}

.card-custom .card-header h5 {
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.05rem;
    color: #0a2558;
}

.card-custom .card-header h5 i {
    color: #0a2558;
}

.card-custom .card-header .btn-edit {
    border-radius: 8px;
    padding: 6px 16px;
    font-weight: 600;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    border: none;
    background: #0a2558;
    color: #ffffff;
    text-decoration: none;
}

.card-custom .card-header .btn-edit:hover {
    background: #163773;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(10, 37, 88, 0.25);
}

.card-custom .card-body {
    padding: 22px 25px;
    line-height: 1.8;
    font-size: 0.95rem;
    color: #333;
}

/* ===== CARD VARIATION ===== */
.card-sejarah .card-header {
    background: #fff;
    border-bottom: 3px solid #0a2558;
}

.card-visi .card-header {
    background: #0a2558;
    border-bottom: 3px solid #163773;
    border-radius: 16px 16px 0 0;
}

.card-visi .card-header h5 {
    color: #fff;
}

.card-visi .card-header h5 i {
    color: #ffffff;
}

.card-visi .card-header .btn-edit {
    background: #ffffff;
    color: #0a2558;
}

.card-visi .card-header .btn-edit:hover {
    background: #f0f4f9;
    color: #0a2558;
}

.card-misi .card-header {
    background: #f4f7fc;
    border-bottom: 3px solid #0a2558;
    border-radius: 16px 16px 0 0;
}

.card-misi .card-header h5 {
    color: #0a2558;
}

.card-misi .card-header h5 i {
    color: #0a2558;
}

.card-misi .card-header .btn-edit {
    background: #0a2558;
    color: #fff;
}

.card-misi .card-header .btn-edit:hover {
    background: #163773;
}

.card-struktur {
    margin-top: 25px;
}

.card-struktur .card-header {
    background: #fff;
    border-bottom: 3px solid #0a2558;
}

.card-struktur .card-header h5 {
    color: #0a2558;
}

.card-struktur .card-header h5 i {
    color: #0a2558;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    text-align: center;
    padding: 15px 0;
    color: #6c757d;
}

.empty-state i {
    font-size: 2rem;
    color: #0a2558;
    margin-bottom: 8px;
    display: block;
}

.empty-state p {
    margin: 0;
    font-style: italic;
    color: #6c757d;
}

/* ===== STRUKTUR ===== */
.struktur-description {
    margin-bottom: 20px;
    padding: 15px 20px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #0a2558;
}

.struktur-description p {
    margin: 0;
    color: #333;
    line-height: 1.8;
}

.struktur-image {
    max-height: 500px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    width: 100%;
    object-fit: contain;
}

.struktur-empty {
    padding: 40px 20px;
    text-align: center;
}

.struktur-empty i {
    font-size: 3.5rem;
    color: #0a2558;
    margin-bottom: 12px;
    display: block;
}

.struktur-empty h5 {
    color: #0a2558;
    font-weight: 600;
}

.struktur-empty p {
    color: #adb5bd;
    font-size: 0.9rem;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .card-custom .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

@media (max-width: 576px) {
    .page-header,
    .user-page-header {
        padding: 18px;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    .page-header h3,
    .user-page-header h3 {
        font-size: 1.2rem;
    }
    .card-custom .card-body {
        padding: 16px 18px;
    }
}
</style>

<!-- ===== MAIN WRAPPER ===== -->
<div class="d-flex min-vh-100">
    <?= $this->include('Admin/layout/sidebar') ?>

    <main class="content-wrapper flex-grow-1">
        <div class="p-4 flex-grow-1">

            <!-- ===== PAGE HEADER ===== -->
            <div class="user-page-header">
                <div>
                    <h3>
                        <i class="bi bi-building me-2"></i>
                        Profil Dinas Pengairan
                    </h3>
                    <p>
                        Kelola informasi Profil Dinas Pengairan Kabupaten Banyuwangi
                    </p>
                </div>

                <div>
                    <a href="<?= base_url('admin/profil/create') ?>" class="btn btn-tambah">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tambah Profil
                    </a>
                </div>
            </div>

            <!-- ===== FLASH MESSAGE ===== -->
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- ===================================================== -->
            <!-- TABEL DATA PROFIL -->
            <!-- ===================================================== -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead style="background-color: #f0f4f9; color: #0a2558;">
                                <tr class="text-center">
                                    <th width="60">No</th>
                                    <th>Sejarah</th>
                                    <th>Visi</th>
                                    <th>Misi</th>
                                    <th>Struktur</th>
                                    <th width="170">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($profil)) : ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data Profil Dinas Pengairan
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; ?>
                                <?php foreach($profil as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td><?= word_limiter(strip_tags($row['sejarah']), 10) ?></td>
                                        <td><?= word_limiter(strip_tags($row['visi']), 10) ?></td>
                                        <td><?= word_limiter(strip_tags($row['misi']), 10) ?></td>
                                        <td class="text-center">
                                            <?php if(!empty($row['struktur'])) : ?>
                                                <img src="<?= base_url('uploads/struktur/'.$row['struktur']) ?>"
                                                     class="img-thumbnail" width="120">
                                            <?php else : ?>
                                                <span class="text-muted">Belum ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('admin/profil/edit/'.$row['id']) ?>"
                                               class="btn btn-sm text-white" style="background-color: #0a2558;">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/profil/delete/'.$row['id']) ?>"
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Yakin ingin menghapus data?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================================================== -->
            <!-- TAMPILAN DETAIL PROFIL (Jika ada data) -->
            <!-- ===================================================== -->
            <?php if(!empty($detail_profil)): ?>
            
                <!-- 1. SEJARAH -->
                <div class="card card-custom card-sejarah mb-4" id="sejarah">
                    <div class="card-header">
                        <h5>
                            <i class="bi bi-clock-history"></i>
                            Sejarah Dinas
                        </h5>
                        <a href="<?= base_url('admin/profil/edit/'.$detail_profil['id']) ?>" class="btn btn-edit">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($detail_profil['sejarah'])): ?>
                            <?= $detail_profil['sejarah'] ?>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="bi bi-file-text"></i>
                                <p>Belum ada data sejarah.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 2. VISI & MISI (Dibungkus rapi dalam 1 Baris Row) -->
                <div class="row g-4 mb-4" id="visimisi">
                    <!-- VISI -->
                    <div class="col-lg-5">
                        <div class="card card-custom card-visi h-100">
                            <div class="card-header">
                                <h5>
                                    <i class="bi bi-eye"></i>
                                    VISI
                                </h5>
                                <a href="<?= base_url('admin/profil/edit/'.$detail_profil['id']) ?>" class="btn btn-edit">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <?php if(!empty($detail_profil['visi'])): ?>
                                    <?= $detail_profil['visi'] ?>
                                <?php else: ?>
                                    <div class="empty-state">
                                        <i class="bi bi-eye"></i>
                                        <p>Belum ada data visi.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- MISI -->
                    <div class="col-lg-7">
                        <div class="card card-custom card-misi h-100">
                            <div class="card-header">
                                <h5>
                                    <i class="bi bi-bullseye"></i>
                                    MISI
                                </h5>
                                <a href="<?= base_url('admin/profil/edit/'.$detail_profil['id']) ?>" class="btn btn-edit">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </a>
                            </div>
                            <div class="card-body">
                                <?php if(!empty($detail_profil['misi'])): ?>
                                    <?= $detail_profil['misi'] ?>
                                <?php else: ?>
                                    <div class="empty-state">
                                        <i class="bi bi-bullseye"></i>
                                        <p>Belum ada data misi.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- END ROW VISI MISI -->

                <!-- 3. STRUKTUR ORGANISASI (Berada terpisah penuh di bawah Visi & Misi) -->
                <div class="card card-custom card-struktur" id="struktur">
                    <div class="card-header">
                        <h5>
                            <i class="bi bi-diagram-3"></i>
                            Struktur Organisasi
                        </h5>
                        <a href="<?= base_url('admin/profil/edit/'.$detail_profil['id']) ?>" class="btn btn-edit">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                    <div class="card-body">
                        
                        <!-- DESKRIPSI STRUKTUR -->
                        <?php if(!empty($detail_profil['deskripsi_struktur'])): ?>
                            <div class="struktur-description">
                                <?= $detail_profil['deskripsi_struktur'] ?>
                            </div>
                        <?php else: ?>
                            <div class="struktur-description">
                                <div class="empty-state">
                                    <i class="bi bi-file-text"></i>
                                    <p>Belum ada deskripsi struktur organisasi.</p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- GAMBAR STRUKTUR -->
                        <div class="text-center mt-3">
                            <?php if(!empty($detail_profil['struktur'])): ?>
                                <img src="<?= base_url('uploads/struktur/'.rawurlencode($detail_profil['struktur'])) ?>" 
                                     alt="Struktur Organisasi" 
                                     class="struktur-image">
                            <?php else: ?>
                                <div class="struktur-empty">
                                    <i class="bi bi-image"></i>
                                    <h5>Belum ada gambar struktur organisasi</h5>
                                    <p class="text-muted">Upload gambar struktur organisasi melalui tombol "Edit"</p>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

            <?php endif; ?>

        </div>
    </main>
</div>

<?= $this->include('Admin/layout/footer') ?>