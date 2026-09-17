<?= $this->include('Admin/layout/header') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/profil-admin.css') ?>">

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
                <div class="card card-custom card-sejarah mb-2" id="sejarah">
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

                <!-- 2. VISI & MISI -->
                <div class="row g-4 profil-visimisi" id="visimisi">
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

                <div class="profil-section-gap" aria-hidden="true"></div>

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