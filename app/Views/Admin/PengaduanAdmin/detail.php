<?= $this->include('admin/layout/header') ?>

<style>
.page-header {
    background: linear-gradient(135deg, #f7b500, #f9c840);
    padding: 30px 35px;
    border-radius: 20px;
    margin-bottom: 30px;
    position: relative;
    overflow: hidden;
}
.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}
.page-header h5 { color: #0a1a3a; font-weight: 700; margin-bottom: 5px; position: relative; z-index: 1; }
.page-header p { color: rgba(10,26,58,0.7); margin-bottom: 0; position: relative; z-index: 1; }

.badge-status {
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.badge-status.pending { background: #fff3cd; color: #856404; }
.badge-status.diproses { background: #cce5ff; color: #004085; }
.badge-status.selesai { background: #d4edda; color: #155724; }
.badge-status.ditolak { background: #f8d7da; color: #721c24; }

.detail-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.06);
    overflow: hidden;
}
.detail-card .card-header {
    background: #fff;
    padding: 20px 25px;
    border-bottom: 2px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}
.detail-card .card-header .title {
    display: flex;
    align-items: center;
    gap: 10px;
}
.detail-card .card-header .title h4 { font-weight: 700; color: #0a1a3a; margin: 0; }
.detail-card .card-header .title .icon {
    width: 45px;
    height: 45px;
    background: #f7b500;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0a1a3a;
    font-size: 1.3rem;
}
.detail-card .card-body { padding: 30px 25px; }

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 25px;
}
.detail-item {
    background: #f8f9fa;
    padding: 15px 20px;
    border-radius: 12px;
    transition: all 0.3s ease;
}
.detail-item:hover {
    background: #fffbf0;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(247,181,0,0.1);
}
.detail-item .label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    font-weight: 600;
    margin-bottom: 3px;
}
.detail-item .value { font-size: 1rem; color: #0a1a3a; font-weight: 500; }

.deskripsi-box {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    border-left: 4px solid #f7b500;
}
.deskripsi-box .label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}
.deskripsi-box .value { font-size: 0.95rem; line-height: 1.8; color: #333; margin: 0; }

.tindak-lanjut-container {
    background: linear-gradient(135deg, #e8f4fd, #d6eaf8);
    padding: 25px;
    border-radius: 16px;
    margin-bottom: 25px;
    border: 2px solid #b3d9f7;
    position: relative;
    overflow: hidden;
}
.tindak-lanjut-container .header-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}
.tindak-lanjut-container .header-info .icon-info {
    width: 40px;
    height: 40px;
    background: #0d6efd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.tindak-lanjut-container .header-info .title-info { flex: 1; }
.tindak-lanjut-container .header-info .title-info h6 {
    font-weight: 700;
    color: #0a1a3a;
    margin: 0;
    font-size: 1.1rem;
}
.tindak-lanjut-container .header-info .title-info small { color: #6c757d; font-size: 0.8rem; }
.tindak-lanjut-container .content-info { padding-left: 52px; }
.tindak-lanjut-container .content-info .info-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid rgba(13,110,253,0.1);
}
.tindak-lanjut-container .content-info .info-item:last-child { border-bottom: none; }
.tindak-lanjut-container .content-info .info-item .info-icon {
    color: #0d6efd;
    font-size: 1rem;
    margin-top: 2px;
    min-width: 20px;
}
.tindak-lanjut-container .content-info .info-item .info-text { flex: 1; }
.tindak-lanjut-container .content-info .info-item .info-text strong { color: #0a1a3a; font-size: 0.95rem; }
.tindak-lanjut-container .content-info .info-item .info-text p {
    margin: 4px 0 0 0;
    color: #2c3e50;
    font-size: 0.92rem;
    line-height: 1.6;
}
.tindak-lanjut-container .content-info .info-item .info-text .empty-info {
    color: #6c757d;
    font-style: italic;
    font-size: 0.9rem;
}
.tindak-lanjut-container .content-info .info-item .info-time {
    font-size: 0.7rem;
    color: #6c757d;
    white-space: nowrap;
    background: #fff;
    padding: 2px 12px;
    border-radius: 20px;
    font-weight: 600;
}

.progress-container { margin-top: 15px; padding-top: 15px; border-top: 2px dashed rgba(13,110,253,0.2); }
.progress-container .progress-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 5px;
}
.progress-container .progress {
    height: 8px;
    border-radius: 10px;
    background: #e9ecef;
    overflow: hidden;
}
.progress-container .progress .progress-bar { border-radius: 10px; transition: width 0.6s ease; }
.progress-container .progress .progress-bar.bg-pending { background: #ffc107; }
.progress-container .progress .progress-bar.bg-diproses { background: #0d6efd; }
.progress-container .progress .progress-bar.bg-selesai { background: #198754; }
.progress-container .progress .progress-bar.bg-ditolak { background: #dc3545; }

.admin-form-section {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 2px solid #e8ecf1;
}
.admin-form-section .form-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    font-weight: 600;
}
.admin-form-section .form-control {
    border-radius: 10px;
    border: 2px solid #e8ecf1;
    padding: 12px 16px;
    transition: all 0.3s ease;
    resize: vertical;
}
.admin-form-section .form-control:focus {
    border-color: #f7b500;
    box-shadow: 0 0 0 4px rgba(247,181,0,0.12);
}

.status-form {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 25px;
}
.status-form .form-select {
    border-radius: 10px;
    border: 2px solid #e8ecf1;
    padding: 8px 16px;
    font-weight: 500;
    width: 180px;
}
.status-form .form-select:focus {
    border-color: #f7b500;
    box-shadow: 0 0 0 4px rgba(247,181,0,0.12);
}

.btn-action {
    border-radius: 10px;
    padding: 8px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}
.btn-action:hover { transform: translateY(-2px); box-shadow: 0 4px 15px rgba(0,0,0,0.1); }

@media (max-width: 768px) {
    .detail-grid { grid-template-columns: 1fr; gap: 12px; }
    .page-header { padding: 20px; }
    .detail-card .card-header { flex-direction: column; align-items: flex-start; }
    .status-form { flex-direction: column; align-items: stretch; }
    .status-form .form-select { width: 100%; }
    .btn-action { width: 100%; text-align: center; }
    .detail-card .card-body { padding: 20px 15px; }
    .tindak-lanjut-container .content-info { padding-left: 0; margin-top: 10px; }
    .tindak-lanjut-container .content-info .info-item { flex-direction: column; align-items: flex-start; }
    .tindak-lanjut-container .content-info .info-item .info-time { margin-top: 5px; }
}

@media (max-width: 576px) {
    .detail-item { padding: 12px 15px; }
    .detail-item .value { font-size: 0.9rem; }
    .deskripsi-box { padding: 15px; }
    .tindak-lanjut-container { padding: 15px; }
}
</style>

<div class="d-flex min-vh-100">
    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">
        <div class="p-4 flex-grow-1">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div>
                    <h5><i class="bi bi-file-text me-2"></i>Detail Pengaduan</h5>
                    <p>Informasi lengkap dan kelola tindak lanjut pengaduan masyarakat.</p>
                </div>
                <div>
                    <?php
                    $statusMap = ['pending' => '🟡 Pending', 'diproses' => '🔵 Diproses', 'selesai' => '🟢 Selesai', 'ditolak' => '🔴 Ditolak'];
                    $status = $pengaduan['status'];
                    ?>
                    <span class="badge-status <?= $status ?>"><?= $statusMap[$status] ?? ucfirst($status) ?></span>
                </div>
            </div>

            <!-- DETAIL CARD -->
            <div class="detail-card card shadow-sm border-0 rounded-4">
                <div class="card-header">
                    <div class="title">
                        <div class="icon"><i class="bi bi-file-earmark-text"></i></div>
                        <h4><?= esc($pengaduan['judul']) ?></h4>
                    </div>
                    <div>
                        <span class="text-muted small">
                            <i class="bi bi-clock me-1"></i>
                            <?= date('d-m-Y H:i', strtotime($pengaduan['created_at'])) ?>
                        </span>
                    </div>
                </div>
                <div class="card-body">

                    <!-- DETAIL GRID -->
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="label"><i class="bi bi-person me-1"></i> Nama Pelapor</div>
                        <div class="value"><?= esc($pengaduan['nama']) ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="label"><i class="bi bi-envelope me-1"></i> Email</div>
                        <div class="value"><?= esc($pengaduan['email']) ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="label"><i class="bi bi-phone me-1"></i> Nomor Telepon</div>
                        <div class="value"><?= esc($pengaduan['nomor_telepon']) ?></div>
                    </div>
                    <div class="detail-item">
                        <div class="label"><i class="bi bi-tag me-1"></i> Kategori</div>
                        <div class="value">
                            <span class="badge" style="background-color: #0d2c6c; color: #fff;">
                                <?= esc(ucfirst(str_replace('_', ' ', $pengaduan['kategori']))) ?>
                            </span>
                        </div>
                    </div>
                </div>

                    <!-- DESKRIPSI -->
                    <div class="deskripsi-box">
                        <span class="label"><i class="bi bi-file-text me-1"></i> Uraian Pengaduan</span>
                        <p class="value"><?= nl2br(esc($pengaduan['deskripsi'])) ?></p>
                    </div>

                    <!-- INFORMASI TINDAK LANJUT -->
                    <?php
                    $progressMap = ['pending' => 25, 'diproses' => 50, 'selesai' => 100, 'ditolak' => 0];
                    $statusLabelMap = [
                        'pending' => 'Menunggu verifikasi',
                        'diproses' => 'Sedang diproses oleh Dinas PU',
                        'selesai' => 'Pengaduan telah selesai ditindaklanjuti ✅',
                        'ditolak' => 'Pengaduan ditolak ❌'
                    ];
                    $progress = $progressMap[$status] ?? 0;
                    $uraian = $pengaduan['tindak_lanjut'] ?? $pengaduan['hasil_penanganan'] ?? '';
                    ?>
                    <div class="tindak-lanjut-container">
                        <div class="header-info">
                            <div class="icon-info"><i class="bi bi-info-circle-fill"></i></div>
                            <div class="title-info">
                                <h6><i class="bi bi-arrow-right-circle me-1"></i>Informasi Tindak Lanjut Pengaduan</h6>
                                <small>Informasi ini akan ditampilkan kepada masyarakat/pengadu</small>
                            </div>
                        </div>

                        <div class="content-info">
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-graph-up-arrow"></i></div>
                                <div class="info-text">
                                    <strong>Status Progres</strong>
                                    <p><?= $statusLabelMap[$status] ?? 'Belum ada informasi' ?></p>
                                </div>
                                <div class="info-time"><?= date('d-m-Y', strtotime($pengaduan['updated_at'])) ?></div>
                            </div>

                            <div class="progress-container">
                                <div class="progress-label">
                                    <span>Progres Penanganan</span>
                                    <span><?= $progress ?>%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-<?= $status ?>" role="progressbar" style="width: <?= $progress ?>%"></div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-chat-dots"></i></div>
                                <div class="info-text">
                                    <strong>Uraian Tindak Lanjut</strong>
                                    <?php if (!empty($uraian)): ?>
                                        <p><?= nl2br(esc($uraian)) ?></p>
                                    <?php else: ?>
                                        <p class="empty-info"><i class="bi bi-info-circle me-1"></i>Belum ada uraian tindak lanjut dari Dinas PU.</p>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($uraian)): ?>
                                <div class="info-time"><?= date('d-m-Y', strtotime($pengaduan['updated_at'])) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- FORM ADMIN -->
                    <div class="admin-form-section">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-pencil-square" style="color: #083796;"></i>
                            <span class="fw-bold" style="color: #083796;">Penanganan Pengaduan</span>
                        </div>
                        
                        <form action="<?= site_url('admin/pengaduan/tindaklanjut/' . $pengaduan['id']) ?>" method="post">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" class="form-select" required>
                                    <?php
                                    $statusOptions = [
                                        'pending' => '🟡 Pending - Menunggu Verifikasi',
                                        'diproses' => '🔵 Diproses - Sedang Ditangani',
                                        'selesai' => '🟢 Selesai - Sudah Selesai',
                                        'ditolak' => '🔴 Ditolak - Tidak Dapat Diproses'
                                    ];
                                    foreach ($statusOptions as $key => $label):
                                    ?>
                                    <option value="<?= $key ?>" <?= $pengaduan['status'] == $key ? 'selected' : '' ?>>
                                        <?= $label ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Hasil Penanganan</label>
                                <textarea name="tindak_lanjut" class="form-control" rows="5"><?= esc($uraian) ?></textarea>
                            </div>

                            <button type="submit" class="btn" style="background-color: #103784; color: #fff; border: none; padding: 8px 20px; border-radius: 8px;">
                                Simpan
                            </button>
                            <a href="<?= base_url('admin/pengaduan') ?>" class="btn ms-2" style="background-color: #f7b500; color: #0a1a3a; border: none; padding: 8px 20px; border-radius: 8px; text-decoration: none;">
                                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                            </a>
                        </form>
                    </div>

                    <!-- INFO TAMBAHAN -->
                    <div class="mt-3 p-3 bg-light rounded-3 border">
                        <div class="d-flex align-items-center gap-2 text-muted small">
                            <i class="bi bi-clock-history"></i>
                            <span>Dibuat: <?= date('d-m-Y H:i', strtotime($pengaduan['created_at'])) ?></span>
                            <span class="mx-2">|</span>
                            <i class="bi bi-pencil-square"></i>
                            <span>Terakhir diupdate: <?= date('d-m-Y H:i', strtotime($pengaduan['updated_at'])) ?></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= $this->include('admin/layout/footer') ?>
    </div>
</div>