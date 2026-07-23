<?= $this->include('layout/header') ?>

<style>
/* ===== HERO SECTION ===== */
.pengaduan-hero {
    background: linear-gradient(135deg, #f7b500 0%, #f9c840 100%);
    padding: 40px 0 30px;
}

/* ===== MAIN CARD ===== */
.pengaduan-card {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.12);
}

/* ===== LEFT SIDE ===== */
.pengaduan-left {
    background: #0a1a3a;
    color: #fff;
    padding: 40px 35px;
    height: 100%;
}

.pengaduan-left h1 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.pengaduan-left .subtitle {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.7;
    font-size: 0.95rem;
}

.pengaduan-left .info-item {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.pengaduan-left .info-item .info-label {
    font-weight: 600;
    color: #f7b500;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-top: 0.8rem;
    display: block;
}

.pengaduan-left .info-item .info-label:first-of-type {
    margin-top: 0;
}

.pengaduan-left .info-item .info-value {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.3rem;
    font-size: 0.9rem;
}

/* ===== RIGHT SIDE ===== */
.pengaduan-right {
    background: #fff;
    padding: 40px 35px;
}

.pengaduan-right .form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.8rem;
    border-bottom: 2px solid #f0f0f0;
}

.pengaduan-right .form-header h3 {
    font-weight: 700;
    color: #0a1a3a;
    margin: 0;
    font-size: 1.3rem;
}

.pengaduan-right .form-group {
    margin-bottom: 1rem;
}

.pengaduan-right .form-group label {
    font-weight: 600;
    color: #0a1a3a;
    font-size: 0.85rem;
    margin-bottom: 0.3rem;
    display: block;
}

.pengaduan-right .form-group .required {
    color: #dc3545;
}

.pengaduan-right .form-control,
.pengaduan-right .form-select,
.pengaduan-right textarea {
    width: 100%;
    border: 2px solid #e8ecf1;
    border-radius: 12px;
    padding: 10px 16px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: #fafbfc;
}

.pengaduan-right .form-control:focus,
.pengaduan-right .form-select:focus,
.pengaduan-right textarea:focus {
    border-color: #f7b500;
    box-shadow: 0 0 0 4px rgba(247, 181, 0, 0.12);
    outline: none;
    background: #fff;
}

.pengaduan-right textarea {
    resize: vertical;
    min-height: 100px;
}

.pengaduan-right .form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 14px 12px;
    padding-right: 40px;
    cursor: pointer;
}

.pengaduan-right .btn-submit {
    width: 100%;
    padding: 12px 24px;
    background: #f7b500;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.95rem;
    color: #0a1a3a;
    transition: all 0.3s ease;
    margin-top: 0.3rem;
}

.pengaduan-right .btn-submit:hover {
    background: #e0a200;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(247, 181, 0, 0.3);
}

/* ===== DAFTAR PENGAduAN ===== */
.section-title {
    font-weight: 700;
    color: #0a1a3a;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    color: #6c757d;
    margin-bottom: 1.5rem;
}

/* ===== SEARCH FORM ===== */
.search-form {
    display: flex;
    gap: 10px;
    margin-bottom: 1.5rem;
}

.search-form .input-group {
    flex: 1;
}

