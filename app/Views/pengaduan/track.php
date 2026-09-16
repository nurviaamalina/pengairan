<?= $this->include('layout/header') ?>

<div class="container mt-5">
    <style>
        /* Avatar & Badge tweaks (match index) */
        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
            flex-shrink: 0;
            background: #0a2558;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            display: inline-block;
        }

        .detail-row {
            display: none;
            background: #f8fafc;
        }
        .detail-row td {
            padding: 0;
            border-top: none;
        }
        .detail-card {
            padding: 16px 20px;
            margin: 0 16px 16px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
        }
        .detail-card h6 {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            font-weight: 700;
            color: #0a2558;
        }
        .detail-card p {
            margin-bottom: 0.5rem;
            color: #475569;
        }
        .btn-detail {
            padding: 0.35rem 0.75rem;
            font-size: 0.78rem;
        }

        /* ===== TOMBOL DENGAN BOX ===== */
        .btn-box {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.25s ease;
            border: 1px solid #0a2558;
            background: transparent;
            color: #0a2558;
        }

        .btn-box:hover {
            background: #0a2558;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(10, 37, 88, 0.2);
        }

        .btn-box-primary {
            background: #0a2558;
            border: 1px solid #0a2558;
            color: #ffffff;
        }

        .btn-box-primary:hover {
            background: #071838;
            border-color: #071838;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(10, 37, 88, 0.2);
        }

        .btn-box-outline {
            background: transparent;
            border: 1px solid #0a2558;
            color: #0a2558;
        }

        .btn-box-outline:hover {
            background: #0a2558;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(10, 37, 88, 0.2);
        }
    </style>
    <div class="card p-4 border-0 shadow-sm rounded-4" style="border: 1px solid #e2e8f0 !important;">
        <h4 class="fw-bold" style="color: #0a2558;">Lacak Pengaduan</h4>

        <form action="<?= base_url('pengaduan/track') ?>" method="post" class="mb-4">
            <div class="mb-3">
                <label for="query" class="form-label fw-semibold text-secondary">Masukkan Kode Pelacakan atau Nama Pelapor</label>
                <input type="text" name="query" id="query" class="form-control py-2" value="<?= isset($query) ? esc($query) : '' ?>" placeholder="Contoh: AB12CD34 atau Nama Lengkap" required>
            </div>
           <div class="mt-3">
            <button class="btn text-white px-4 py-2 fw-semibold" style="background: #0a2558; border-radius: 8px;">Lacak Status</button>
        </div>
        </form>

        <?php if(isset($pengaduan) && $pengaduan): ?>
            <?php
                // Normalize to array of rows for consistent rendering
                $rows = (is_array($pengaduan) && array_values($pengaduan) === $pengaduan) ? $pengaduan : [$pengaduan];
            ?>

            <div class="row align-items-center mb-3">
                <div class="col-md-6">
                    <h4 class="section-title">
                        <i class="bi bi-list-check me-2"></i>
                        Daftar Pengaduan
                    </h4>
                    <p class="section-subtitle">Hasil pencarian dan daftar pengaduan terkait.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="<?= base_url('pengaduan') ?>" class="btn-box btn-box-outline me-2">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali
                    </a>
                    <a href="<?= base_url('pengaduan/track') ?>" class="btn-box btn-box-primary">
                        <i class="bi bi-arrow-repeat me-2"></i>
                        Refresh
                    </a>
                </div>
            </div>

            <div class="search-info mb-3">
                <span class="result-count">
                    <i class="bi bi-info-circle me-1"></i>
                    Menampilkan <strong><?= count($rows) ?></strong> pengaduan
                </span>
                <span class="result-count ms-3">
                    Total data: <strong><?= $total ?? 0 ?></strong>
                </span>
            </div>

            <div class="card">
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
                                    <th width="50" class="text-center"><i class="bi bi-info-circle" title="Tindak Lanjut"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if (isset($pager)) {
                                        $groupForNum = $pagerGroup ?? 'track';
                                        $perPageNum = $pager->getPerPage($groupForNum);
                                        $currentPageNum = $pager->getCurrentPage($groupForNum);
                                        $no = ($currentPageNum - 1) * $perPageNum + 1;
                                    } else {
                                        $no = 1;
                                    }
                                ?>
                                <?php foreach ($rows as $item): ?>
                                <tr class="expandable-row">
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2"><?= strtoupper(substr($item['nama'], 0, 1)) ?></div>
                                            <?= esc($item['nama']) ?>
                                        </div>
                                    </td>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td>
                                        <span class="badge" style="background: #1a2a6c; color: #fff; padding: 5px 12px; border-radius: 50px;"><?= esc(ucfirst(str_replace('_', ' ', $item['kategori']))) ?></span>
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
                                        <span class="badge-status <?= $status_class ?>"><?= $status_text ?></span>
                                    </td>
                                    <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                    <td class="text-center">
                                        <?php if (!empty($item['tindak_lanjut'])): ?>
                                            <span class="expand-icon" onclick="toggleDetail(this)">
                                                <i class="bi bi-chevron-down text-primary" style="font-size: 1.2rem; cursor: pointer;"></i>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted"><i class="bi bi-dash-circle"></i></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                
                                <?php if (!empty($item['tindak_lanjut'])): ?>
                                <tr class="detail-row">
                                    <td colspan="7" class="p-3">
                                        <div class="tindak-lanjut-card">
                                            <div class="tl-header">
                                                <div class="tl-icon"><i class="bi bi-info-circle-fill"></i></div>
                                                <h6 class="tl-title">Informasi Tindak Lanjut</h6>
                                                <span class="tl-badge"><i class="bi bi-clock me-1"></i>Terupdate: <?= date('d-m-Y', strtotime($item['updated_at'])) ?></span>
                                            </div>
                                            <div class="tl-body">
                                                <p><?= nl2br(esc($item['tindak_lanjut'])) ?></p>
                                                <small class="tl-time"><i class="bi bi-clock-history me-1"></i>Diperbarui: <?= date('d-m-Y H:i', strtotime($item['updated_at'])) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ===== PAGINATION ===== -->
            <?php if (isset($pager)): ?>
                <?php
                    $group = $pagerGroup ?? 'track';
                    $pageCount = $pager->getPageCount($group);
                    $current = $pager->getCurrentPage($group);
                    $param = $group === 'default' ? 'page' : 'page_' . $group;
                    $base = current_url();
                    $prevPage = max(1, $current - 1);
                    $nextPage = min($pageCount, $current + 1);
                ?>
                <?php if ($pageCount > 1): ?>
                    <nav class="pager d-flex justify-content-center my-3" aria-label="Pagination">
                        <ul class="pagination mb-0">
                            <li class="page-item page-prev <?= $current == 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $base . '?' . $param . '=' . $prevPage ?>" aria-label="Previous">
                                    <i class="bi bi-chevron-left"></i>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $pageCount; $i++): ?>
                                <li class="page-item <?= $i == $current ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $base . '?' . $param . '=' . $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item page-next <?= $current == $pageCount ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $base . '?' . $param . '=' . $nextPage ?>" aria-label="Next">
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>

            <style>
                .pager .pagination {
                    display: flex;
                    gap: 10px;
                    padding-left: 0;
                    margin: 0;
                    list-style: none;
                    justify-content: center;
                    align-items: center;
                }
                .pager .page-item {
                    display: inline-flex;
                }
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
                .pager .page-item.page-prev .page-link,
                .pager .page-item.page-next .page-link {
                    width: 44px;
                    min-width: 44px;
                    border-radius: 12px;
                    padding: 0;
                }
                .pager .page-item.active .page-link {
                    background: #f7b500;
                    border-color: #f7b500;
                    color: #0a1a3a;
                    font-weight: 700;
                }
                .pager .page-item .page-link:hover {
                    background: #fff6e6;
                    border-color: #f1d37e;
                }
                .pager .page-item.disabled .page-link {
                    opacity: 0.6;
                    pointer-events: none;
                    background: #f8f9fa;
                    border-color: #dee2e6;
                    color: #adb5bd;
                }
                @media (max-width: 576px) {
                    .pager .page-item .page-link {
                        width: 36px;
                        height: 36px;
                        min-width: 36px;
                    }
                    .pager .page-item.page-prev .page-link,
                    .pager .page-item.page-next .page-link {
                        width: 40px;
                        min-width: 40px;
                    }
                }
            </style>

        <?php elseif(isset($pengaduan)): ?>
            <div class="alert alert-danger">Pengaduan tidak ditemukan.</div>
        <?php endif; ?>

    </div>
</div>

<script>
function toggleDetail(button) {
    const row = button.closest('tr');
    const detailRow = row.nextElementSibling;
    if (detailRow && detailRow.classList.contains('detail-row')) {
        detailRow.style.display = detailRow.style.display === 'table-row' ? 'none' : 'table-row';
        // toggle icon rotation
        const icon = button.querySelector('i');
        if (icon) icon.classList.toggle('open');
    }
}
</script>

<?= $this->include('layout/footer') ?>
