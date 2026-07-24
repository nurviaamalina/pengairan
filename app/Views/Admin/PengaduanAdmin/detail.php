<?= $this->include('admin/layout/header') ?>

<style>
/* ===== PAGE HEADER ===== */
.page-header {
    background: linear-gradient(135deg, #f7b500 0%, #f9c840 100%);
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
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
}

.page-header h5 {
    color: #0a1a3a;
    font-weight: 700;
    margin-bottom: 5px;
    position: relative;
    z-index: 1;
}

.page-header p {
    color: rgba(10, 26, 58, 0.7);
    margin-bottom: 0;
    position: relative;
    z-index: 1;
}

/* ===== STATUS BADGE ===== */
.badge-status {
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-status.pending {
    background: #fff3cd;
    color: #856404;
}

.badge-status.diproses {
    background: #cce5ff;
    color: #004085;
}

.badge-status.selesai {
    background: #d4edda;
    color: #155724;
}

.badge-status.ditolak {
    background: #f8d7da;
    color: #721c24;
}

/* ===== CARD ===== */
.detail-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
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

.detail-card .card-header .title h4 {
    font-weight: 700;
    color: #0a1a3a;
    margin: 0;
}

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

.detail-card .card-body {
    padding: 30px 25px;
}

/* ===== DETAIL GRID ===== */
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
    box-shadow: 0 4px 15px rgba(247, 181, 0, 0.1);
}

.detail-item .label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    font-weight: 600;
    margin-bottom: 3px;
}

.detail-item .value {
    font-size: 1rem;
    color: #0a1a3a;
    font-weight: 500;
}

.detail-item .value .text-muted {
    font-weight: 400;
}

/* ===== DESKRIPSI ===== */
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

.deskripsi-box .value {
    font-size: 0.95rem;
    line-height: 1.8;
    color: #333;
    margin: 0;
}

/* ===== STATUS FORM ===== */
.status-form {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
}

.status-form .label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    font-weight: 600;
}

.status-form .form-select {
    border-radius: 10px;
    border: 2px solid #e8ecf1;
    padding: 8px 16px;
    font-weight: 500;
    width: 180px;
    transition: all 0.3s ease;
}

.status-form .form-select:focus {
    border-color: #f7b500;
    box-shadow: 0 0 0 4px rgba(247, 181, 0, 0.12);
}

.btn-status {
    border-radius: 10px;
    padding: 8px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-status:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-back {
    border-radius: 10px;
    padding: 8px 24px;
    font-weight: 600;
    background: #6c757d;
    border: none;
    color: #fff;
    transition: all 0.3s ease;
}

.btn-back:hover {
    background: #5a6268;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
    color: #fff;
}

/* ===== TIMELINE ===== */
.timeline-section {
    margin-top: 25px;
    padding-top: 25px;
    border-top: 2px solid #f0f0f0;
}

.timeline-section .timeline-title {
    font-size: 0.85rem;
    font-weight: 700;
    color: #0a1a3a;
    margin-bottom: 15px;
}

.timeline-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 1px solid #f0f0f0;
}

.timeline-item:last-child {
    border-bottom: none;
}

.timeline-item .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.timeline-item .dot.pending {
    background: #ffc107;
}
.timeline-item .dot.diproses {
    background: #0d6efd;
}
.timeline-item .dot.selesai {
    background: #198754;
}
.timeline-item .dot.ditolak {
    background: #dc3545;
}

.timeline-item .content {
    flex: 1;
}

.timeline-item .content .text {
    font-size: 0.9rem;
    color: #333;
}

.timeline-item .content .time {
    font-size: 0.75rem;
    color: #6c757d;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .detail-grid {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .page-header {
        padding: 20px;
    }

    .detail-card .card-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .status-form {
        flex-direction: column;
        align-items: stretch;
    }

    .status-form .form-select {
        width: 100%;
    }

    .btn-status,
    .btn-back {
        width: 100%;
        text-align: center;
    }

    .detail-card .card-body {
        padding: 20px 15px;
    }
}

@media (max-width: 576px) {
    .detail-item {
        padding: 12px 15px;
    }

    .detail-item .value {
        font-size: 0.9rem;
    }

    .deskripsi-box {
        padding: 15px;
    }
}
</style>