.search-form .form-control {
    border-radius: 12px 0 0 12px;
    border: 2px solid #e8ecf1;
    padding: 10px 16px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.search-form .form-control:focus {
    border-color: #f7b500;
    box-shadow: 0 0 0 4px rgba(247, 181, 0, 0.12);
    outline: none;
}

.search-form .btn-search {
    border-radius: 0 12px 12px 0;
    background: #f7b500;
    border: 2px solid #f7b500;
    color: #0a1a3a;
    font-weight: 600;
    padding: 10px 20px;
    transition: all 0.3s ease;
}

.search-form .btn-search:hover {
    background: #e0a200;
    border-color: #e0a200;
}

.search-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding: 10px 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.search-info .result-count {
    color: #6c757d;
    font-size: 0.9rem;
}

.search-info .result-count strong {
    color: #0a1a3a;
}

/* ===== TABLE ===== */
.table-custom thead {
    background: #f7b500;
    color: #0a1a3a;
}

.table-custom thead th {
    font-weight: 700;
    padding: 12px;
    border: none;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-custom tbody td {
    padding: 12px;
    vertical-align: middle;
    font-size: 0.9rem;
    border-bottom: 1px solid #f0f0f0;
}

.table-custom tbody tr:hover {
    background: #fffbf0;
}

.badge-status {
    padding: 5px 12px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
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

.btn-primary-custom {
    background: #f7b500;
    border: none;
    padding: 8px 20px;
    border-radius: 10px;
    font-weight: 600;
    color: #0a1a3a;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    background: #e0a200;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(247, 181, 0, 0.3);
    color: #0a1a3a;
}

.btn-outline-primary-custom {
    border: 2px solid #f7b500;
    color: #0a1a3a;
    border-radius: 10px;
    padding: 8px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-outline-primary-custom:hover {
    background: #f7b500;
    color: #0a1a3a;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(247, 181, 0, 0.2);
}

.empty-state .icon-empty {
    font-size: 3.5rem;
    color: #dee2e6;
}

.empty-state h4 {
    font-weight: 600;
    color: #0a1a3a;
    margin-top: 0.8rem;
}

.empty-state p {
    color: #6c757d;
}

.avatar-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
    flex-shrink: 0;
    background: #f7b500;
    color: #0a1a3a;
}

/* ===== SUCCESS ===== */
.success-card {
    background: #fff;
    border-radius: 30px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.12);
}

.success-card .icon-success {
    font-size: 4rem;
    color: #28a745;
    margin-bottom: 1rem;
}

.success-card h2 {
    font-weight: 700;
    color: #0a1a3a;
}

.success-card p {
    color: #6c757d;
    font-size: 1rem;
}

.success-card .btn-back {
    display: inline-block;
    padding: 10px 30px;
    background: #f7b500;
    border-radius: 12px;
    font-weight: 600;
    color: #0a1a3a;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.success-card .btn-back:hover {
    background: #e0a200;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(247, 181, 0, 0.3);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .pengaduan-left {
        padding: 30px 25px;
    }
    .pengaduan-right {
        padding: 30px 25px;
    }
}

@media (max-width: 576px) {
    .pengaduan-left {
        padding: 20px;
    }
    .pengaduan-right {
        padding: 20px;
    }
    .pengaduan-left h1 {
        font-size: 1.4rem;
    }
    .table-custom thead th,
    .table-custom tbody td {
        padding: 8px 6px;
        font-size: 0.8rem;
    }
    .badge-status {
        font-size: 0.65rem;
        padding: 3px 8px;
    }
    .search-form {
        flex-direction: column;
    }
    .search-form .btn-search {
        border-radius: 12px !important;
    }
    .search-info {
        flex-direction: column;
        gap: 5px;
        text-align: center;
    }
}
</style>

<!-- ===== HERO / FORM SECTION ===== -->
<div class="pengaduan-hero">
    <div class="container">

        <?php if (session()->getFlashdata('success')): ?>
            <!-- ===== SUCCESS MESSAGE ===== -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="success-card">
                        <div class="icon-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h2>Pengaduan Berhasil Dikirim!</h2>
                        <p><?= session()->getFlashdata('success') ?></p>
                        <a href="<?= base_url('pengaduan') ?>" class="btn-back">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali ke Daftar Pengaduan
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- ===== FORM PENGAJUAN ===== -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-0 pengaduan-card">

                        <!-- SISI KIRI -->
                        <div class="col-lg-5 pengaduan-left">
                            <h1>Sampaikan Pengaduan Anda</h1>
                            <p class="subtitle">
                                Kami berkomitmen memberikan pelayanan yang cepat, 
                                tepat, dan transparan untuk masyarakat. Isi formulir 
                                berikut untuk menyampaikan keluhan maupun masukan 
                                terkait pengairan.
                            </p>

                            <div class="info-item">
                                <span class="info-label">📍 Alamat</span>
                                <p class="info-value">Jl. A.A. Gde Ngurah No. 08, Banyuwangi</p>

                                <span class="info-label">📞 Telepon</span>
                                <p class="info-value">(0333) 123456</p>

                                <span class="info-label">✉️ Email</span>
                                <p class="info-value">pengaduan@pengairan.go.id</p>
                            </div>
                        </div>

                        <!-- SISI KANAN -->
                        <div class="col-lg-7 pengaduan-right">
                            <div class="form-header">
                                <h3>Form Pengaduan</h3>
                            </div>

                            <form action="<?= base_url('pengaduan/save') ?>" method="post">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                    <label for="nama">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap Anda" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email <span class="required">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan alamat email Anda" required>
                                </div>

                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon <span class="required">*</span></label>
                                    <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" placeholder="Masukkan nomor telepon Anda" required>
                                </div>

                                <div class="form-group">
                                    <label for="judul">Judul Pengaduan <span class="required">*</span></label>
                                    <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul pengaduan Anda" required>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori Pengaduan <span class="required">*</span></label>
                                    <select id="kategori" name="kategori" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="banjir">🌊 Banjir</option>
                                        <option value="bendungan_rusak">🏗️ Bendungan Rusak</option>
                                        <option value="saluran_tersumbat">🚧 Saluran Tersumbat</option>
                                        <option value="lainnya">📌 Lainnya</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Uraian Pengaduan <span class="required">*</span></label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Jelaskan secara detail pengaduan Anda..." required></textarea>
                                </div>

                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-send me-2"></i>
                                    Kirim Pengaduan
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- ===== DAFTAR PENGAduAN ===== -->
<div class="container py-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h4 class="section-title">
                <i class="bi bi-list-check me-2"></i>
                Daftar Pengaduan
            </h4>
            <p class="section-subtitle">
                Daftar 5 pengaduan terbaru yang telah masuk.
                <?php if (!empty($pengaduan)): ?>
                    <span class="badge bg-warning text-dark ms-2">
                        <i class="bi bi-database me-1"></i>
                        <?= count($pengaduan) ?> data
                    </span>
                <?php endif; ?>
            </p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="<?= base_url('pengaduan') ?>" class="btn btn-primary-custom">
                <i class="bi bi-arrow-repeat me-2"></i>
                Refresh
            </a>
        </div>
    </div>

    <!-- ===== FORM PENCARIAN ===== -->
    <div class="search-form">
        <div class="input-group">
            <input type="text" 
                   class="form-control" 
                   id="searchInput" 
                   placeholder="Cari berdasarkan nama, judul, kategori, atau status..." 
                   value="<?= isset($keyword) ? esc($keyword) : '' ?>">
            <button class="btn btn-search" id="btnSearch">
                <i class="bi bi-search me-1"></i> Cari
            </button>
        </div>
    </div>

    <?php if (isset($keyword) && !empty($keyword)): ?>
        <!-- ===== INFO PENCARIAN ===== -->
        <div class="search-info">
            <span class="result-count">
                <i class="bi bi-search me-1"></i>
                Menampilkan hasil pencarian untuk: <strong>"<?= esc($keyword) ?>"</strong>
            </span>
            <span class="result-count">
                Ditemukan: <strong><?= count($pengaduan) ?></strong> data
                <?php if (count($pengaduan) >= 5): ?>
                    <span class="text-muted ms-1">(menampilkan 5 terbaru)</span>
                <?php endif; ?>
            </span>
        </div>
    <?php else: ?>
        <!-- ===== INFO TAMBAHAN ===== -->
        <div class="search-info">
            <span class="result-count">
                <i class="bi bi-info-circle me-1"></i>
                Menampilkan <strong>5</strong> pengaduan terbaru
            </span>
            <span class="result-count">
                Total data: <strong><?= $total ?? 0 ?></strong>
            </span>
        </div>
    <?php endif; ?>

    <?php if (empty($pengaduan)): ?>
        <!-- ===== EMPTY STATE ===== -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body text-center py-5 empty-state">
                <div class="icon-empty">
                    <i class="bi bi-inbox"></i>
                </div>
                <h4>
                    <?= isset($keyword) && !empty($keyword) ? 'Pengaduan Tidak Ditemukan' : 'Belum Ada Pengaduan' ?>
                </h4>
                <p>
                    <?= isset($keyword) && !empty($keyword) 
                        ? 'Tidak ada pengaduan yang sesuai dengan kata kunci "' . esc($keyword) . '".' 
                        : 'Silakan buat pengaduan pertama Anda menggunakan form di atas.' ?>
                </p>
                <?php if (isset($keyword) && !empty($keyword)): ?>
                    <a href="<?= base_url('pengaduan') ?>" class="btn btn-primary-custom">
                        <i class="bi bi-arrow-left me-2"></i>
                        Lihat Semua Pengaduan
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <!-- ===== TABLE ===== -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pengaduan as $item): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">
                                                <?= strtoupper(substr($item['nama'], 0, 1)) ?>
                                            </div>
                                            <?= esc($item['nama']) ?>
                                        </div>
                                    </td>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= esc(ucfirst(str_replace('_', ' ', $item['kategori']))) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $status_class = '';
                                        $status_text = '';
                                        switch ($item['status']) {
                                            case 'pending':
                                                $status_class = 'pending';
                                                $status_text = 'Pending';
                                                break;
                                            case 'diproses':
                                                $status_class = 'diproses';
                                                $status_text = 'Diproses';
                                                break;
                                            case 'selesai':
                                                $status_class = 'selesai';
                                                $status_text = 'Selesai';
                                                break;
                                            case 'ditolak':
                                                $status_class = 'ditolak';
                                                $status_text = 'Ditolak';
                                                break;
                                            default:
                                                $status_class = 'pending';
                                                $status_text = ucfirst($item['status']);
                                        }
                                        ?>
                                        <span class="badge-status <?= $status_class ?>">
                                            <?= $status_text ?>
                                        </span>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- ===== LINK LIHAT SEMUA ===== -->
        <div class="text-center mt-4">
            <a href="<?= base_url('pengaduan/track') ?>" class="btn-outline-primary-custom">
                <i class="bi bi-search me-2"></i>
                Lihat Semua Pengaduan
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
// ===== SEARCH WITH ENTER KEY =====
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

// ===== SEARCH BUTTON =====
document.getElementById('btnSearch').addEventListener('click', function() {
    performSearch();
});

function performSearch() {
    const keyword = document.getElementById('searchInput').value.trim();
    if (keyword) {
        window.location.href = '<?= base_url('pengaduan') ?>?keyword=' + encodeURIComponent(keyword);
    } else {
        window.location.href = '<?= base_url('pengaduan') ?>';
    }
}
</script>

<?= $this->include('layout/footer') ?>