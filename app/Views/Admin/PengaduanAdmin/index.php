<?= $this->include('admin/layout/header') ?>

<style>
.page-header {
    background: linear-gradient(135deg, #f7b500, #f9c840);
    padding: 20px 25px;
    border-radius: 15px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
}

.page-header h5 {
    color: #0a1a3a;
    font-weight: 700;
    margin: 0;
}

.page-header small {
    color: rgba(10, 26, 58, 0.7);
}

.badge-total {
    background: rgba(10, 26, 58, 0.15);
    padding: 6px 16px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    color: #0a1a3a;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}

.stat-card {
    background: #fff;
    padding: 15px 18px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    text-align: center;
}

.stat-card .number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0a1a3a;
}

.stat-card .label {
    font-size: 0.75rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.search-box input {
    flex: 1;
    min-width: 200px;
    padding: 10px 16px;
    border: 2px solid #e8ecf1;
    border-radius: 10px;
    font-size: 0.9rem;
}

.search-box input:focus {
    border-color: #f7b500;
    outline: none;
}

.search-box .btn-search {
    padding: 10px 24px;
    background: #f7b500;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    color: #0a1a3a;
    cursor: pointer;
}

.search-box .btn-reset {
    padding: 10px 20px;
    background: #6c757d;
    border: none;
    border-radius: 10px;
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.table-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.06);
    overflow: hidden;
}

.table-card .card-body {
    padding: 0;
    overflow-x: auto;
}

.table-custom {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.table-custom thead {
    background: #f7b500;
}

.table-custom thead th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 700;
    color: #0a1a3a;
    font-size: 0.8rem;
    text-transform: uppercase;
}

.table-custom tbody td {
    padding: 12px 16px;
    border-bottom: 1px solid #f0f0f0;
}

.table-custom tbody tr:hover {
    background: #fffbf0;
}

.badge-status {
    padding: 4px 12px;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
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

/* ===== ACTION BUTTONS ===== */
.action-group {
    display: flex;
    gap: 5px;
    flex-wrap: nowrap;
    white-space: nowrap;
}

.btn-action {
    padding: 5px 12px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-view {
    background: #f7b500;
    color: #0a1a3a;
}

.btn-view:hover {
    background: #e0a200;
    color: #0a1a3a;
}

.btn-delete {
    background: #dc3545;
    color: #fff;
}

.btn-delete:hover {
    background: #c82333;
    color: #fff;
}

.empty-state {
    text-align: center;
    padding: 50px 20px;
}

.empty-state .icon {
    font-size: 3rem;
    color: #dee2e6;
}

.empty-state h4 {
    color: #0a1a3a;
    margin: 10px 0 5px;
}

.empty-state p {
    color: #6c757d;
}

.avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #f7b500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
    color: #0a1a3a;
    margin-right: 8px;
}

.info-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 16px;
    background: #f8f9fa;
    border-radius: 10px;
    margin-bottom: 15px;
    font-size: 0.9rem;
    color: #6c757d;
    flex-wrap: wrap;
    gap: 8px;
}

.info-bar strong {
    color: #0a1a3a;
}

@media (max-width: 768px) {
    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }
    .search-box input {
        min-width: 100%;
    }
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    .info-bar {
        flex-direction: column;
        text-align: center;
    }
    .table-custom thead th,
    .table-custom tbody td {
        padding: 8px 10px;
        font-size: 0.8rem;
    }
    .btn-action {
        padding: 4px 8px;
        font-size: 0.7rem;
    }
    .action-group {
        gap: 3px;
    }
}
</style>

