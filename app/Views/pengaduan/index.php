<?= $this->include('layout/header') ?>

<style>
.pengaduan-hero {
    background: linear-gradient(135deg, #f7b500, #f9c840);
    padding: 40px 0 30px;
}
.pengaduan-card {
    background: #fff;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.12);
    display: flex;
    min-height: 500px;
}
.pengaduan-card > [class*="col-"] { display: flex; flex-direction: column; }

.pengaduan-left {
    background: #0a1a3a;
    color: #fff;
    padding: 40px 35px;
    flex: 1;
}
.pengaduan-left h1 { font-size: 1.8rem; font-weight: 700; margin-bottom: 1rem; }
.pengaduan-left .subtitle { color: rgba(255,255,255,0.8); line-height: 1.7; font-size: 0.95rem; }
.pengaduan-left .info-item { margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); }
.pengaduan-left .info-item .info-label {
    font-weight: 600;
    color: #f7b500;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: block;
    margin-top: 0.8rem;
}
.pengaduan-left .info-item .info-label:first-of-type { margin-top: 0; }
.pengaduan-left .info-item .info-value { color: rgba(255,255,255,0.9); font-size: 0.9rem; }

.pengaduan-right {
    background: #fff;
    padding: 40px 35px;
    flex: 1;
}
.pengaduan-right .form-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 0.8rem;
    border-bottom: 2px solid #f0f0f0;
}
.pengaduan-right .form-header h3 { font-weight: 700; color: #0a1a3a; margin: 0; font-size: 1.3rem; }
.pengaduan-right .form-group { margin-bottom: 1rem; }
.pengaduan-right .form-group label { font-weight: 600; color: #0a1a3a; font-size: 0.85rem; margin-bottom: 0.3rem; display: block; }
.pengaduan-right .form-group .required { color: #dc3545; }
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
    box-shadow: 0 0 0 4px rgba(247,181,0,0.12);
    outline: none;
    background: #fff;
}
.pengaduan-right textarea { resize: vertical; min-height: 100px; }
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
    box-shadow: 0 8px 30px rgba(247,181,0,0.3);
}

.btn-track {
    background: linear-gradient(135deg, #f7b500, #e0a200);
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    color: #0a1a3a;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(247,181,0,0.4);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    letter-spacing: 0.5px;
}
.btn-track:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 8px 30px rgba(247,181,0,0.6);
    color: #0a1a3a;
    background: linear-gradient(135deg, #ffcf5a, #f7b500);
}
.btn-track i { font-size: 1.2rem; }

.section-title { font-weight: 700; color: #0a1a3a; margin-bottom: 0.5rem; }
.section-subtitle { color: #6c757d; margin-bottom: 1.5rem; }

.table-custom thead { background: #f7b500; color: #0a1a3a; }
.table-custom thead th {
    font-weight: 700;
    padding: 12px;
    border: none;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.table-custom tbody td { padding: 12px; vertical-align: middle; font-size: 0.9rem; border-bottom: 1px solid #f0f0f0; }
.table-custom tbody tr:hover { background: #fffbf0; }

.badge-status {
    padding: 5px 12px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.badge-status.pending { background: #fff3cd; color: #856404; }
.badge-status.diproses { background: #cce5ff; color: #004085; }
.badge-status.selesai { background: #d4edda; color: #155724; }
.badge-status.ditolak { background: #f8d7da; color: #721c24; }

.btn-primary-custom {
    background: #f7b500;
    border: none;
    padding: 8px 20px;
    border-radius: 10px;
    font-weight: 600;
    color: #0a1a3a;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}
.btn-primary-custom:hover {
    background: #e0a200;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(247,181,0,0.3);
    color: #0a1a3a;
}

.avatar-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 14px;
    flex-shrink: 0;
    background: linear-gradient(135deg, #ffcf5a, #f7b500);
    color: #0a1a3a;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

.empty-state .icon-empty { font-size: 3.5rem; color: #dee2e6; }
.empty-state h4 { font-weight: 600; color: #0a1a3a; margin-top: 0.8rem; }
.empty-state p { color: #6c757d; }

.success-card {
    background: #fff;
    border-radius: 30px;
    padding: 50px 40px;
    text-align: center;
    box-shadow: 0 30px 80px rgba(0,0,0,0.12);
}
.success-card .icon-success { font-size: 4rem; color: #28a745; margin-bottom: 1rem; }
.success-card h2 { font-weight: 700; color: #0a1a3a; }
.success-card p { color: #6c757d; font-size: 1rem; }
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
    box-shadow: 0 8px 30px rgba(247,181,0,0.3);
}

.search-info .result-count { font-size: 0.9rem; color: #6c757d; }

.pager .pagination {
    display: flex;
    gap: 10px;
    padding-left: 0;
    margin: 0;
    list-style: none;
    justify-content: center;
    align-items: center;
}
.pager .page-item { display: inline-flex; }
.pager .page-item .page-link {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e8ecf1;
    color: #0a1a3a;
    background: #fff;
    padding: 0;
    transition: all 150ms ease;
}
.pager .page-item.active .page-link { background: #f7b500; border-color: #f7b500; color: #0a1a3a; font-weight: 700; }
.pager .page-item .page-link:hover { background: #fff6e6; border-color: #f1d37e; }
.pager .page-item.disabled .page-link {
    opacity: 0.6;
    pointer-events: none;
    background: #f8f9fa;
    border-color: #dee2e6;
    color: #adb5bd;
}

@media (max-width: 992px) {
    .pengaduan-left, .pengaduan-right { padding: 30px 25px; }
}
@media (max-width: 576px) {
    .pengaduan-left, .pengaduan-right { padding: 20px; }
    .pengaduan-left h1 { font-size: 1.4rem; }
    .table-custom thead th, .table-custom tbody td { padding: 8px 6px; font-size: 0.8rem; }
    .badge-status { font-size: 0.65rem; padding: 3px 8px; }
    .btn-track { padding: 10px 20px; font-size: 0.9rem; }
    .pager .page-item .page-link { width: 36px; height: 36px; min-width: 36px; }
}
</style>

<!-- HERO / FORM SECTION -->
<div class="pengaduan-hero">
    <div class="container">
        <?php if ($msg = session()->getFlashdata('success')): ?>
            <!-- SUCCESS MESSAGE -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="success-card">
                        <div class="icon-success"><i class="bi bi-check-circle-fill"></i></div>
                        <h2>Pengaduan Berhasil Dikirim!</h2>
                        <p><?= $msg ?></p>
                        <a href="<?= base_url('pengaduan') ?>" class="btn-back">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Pengaduan
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- FORM PENGAJUAN -->
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
                                <?= csrf_field() ?>
                                <?php
                                $fields = [
                                    ['id' => 'nama', 'label' => 'Nama Lengkap', 'type' => 'text', 'placeholder' => 'Masukkan nama lengkap Anda'],
                                    ['id' => 'email', 'label' => 'Email', 'type' => 'email', 'placeholder' => 'Masukkan alamat email Anda'],
                                    ['id' => 'nomor_telepon', 'label' => 'Nomor Telepon', 'type' => 'text', 'placeholder' => 'Masukkan nomor telepon Anda'],
                                    ['id' => 'judul', 'label' => 'Judul Pengaduan', 'type' => 'text', 'placeholder' => 'Masukkan judul pengaduan Anda']
                                ];
                                foreach ($fields as $f):
                                ?>
                                <div class="form-group">
                                    <label for="<?= $f['id'] ?>"><?= $f['label'] ?> <span class="required">*</span></label>
                                    <input type="<?= $f['type'] ?>" id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" class="form-control" placeholder="<?= $f['placeholder'] ?>" required>
                                </div>
                                <?php endforeach; ?>
                                
                                <div class="form-group">
                                    <label for="kategori_select">Kategori Pengaduan <span class="required">*</span></label>
                                    <select id="kategori_select" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php
                                        $kategoriOptions = [
                                            'banjir' => '🌊 Banjir',
                                            'bendungan_rusak' => '🏗️ Bendungan Rusak',
                                            'saluran_tersumbat' => '🚧 Saluran Tersumbat'
                                        ];
                                        foreach ($kategoriOptions as $val => $label):
                                        ?>
                                        <option value="<?= $val ?>"><?= $label ?></option>
                                        <?php endforeach; ?>
                                        <option value="lainnya">🔎 Lainnya</option>
                                    </select>

                                    <!-- Hidden input yang dikirim sebagai `kategori` saat form disubmit -->
                                    <input type="hidden" id="kategori" name="kategori" value="">

                                    <!-- Input terlihat saat memilih 'Lainnya' -->
                                    <input type="text" id="kategori_lain_input" class="form-control mt-2" placeholder="Tuliskan kategori lain..." style="display:none;">
                                </div>
                                
                                <div class="form-group">
                                    <label for="deskripsi">Uraian Pengaduan <span class="required">*</span></label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Jelaskan secara detail pengaduan Anda..." required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-send me-2"></i> Kirim Pengaduan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- DAFTAR PENGADUAN -->
<div class="container py-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h4 class="section-title"><i class="bi bi-list-check me-2"></i>Daftar Pengaduan</h4>
            <p class="section-subtitle">
                Daftar 5 pengaduan terbaru yang telah masuk.
                <?php if (!empty($pengaduan)): ?>
                    <span class="badge bg-warning text-dark ms-2"><i class="bi bi-database me-1"></i><?= count($pengaduan) ?> data</span>
                <?php endif; ?>
            </p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="<?= base_url('pengaduan/track') ?>" class="btn-track me-2">
                <i class="bi bi-search"></i> <span>Lacak Pengaduan</span> <i class="bi bi-arrow-right"></i>
            </a>
            <a href="<?= base_url('pengaduan') ?>" class="btn btn-primary-custom">
                <i class="bi bi-arrow-repeat me-2"></i> Refresh
            </a>
        </div>
    </div>

    <div class="search-info mb-3">
        <span class="result-count"><i class="bi bi-info-circle me-1"></i>Menampilkan <strong>5</strong> pengaduan terbaru</span>
        <span class="result-count ms-3">Total data: <strong><?= $total ?? 0 ?></strong></span>
    </div>

    <?php if (empty($pengaduan)): ?>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body text-center py-5 empty-state">
                <div class="icon-empty"><i class="bi bi-inbox"></i></div>
                <h4><?= (isset($keyword) && !empty($keyword)) ? 'Pengaduan Tidak Ditemukan' : 'Belum Ada Pengaduan' ?></h4>
                <p><?= (isset($keyword) && !empty($keyword)) ? 'Tidak ada pengaduan yang sesuai dengan kata kunci "' . esc($keyword) . '".' : 'Silakan buat pengaduan pertama Anda menggunakan form di atas.' ?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $group = 'default';
                            $perPage = isset($pager) ? $pager->getPerPage($group) : 5;
                            $currentPage = isset($pager) ? $pager->getCurrentPage($group) : 1;
                            $no = ($currentPage - 1) * $perPage + 1;
                            
                            $statusMap = [
                                'pending' => ['class' => 'pending', 'text' => 'Pending'],
                                'diproses' => ['class' => 'diproses', 'text' => 'Diproses'],
                                'selesai' => ['class' => 'selesai', 'text' => 'Selesai'],
                                'ditolak' => ['class' => 'ditolak', 'text' => 'Ditolak']
                            ];
                            ?>
                            <?php foreach ($pengaduan as $item): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2"><?= strtoupper(substr($item['nama'], 0, 1)) ?></div>
                                            <?= esc($item['nama']) ?>
                                        </div>
                                    </td>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td>
                                        <span class="badge" style="background: #1a2a6c; color: #fff; padding: 5px 12px; border-radius: 50px;">
                                            <?= esc(ucfirst(str_replace('_', ' ', $item['kategori']))) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php $status = $statusMap[$item['status']] ?? ['class' => 'pending', 'text' => ucfirst($item['status'])]; ?>
                                        <span class="badge-status <?= $status['class'] ?>"><?= $status['text'] ?></span>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- PAGINATION -->
        <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
            <nav class="pager d-flex justify-content-center my-3">
                <ul class="pagination mb-0">
                    <?php
                    $pageCount = $pager->getPageCount();
                    $current = $pager->getCurrentPage();
                    $base = current_url();
                    ?>
                    <li class="page-item page-prev <?= $current == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $base . '?page=' . max(1, $current-1) ?>"><i class="bi bi-chevron-left"></i></a>
                    </li>
                    <?php for ($i = 1; $i <= $pageCount; $i++): ?>
                        <li class="page-item <?= $i == $current ? 'active' : '' ?>">
                            <a class="page-link" href="<?= $base . '?page=' . $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item page-next <?= $current == $pageCount ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $base . '?page=' . min($pageCount, $current+1) ?>"><i class="bi bi-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
// Kategori: jika pilih 'Lainnya', tampilkan input dan kirimkan nilai saat submit
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('kategori_select');
    if (!select) return;

    const hidden = document.getElementById('kategori');
    const lainInput = document.getElementById('kategori_lain_input');
    const form = select.closest('form');

    // Inisialisasi: jika ada nilai default, set hidden
    if (select.value && select.value !== 'lainnya') {
        hidden.value = select.value;
    }

    select.addEventListener('change', function() {
        if (this.value === 'lainnya') {
            lainInput.style.display = 'block';
            lainInput.required = true;
            hidden.value = '';
            lainInput.focus();
        } else {
            lainInput.style.display = 'none';
            lainInput.required = false;
            hidden.value = this.value;
        }
    });

    lainInput.addEventListener('input', function() {
        hidden.value = this.value.trim();
    });

    if (form) {
        form.addEventListener('submit', function(e) {
            if ((select.value === 'lainnya') && (!hidden.value || hidden.value.trim() === '')) {
                e.preventDefault();
                alert('Silakan tulis kategori pengaduan pada kolom "Lainnya".');
                lainInput.focus();
            }
        });
    }
});
</script>

<?= $this->include('layout/footer') ?>