<!-- ===== CONTENT WRAPPER ===== -->
<div class="d-flex min-vh-100">

    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">

        <div class="p-4 flex-grow-1">

            <!-- ===== PAGE HEADER ===== -->
            <div class="page-header">
                <div>
                    <h5>
                        <i class="bi bi-file-text me-2"></i>
                        Detail Pengaduan
                    </h5>
                    <p>Informasi lengkap dan kelola status pengaduan masyarakat.</p>
                </div>
                <div>
                    <span class="badge-status <?= $pengaduan['status'] ?>">
                        <?php
                        $status_text = '';
                        switch ($pengaduan['status']) {
                            case 'pending':
                                $status_text = '🟡 Pending';
                                break;
                            case 'diproses':
                                $status_text = '🔵 Diproses';
                                break;
                            case 'selesai':
                                $status_text = '🟢 Selesai';
                                break;
                            case 'ditolak':
                                $status_text = '🔴 Ditolak';
                                break;
                            default:
                                $status_text = ucfirst($pengaduan['status']);
                        }
                        echo $status_text;
                        ?>
                    </span>
                </div>
            </div>

            <!-- ===== CARD DETAIL ===== -->
            <div class="detail-card card shadow-sm border-0 rounded-4">
                <div class="card-header">
                    <div class="title">
                        <div class="icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
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

                    <!-- ===== GRID DETAIL ===== -->
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="label">
                                <i class="bi bi-person me-1"></i> Nama Pelapor
                            </div>
                            <div class="value"><?= esc($pengaduan['nama']) ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="label">
                                <i class="bi bi-envelope me-1"></i> Email
                            </div>
                            <div class="value"><?= esc($pengaduan['email']) ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="label">
                                <i class="bi bi-phone me-1"></i> Nomor Telepon
                            </div>
                            <div class="value"><?= esc($pengaduan['nomor_telepon']) ?></div>
                        </div>

                        <div class="detail-item">
                            <div class="label">
                                <i class="bi bi-tag me-1"></i> Kategori
                            </div>
                            <div class="value">
                                <span class="badge bg-secondary">
                                    <?= esc(ucfirst(str_replace('_', ' ', $pengaduan['kategori']))) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- ===== DESKRIPSI ===== -->
                    <div class="deskripsi-box">
                        <span class="label">
                            <i class="bi bi-file-text me-1"></i> Uraian Pengaduan
                        </span>
                        <p class="value"><?= nl2br(esc($pengaduan['deskripsi'])) ?></p>
                    </div>

                    <!-- ===== STATUS FORM ===== -->
                    <form action="<?= base_url('admin/pengaduan/update/' . $pengaduan['id']) ?>" method="post" class="status-form">
                        <span class="label">
                            <i class="bi bi-arrow-repeat me-1"></i> Ubah Status
                        </span>
                        <select name="status" class="form-select" required>
                            <option value="pending" <?= $pengaduan['status'] == 'pending' ? 'selected' : '' ?>>🟡 Pending</option>
                            <option value="diproses" <?= $pengaduan['status'] == 'diproses' ? 'selected' : '' ?>>🔵 Diproses</option>
                            <option value="selesai" <?= $pengaduan['status'] == 'selesai' ? 'selected' : '' ?>>🟢 Selesai</option>
                            <option value="ditolak" <?= $pengaduan['status'] == 'ditolak' ? 'selected' : '' ?>>🔴 Ditolak</option>
                        </select>
                        <button class="btn btn-success btn-status" type="submit">
                            <i class="bi bi-check2-circle me-1"></i> Simpan
                        </button>
                        <a href="<?= base_url('admin/pengaduan') ?>" class="btn-back">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </form>

                    <!-- ===== TIMELINE ===== -->
                    <div class="timeline-section">
                        <div class="timeline-title">
                            <i class="bi bi-clock-history me-2"></i>
                            Riwayat Status
                        </div>

                        <!-- Status saat ini -->
                        <div class="timeline-item">
                            <div class="dot <?= $pengaduan['status'] ?>"></div>
                            <div class="content">
                                <div class="text">
                                    <strong>
                                        <?php
                                        $status_label = '';
                                        switch ($pengaduan['status']) {
                                            case 'pending': $status_label = 'Pengaduan Baru'; break;
                                            case 'diproses': $status_label = 'Sedang Diproses'; break;
                                            case 'selesai': $status_label = 'Pengaduan Selesai'; break;
                                            case 'ditolak': $status_label = 'Pengaduan Ditolak'; break;
                                            default: $status_label = ucfirst($pengaduan['status']);
                                        }
                                        echo $status_label;
                                        ?>
                                    </strong>
                                    <span class="text-muted ms-2">
                                        <?= date('d-m-Y H:i', strtotime($pengaduan['created_at'])) ?>
                                    </span>
                                </div>
                                <div class="time">Status saat ini</div>
                            </div>
                        </div>

                        <?php if ($pengaduan['status'] != 'pending' && !empty($pengaduan['updated_at'])): ?>
                        <!-- Status sebelumnya -->
                        <div class="timeline-item">
                            <div class="dot pending"></div>
                            <div class="content">
                                <div class="text">
                                    <strong>Pengaduan Baru</strong>
                                    <span class="text-muted ms-2">
                                        <?= date('d-m-Y H:i', strtotime($pengaduan['created_at'])) ?>
                                    </span>
                                </div>
                                <div class="time">Pengaduan dibuat</div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>

        <?= $this->include('admin/layout/footer') ?>

    </div>

</div>