<?= $this->include('Admin/layout/header'); ?>

<div class="wrapper">

    <?= $this->include('Admin/layout/sidebar'); ?>

    <div class="main">

        <div class="topbar">
            <h3>Arsip Dokumen</h3>

            <a href="<?= base_url('admin/kategori/create') ?>" class="btn btn-secondary">
        <i class="fas fa-plus"></i> Tambah 
    </a>
        </div>
       
        <div class="dokumen-container">
            <?php if(!empty($kategori)): ?>
                <?php foreach($kategori as $d): ?>

               
                <a href="<?= base_url('admin/kategori/'.$d['slug']); ?>" class="dokumen-card">

                    <div class="card-header">
                        <span>📄</span>
                        <small>PDF</small>
                    </div>

                    <h5><?= esc($d['slug']); ?></h5>

                    <div class="d-flex gap-2 mt-3">

                        <i class="bi bi-pencil-square"></i>

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