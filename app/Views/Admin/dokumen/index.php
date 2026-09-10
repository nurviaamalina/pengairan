
<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <main class="content-wrapper">

        <!-- TOPBAR -->
        <div class="topbar">

            <h3>Arsip Dokumen</h3>

            <a href="<?= base_url('admin/dokumen/create') ?>"
               class="btn btn-secondary">
                <i class="fas fa-plus"></i>
                Tambah Dokumen
            </a>

        </div>


        <!-- CONTENT DOKUMEN -->
        <div class="dokumen-container">

            <?php if (!empty($dokumen)): ?>

                <?php foreach ($dokumen as $d): ?>

                    <div class="dokumen-card">

                        <!-- HEADER CARD -->
                        <div class="card-header">

                            <span>📄</span>

                            <small>PDF</small>

                        </div>


                        <!-- NAMA KATEGORI -->
                        <h5>
                            <?= esc($d['nama_kategori']); ?>
                        </h5>


                        <!-- FOOTER CARD -->
                        <div class="card-footer">

                            <small>
                                <?= esc($d['file']); ?>
                            </small>

                            <a href="<?= base_url('admin/dokumen/delete/'.$d['id']) ?>"
                               class="hapus"
                               title="Hapus"
                               onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">
                                🗑
                            </a>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="empty">
                    Belum ada dokumen
                </div>

            <?php endif; ?>

        </div>

    </main>

</div>

<?= $this->include('Admin/layout/footer'); ?>