<div class="d-flex min-vh-100">
    <?= $this->include('admin/layout/sidebar') ?>

    <div class="content flex-grow-1 d-flex flex-column bg-light">
        <div class="p-4 flex-grow-1">

            <!-- HEADER -->
            <div class="page-header">
                <div>
                    <h5>📋 Daftar Pengaduan</h5>
                    <small>Menampilkan 10 pengaduan terbaru</small>
                </div>
                <span class="badge-total">Total: <?= $total_all ?? count($pengaduan) ?> Data</span>
            </div>

            <!-- STATISTIK -->
            <?php
            $pending = $diproses = $selesai = $ditolak = 0;
            foreach ($pengaduan as $p) {
                if ($p['status'] == 'pending') $pending++;
                elseif ($p['status'] == 'diproses') $diproses++;
                elseif ($p['status'] == 'selesai') $selesai++;
                elseif ($p['status'] == 'ditolak') $ditolak++;
            }
            ?>
            <div class="stats-row">
                <div class="stat-card"><div class="number"><?= count($pengaduan) ?></div><div class="label">📊 Ditampilkan</div></div>
                <div class="stat-card"><div class="number"><?= $pending ?></div><div class="label">🟡 Pending</div></div>
                <div class="stat-card"><div class="number"><?= $diproses ?></div><div class="label">🔵 Diproses</div></div>
                <div class="stat-card"><div class="number"><?= $selesai ?></div><div class="label">🟢 Selesai</div></div>
            </div>

            <!-- FLASH MESSAGE -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- SEARCH -->
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Cari nama, judul, atau kategori..." value="<?= isset($keyword) ? esc($keyword) : '' ?>">
                <button class="btn-search" onclick="search()">🔍 Cari</button>
                <a href="<?= base_url('admin/pengaduan') ?>" class="btn-reset">↺ Reset</a>
            </div>

            <!-- INFO BAR -->
            <div class="info-bar">
                <span>
                    <i class="bi bi-info-circle me-1"></i>
                    Menampilkan <strong><?= count($pengaduan) ?></strong> dari <strong><?= $total_all ?? count($pengaduan) ?></strong> total pengaduan
                    <?php if (isset($keyword) && !empty($keyword)): ?>
                        <span class="text-muted">— Hasil pencarian: "<strong><?= esc($keyword) ?></strong>"</span>
                    <?php endif; ?>
                </span>
                <span class="text-muted">
                    <i class="bi bi-clock me-1"></i>
                    Diurutkan dari terbaru
                </span>
            </div>

            <!-- TABLE -->
            <div class="table-card">
                <div class="card-body">
                    <?php if (empty($pengaduan)): ?>
                        <div class="empty-state">
                            <div class="icon">📭</div>
                            <h4><?= isset($keyword) && !empty($keyword) ? 'Pengaduan Tidak Ditemukan' : 'Belum Ada Pengaduan' ?></h4>
                            <p><?= isset($keyword) && !empty($keyword) ? 'Tidak ada hasil untuk kata kunci tersebut.' : 'Belum ada pengaduan yang masuk ke sistem.' ?></p>
                            <?php if (isset($keyword) && !empty($keyword)): ?>
                                <a href="<?= base_url('admin/pengaduan') ?>" class="btn-reset" style="display:inline-block;margin-top:10px;">↺ Lihat Semua</a>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th width="40">#</th>
                                    <th>Pelapor</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th width="130">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($pengaduan as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <span class="avatar"><?= strtoupper(substr($p['nama'], 0, 1)) ?></span>
                                        <?= esc($p['nama']) ?>
                                    </td>
                                    <td><?= esc($p['judul']) ?></td>
                                    <td><span class="badge bg-secondary"><?= esc(ucfirst(str_replace('_', ' ', $p['kategori']))) ?></span></td>
                                    <td>
                                        <span class="badge-status <?= $p['status'] ?>">
                                            <?= ucfirst($p['status']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($p['created_at'])) ?></td>
                                    <td>
                                        <div class="action-group">
                                            <a href="<?= base_url('admin/pengaduan/detail/'.$p['id']) ?>" 
                                               class="btn-action btn-view" 
                                               title="Lihat Detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                            <a href="<?= base_url('admin/pengaduan/delete/'.$p['id']) ?>" 
                                               class="btn-action btn-delete" 
                                               onclick="return confirm('Yakin ingin menghapus pengaduan ini?')"
                                               title="Hapus Pengaduan">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <?= $this->include('admin/layout/footer') ?>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') search();
});

function search() {
    const keyword = document.getElementById('searchInput').value.trim();
    if (keyword) {
        window.location.href = '<?= base_url('admin/pengaduan') ?>?keyword=' + encodeURIComponent(keyword);
    } else {
        window.location.href = '<?= base_url('admin/pengaduan') ?>';
    }
}
</script>