<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <div class="main">

        <div class="topbar">
            <h3>Arsip Dokumen</h3>

            <a href="<?= base_url('admin/dokumen/create') ?>" class="btn btn-secondary">
        <i class="fas fa-plus"></i> Tambah Dokumen
    </a>
        </div>
       
        <div class="dokumen-container">
            <?php if(!empty($dokumen)): ?>
                <?php foreach($dokumen as $d): ?>

               
                <a href="<?= base_url('admin/dokumen/'.$d['']); ?>" class="dokumen-card">

                    <div class="card-header">
                        <span>📄</span>
                        <small>PDF</small>
                    </div>

                    <h5><?= esc($d['nama_kategori']); ?></h5>

                    <div class="card-footer">
                        <small><?= esc($d['file']); ?></small>

                        <button class="hapus" title="Hapus">
                            🗑
                        </button>
                    </div>

            </a>

            <?php endforeach; ?>

            <?php else: ?>


            <div class="empty">

                Belum ada dokumen

            </div>


        <?php endif; ?>


        </div>

    </div>

</div>

<?= $this->include('Admin/layout/footer'); ?>