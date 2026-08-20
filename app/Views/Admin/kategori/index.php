<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <div class="main">

        <!-- HEADER HALAMAN -->
        <div class="kategori-page-header">

            <div>
                <h3>Arsip Dokumen</h3>
                <p>Kelola kategori dokumen yang tersedia di sistem.</p>
            </div>

            <a href="<?= base_url('admin/kategori/create') ?>"
               class="btn-kategori-tambah">
                <i class="fas fa-plus"></i>
                <span>Tambah</span>
            </a>

        </div>


        <!-- CONTAINER KATEGORI -->
        <div class="kategori-container">

            <?php if (!empty($kategori)): ?>

                <div class="kategori-grid">

                    <?php foreach ($kategori as $d): ?>

                        <div class="kategori-card">

                            <!-- BAGIAN UTAMA CARD -->
                            <a href="<?= base_url('admin/kategori/' . $d['slug']); ?>"
                               class="kategori-card-link">

                                <div class="kategori-card-top">

                                    <div class="kategori-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>

                                    <span class="kategori-format">
                                        PDF
                                    </span>

                                </div>


                                <div class="kategori-card-content">

                                    <h5>
                                        <?= esc($d['slug']); ?>
                                    </h5>

                                    <p>
                                        Kategori dokumen
                                    </p>

                                </div>

                            </a>


                            <!-- ACTION BUTTON -->
                            <div class="kategori-actions">

                                <!-- EDIT -->
                                <a href="<?= base_url('admin/kategori/edit/' . $d['id']); ?>"
                                   class="kategori-btn-edit"
                                   title="Edit Kategori">

                                    <i class="bi bi-pencil-square"></i>

                                </a>


                                <!-- DELETE -->
                                <a href="<?= base_url('admin/kategori/delete/' . $d['id']); ?>"
                                   class="kategori-btn-delete"
                                   title="Hapus Kategori"
                                   onclick="return confirm('Apakah kamu yakin ingin menghapus kategori ini?');">

                                    <i class="bi bi-trash"></i>

                                </a>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <!-- DATA KOSONG -->
                <div class="kategori-empty">

                    <div class="kategori-empty-icon">
                        <i class="bi bi-folder-x"></i>
                    </div>

                    <h5>Belum Ada Kategori</h5>

                    <p>
                        Silakan tambahkan kategori dokumen terlebih dahulu.
                    </p>

                    <a href="<?= base_url('admin/kategori/create') ?>"
                       class="btn-kategori-tambah">

                        <i class="fas fa-plus"></i>
                        Tambah Kategori

                    </a>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>